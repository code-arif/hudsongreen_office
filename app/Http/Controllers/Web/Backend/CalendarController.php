<?php

namespace App\Http\Controllers\Web\Backend;

use Carbon\Carbon;
use App\Models\Work;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    //make calendar
    public function calendar()
    {
        $works = Work::all()->map(function ($work) {
            return [
                'id' => $work->id,
                'title' => $work->title,
                'start' => Carbon::parse($work->start_time)->format('Y-m-d\TH:i:s'),
                'end' => Carbon::parse($work->end_time)->format('Y-m-d\TH:i:s'),
                'description' => $work->description,
            ];
        });

        return view('backend.layouts.calendar.index', [
            'works' => $works
        ]);
    }
}
