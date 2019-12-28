<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as AppBase;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\UserService;
use App\Consts;
use DB;
use Exception;

class UserAPIController extends AppBase
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService      = $userService;
    }

    public function getUserProfile(Request $request)
    {
        try {
            $data = $this->userService->getUserProfile(Auth::id());
            event(new \App\Events\UserOnline($data->id));
            return $this->sendResponse($data);
        } catch (Exception $ex) {
            logger()->error($ex);
            return $this->sendError($ex->getMessage());
        }
    }

    public function getSummaryProfile(Request $request)
    {
        try {
            $userId = $request->id;
            $data = $this->userService->getUserProfile($userId);
            return $this->sendResponse([
                'avatar' => $data->avatar,
                'full_name' => $data->full_name,
                'username' => $data->username,
                'description' => $data->description,
                'rating' => $data->rating,
                'number_reviewer' => $data->number_reviewer,
            ]);
        } catch (Exception $ex) {
            logger()->error($ex);
            return $this->sendError($ex->getMessage());
        }
    }

    public function getUserNotifications(Request $request)
    {
        try {
            $data = $this->userService->getUserNotifications();
            return $this->sendResponse($data);
        } catch (Exception $ex) {
            logger()->error($ex);
            return $this->sendError($ex->getMessage());
        }
    }

    public function markAsReadNotification(Request $request)
    {
        DB::beginTransaction();
        try {
            $notifiId = $request->notification_id;
            $data = $this->userService->markAsReadNotification($notifiId);
            DB::commit();
            return $this->sendResponse($data);
        } catch (Exception $ex) {
            DB::rollBack();
            logger()->error($ex);
            return $this->sendError($ex->getMessage());
        }
    }

    public function markAsReadAllNotifications(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $this->userService->markAsReadAllNotifications();
            DB::commit();
            return $this->sendResponse('Ok');
        } catch (Exception $ex) {
            DB::rollBack();
            logger()->error($ex);
            return $this->sendError($ex->getMessage());
        }
    }

}
