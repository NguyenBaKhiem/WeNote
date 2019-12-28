<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Services\MasterdataService;
use App\Consts;

class MasterdataAPIController extends AppBaseController
{
    public function getAll(Request $request) {
        $masterdata = MasterdataService::getAllData();
        return $this->sendResponse($masterdata);
    }
}
