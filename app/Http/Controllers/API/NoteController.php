<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as AppBase;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\NoteService;
use App\Consts;
use DB;
use Exception;

class NoteController extends AppBase
{
    protected $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService      = $noteService;
    }

    public function getNotes(Request $request)
    {
    	$data = $this->noteService->getNotes($request->all());
    	return $this->sendResponse($data);
    }

    public function addNote(Request $request)
    {
    	DB::beginTransaction();
    	try {
    		$data = $this->noteService->addNote($request->all());
    		DB::commit();
    		return $this->sendResponse($data);
    	} catch (Exception $ex) {
    		DB::rollBack();
    		logger()->error($ex);
    		return $this->sendError($ex->getMessage());
    	}
    }

    public function hideNote(Request $request)
    {
    	DB::beginTransaction();
    	try {
    		$data = $this->noteService->hideNote($request->all());
    		DB::commit();
    		return $this->sendResponse($data);
    	} catch (Exception $ex) {
    		DB::rollBack();
    		logger()->error($ex);
    		return $this->sendError($ex->getMessage());
    	}
    }
}
