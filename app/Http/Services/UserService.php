<?php

namespace App\Http\Services;

use App\Consts;
use App\Models\Report;
use App\Models\UserConnectionHistory;
use App\Models\UserDeviceRegister;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;
use Carbon\Carbon;
use DeviceDetector\DeviceDetector;
use DeviceDetector\Parser\Device\DeviceParserAbstract;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Utils\BigNumber;
use Exception;
use App\Models\UserBounty;
use App\Utils;
use App\Events\BalanceUpdated;
use App\Jobs\CalculateUserLevel;

class UserService
{
    const CACHE_LIVE_TIME = 5; // minutes

    public function getCurrentDevice($name, $userId = null) {
        DeviceParserAbstract::setVersionTruncation(DeviceParserAbstract::VERSION_TRUNCATION_NONE);
        $deviceDetector = new DeviceDetector($_SERVER['HTTP_USER_AGENT']);
        $deviceDetector->parse();

        $device = new UserDeviceRegister;
        $device->user_id = $userId ?? Auth::id();
        $device->kind =  $deviceDetector->getDeviceName();
        $device->name = $name;
        $device->platform = $deviceDetector->getClient()['name'] . " " . $deviceDetector->getClient()['version'];
        $device->operating_system = $deviceDetector->getOs()['name']  . " " .  $deviceDetector->getOs()['version'];

        $payload = [$device->user_id, $device->kind, $device->platform, $device->operating_system];
        $device->user_device_identify = base64url_encode(implode('_', $payload));

        $existedDevice = UserDeviceRegister::where('user_device_identify', $device->user_device_identify)->first();

        if ($existedDevice) {
            return $existedDevice;
        }

        $device->save();

        return $device;
    }

    public function getUserProfile($userId)
    {
        return User::where('id', $userId)
                ->select('id', 'email','username', 'is_notified', 'full_name', 'avatar')
                ->first();
    }


    public function getUserNotifications()
    {
        return Auth::user()->notifications()->get()
            ->transform(function ($item) {
                return [
                    'id' => $item->id,
                    'user_bounty_id' => $item->data['user_bounty_id'],
                    'content' => $item->data['content'],
                    'status'  => $item->data['status'],
                    'read_at' => $item->read_at,
                    'created_at' => $item->created_at
                ];
            });
    }

    public function markAsReadNotification($notifiId)
    {
        $notification = DatabaseNotification::find($notifiId);
        $notification->markAsRead();
        return [
            'id' => $notification->id,
            'user_bounty_id' => $notification->data['user_bounty_id'],
            'content' => $notification->data['content'],
            'status'  => $notification->data['status'],
            'read_at' => $notification->read_at,
            'created_at' => $notification->created_at
        ];
    }

    public function markAsReadAllNotifications()
    {
        return Auth::user()->notifications->markAsRead();
    }

    public function getNumberNotificationUnReadForEachBounty()
    {
        return Auth::user()->notifications()
            ->whereNull('read_at')
            ->select('data')
            ->get()
            ->transform(function ($item) {
                return $item->data;
            })
            ->countBy('user_bounty_id');
    }
}
