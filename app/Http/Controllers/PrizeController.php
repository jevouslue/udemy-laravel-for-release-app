<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    public function index()
    {
        $prizes = Prize::all();
        return view('home', compact('prizes'));
    }

    public function drawLot()
    {
        $prize = Prize::all()->map(function ($prize) {
            return array_fill(0, $prize->quantity, $prize);
        })->flatten()->random();

        return response()->json($prize);
    }
}
