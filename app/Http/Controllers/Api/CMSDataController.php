<?php

namespace App\Http\Controllers\Api;

use App\Models\CMS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CMSDataController extends Controller
{
    //get cms data by key
    public function getData(Request $request)
    {
        $data = CMS::get();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }
}
