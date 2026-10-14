<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visit;

class TelemetryController extends Controller
{
    public function ping(Request $request)
    {
        $visitId = $request->input('visit_id');

        if ($visitId && $visit = Visit::find($visitId)) {
            $visit->increment('seconds_spent', 10);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
