<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as AppBase;
use Illuminate\Support\Facades\Auth;
use App\Http\Services\CommentService;
use DB;
use Exception;
class CommentController extends AppBase
{
	protected $commentService;

	public function __construct(CommentService $commentService)
	{
		$this->commentService      = $commentService;
	}

	public function addCommentToNote(Request $request)
	{
		DB::beginTransaction();
		try {
			$data = $this->commentService->addCommentToNote($request->all());
			DB::commit();
			return $this->sendResponse($data);
		} catch (Exception $ex) {
			DB::rollBack();
			logger()->error($ex);
			return $this->sendError($ex->getMessage());
		}
	}
}
