<?php

namespace App\Http\Controllers\Api;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        //return "er";
        $attendance = Attendance::with(["scan:id,title", "participant:id,name,email,phone"])
            ->orderBy("created_at", "desc")
            ->get();

            return view("report", compact("attendance"));
    }
}