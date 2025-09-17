<?php

namespace App\Http\Controllers\Web\Backend\CMS;

use Exception;
use App\Models\CMS;
use Illuminate\Http\Request;
use App\Http\Requests\CmsRequest;
use App\Http\Controllers\Controller;

class ReadyToTransformController extends Controller
{
    /**
     * show how it works page ready to tranform section data
     */
    public function index(Request $request)
    {
        $data = CMS::where('page', 'how-it-works')->where('section', 'ready-to-transform')->where('name', 'item')->first();

        return view("backend.layouts.cms.transform", compact("data"));
    }


    /**
     * update ready to tranform section data
     **/
    public function update(CmsRequest $request)
    {
        try {
            $validated_data = $request->validated();

            CMS::updateOrCreate(
                [
                    'page' => 'how-it-works',
                    'section' => 'ready-to-transform',
                    'name' => 'item'
                ],
                $validated_data
            );

            return back()->with('t-success', 'Updated successfully!');
        } catch (Exception $e) {
            return back()->with('t-error', 'Failed to update: ' . $e->getMessage());
        }
    }
}
