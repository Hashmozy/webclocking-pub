<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Clocking;
use Auth;
use Inertia\Inertia;

class ClockingController extends Controller
{
    public function index()
    {
        $clockings = Clocking::where('user_id', auth()->user()->id)->get();
        return Inertia::render('Clockings/Index', [
            'clockings' => $clockings
        ]);
    }

    public function clockIn(Request $request)
    {
        $request->user()->clockings()->create([
            'clock_in' => now()
        ]);
        return redirect()->route('clockings.index');
    }

    public function clockOut(Request $request)
    {
        $clocking = Clocking::where('user_id', auth()->user()->id)->whereNull('clock_out')->first();
        if ($clocking) {
            $clocking->update([
                'clock_out' => now()
            ]);
        }
        return redirect()->route('clockings.index');
    }
}
