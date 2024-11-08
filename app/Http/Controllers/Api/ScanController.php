<?php

namespace App\Http\Controllers\Api;


use App\Models\Scan;
use App\Models\Attendance;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ScanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Scan::get();

        return response()->json([
            'status' => 'Sucsess',
            'message' => 'ok',
            'data'  => $data
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => "validator errors",
                'errors'  => $validator->errors(),
                'data' => []
            ]);
        }

            $scan = new Scan();
            $scan->title = $request->title;

            $result = $scan->save();

            if ($result) {
             return response()->json([
                "status" => "succes",
                "message" => "save data succes",
                "data" => []
            ], 200);
            } else {
                 return response()->json([
                    "status" => "error",
                    "message" => "save data failed",
                ], 200);
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Scan::find($id);

        return response()->json([
            "status" => "succes",
            "message" => "oke",
            "data" => $data
            ], 200);


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $scan = Scan::find($id);

                if($scan == null) {
                    return response()->json([
                        "status" => "error",
                        "message" => "scan not found",
                        "data" => []
                    ], 200);
                }

                $scan->title = $request->title;

                $result = $scan->save();


                if ($result) {
                return response()->json([
                    "status" => "succes",
                    "message" => "Update data succes",
                    "data" => []
                ], 200);
                } else {
                    return response()->json([
                        "status" => "error",
                        "message" => "Update data failed",
                    ], 200);
                }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scan = Scan::find($id);

                if ($scan == null) {
                    return response()->json([
                        "status" => "error",
                        "message" => "scan not found",
                        "data" => []
                    ], 200);
                }

                $result = $scan->delete();

                if ($result) {
                return response()->json([
                    "status" => "succes",
                    "message" => "Delete data succes",
                    "data" => []
                ], 200);
                } else {
                    return response()->json([
                        "status" => "error",
                        "message" => "Delete data failed",
                    ], 200);
                }
    }


    public function scan_qr(Request $request)
  {
    $request->validate([
            'id_scan' => 'required',
            'qr_content' => 'required',
        ]);

	$user = Auth::user();

	$is_id_scan = Scan::where("id", $request->id_scan)->first();

	if(!$is_id_scan) {
		return response()->json([
			"status" => "fail",
			"message" => "id scan not found",
			"error" => [
				"id_san" => "Not Found"
				]
			], 404);
	}

		$is_participant = Participant::where("qr_content", $request->qr_content)->first();

	if(!$is_participant) {
		return response()->json([
            "status" => "fail",
            "message" => "participant not Found",
            "errors" => [
                "qr_content" => "Not Found"
            ]
	    ], 404);
	}

	$today = now()->startOfDay();
	$alreadyScan = Attendance::where("partisipant_id", $is_participant->id)
		->where("id_scan", $is_id_scan->id)
		->whereDate("scan_at", $today)
		->first();

	if($alreadyScan) {
	 return response()->json([
		"status" => "ok",
		"message" => "Anda Sudah Scan hari ini",
	]);
	}

	$attandance = new Attendance();
	$attandance->partisipant_id = $is_participant->id;
	$attandance->id_scan = $is_id_scan->id;
	$attandance->scan_at = now();
	$attandance->scan_by = $user->id;

	$attandance->save();

	if($attandace) {
		return response()->json([
		"status" => "success",
		"message" => $is_id_scan->title . " - " . $request->qr_content .  "success",
			], 200);
	} else  {
            return response()->json([
            "status" => "fail",
            "message" => "error when saving data",
            ], 422);
		}
 }


}
