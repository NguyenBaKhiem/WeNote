<?php

namespace App\Http\Controllers\API\Auth;

use Mail;
use App;
use App\Consts;
use App\Utils;
use App\Models\User;
use App\Mail\LoginNewIP;
use App\Mail\LoginNewDevice;
use App\Models\UserConnectionHistory;
use Illuminate\Http\Request;
use App\Utils\BearerToken;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use Psr\Http\Message\ServerRequestInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use Laravel\Passport\Http\Controllers\HandlesOAuthErrors;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\DeviceParserAbstract;
use Zend\Diactoros\Response as Psr7Response;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Event;

class LoginAPIController extends AccessTokenController
{
    use HandlesOAuthErrors;

    /**
     * Authorize a client to access the user's account.
     *
     * @param  \Psr\Http\Message\ServerRequestInterface  $request
     * @return \Illuminate\Http\Response
     */
    public function issueToken(ServerRequestInterface $request)
    {
        return $this->withErrorHandling(function () use ($request) {
            $response = $this->convertResponse(
                $this->server->respondToAccessTokenRequest($request, new Psr7Response)
            );
            $this->verifyAdditinalSettings($request);
            return $this->authenticated($response);
        });
    }

    protected function authenticated($response)
    {
        $request = request();
        $user = $this->getUser($request->get('username'));

        $userService = new UserService();

        $device = $userService->getCurrentDevice('', $user->id);

        if ($user->isValid() && ($device->latest_ip_address !== $request->ip() || $device->isNewDevice) ) {
            $device->latest_ip_address = $request->ip();
            $device->save();
        }

        $device->latest_ip_address = $request->ip();
        $device->save();
        $this->storeConnection($device);

        event(new \App\Events\UserOnline($user->id));

        return $this->modifyResponse($response);
    }

    private function storeConnection($device) {
        $connectionHistory = new UserConnectionHistory;
        $connectionHistory->user_id = $device->user->id;
        $connectionHistory->device_id = $device->id;
        $connectionHistory->ip_address = $device->latest_ip_address;
        $connectionHistory->created_at = Utils::currentMilliseconds();
        $connectionHistory->updated_at = Utils::currentMilliseconds();
        $connectionHistory->save();
    }

    protected function modifyResponse($response) {
        $content = $this->getResponseContent($response);
        $content['secret'] = $this->createTokenSecret($content);
        $content['locale'] = App::getLocale();
        return $response->setContent($content);
    }

    protected function getResponseContent($response) {
        return collect(json_decode($response->content()));
    }

    protected function createTokenSecret($content) {
        $token = BearerToken::fromJWT($content['access_token']);
        $token->secret = str_random(40);
        $token->save();
        return $token->secret;
    }

    protected function verifyAdditinalSettings($request) {
        $params = $request->getParsedBody();
        $username = $params['username'];
        $user = $this->getUser($username);

        if (!$user->email_verified) {
            throw new OAuthServerException('You need to verify your email address.', 6, 'email_unverified');
        }
        if ($user->status === Consts::USER_INACTIVE) {
            throw new OAuthServerException('Your account hasn\'t been inactive yet.', 6, 'account_inactive');
        }
    }

    private function getUser($username)
    {
        return User::where(function ($query) use ($username) {
            $query->where('email', $username)
                ->orWhere('username', $username);
            })
            ->first();
    }
}
