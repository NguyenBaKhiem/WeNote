<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as AppBase;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\VoteService;
use DB;
use Exception;

class VoteController extends AppBase
{
    protected $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService      = $voteService;
    }

    public function addVoteToNote(Request $request)
    {
    	DB::beginTransaction();
    	try {
    		$data = $this->voteService->addVoteToNote($request->all());
    		DB::commit();
    		return $this->sendResponse($data);
    	} catch (Exception $ex) {
    		DB::rollBack();
    		logger()->error($ex);
    		return $this->sendError($ex->getMessage());
    	}
    }
}
