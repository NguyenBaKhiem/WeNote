<?php

namespace App\Jobs;

use App\Consts;
use App\Utils;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\User;
use App\Models\UserBounty;

class CalculateUserLevel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $userId;

    /**
     * Create a new job instance.
     *
     * @param $userId
     * @param $currencies
     */
    public function __construct($userId)
    {
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::findOrFail($this->userId);
        logger()->info("CalculateUserLevel::Current user's level is {$user->level}");

        switch ($user->level) {
            case 0:
                if (self::isValidConditionLevel1($user) ) {
                    self::updateUserLevel($user, 1);
                }
                break;
            case 1:
                if (self::isValidConditionLevel2()) {
                    self::updateUserLevel($user, 2);
                }
                break;
            default:
                break;
        }
    }

    private function isValidConditionLevel1(User $user)
    {
        return !empty($user->full_name) && !empty($user->description) && !empty($user->avatar);
    }

    private function isValidConditionLevel2() {
        return UserBounty::where('claimer_id', $this->userId)
            ->where('status', Consts::USER_BOUNTY_STATUS_COMPLETED)
            ->exists();
    }

    private function updateUserLevel(User $user, $newLevel)
    {
        $user->level = $newLevel;
        $user->save();
        return $user;
    }
}
