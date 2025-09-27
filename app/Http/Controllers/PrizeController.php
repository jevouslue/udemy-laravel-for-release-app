<?php

namespace App\Http\Controllers;

use App\Http\Requests\DrawLotteryRequest;
use App\Models\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    public function index(Request $request)
    {
        // 景品一覧
        $prizes = Prize::all();
        // 残り抽選可能回数を取得
        $remainingNumberOfDrawing = $request->user()->remainingNumberOfDrawing();
        return view('home', compact('prizes', 'remainingNumberOfDrawing'));
    }

    /**
     * 抽選処理
     */
    public function drawLot(DrawLotteryRequest $request)
    {
        // 景品ごと残り数を考慮した全景品一覧の配列からランダムに1つ取得
        $prize = Prize::all()->map(function ($prize) {
            return array_fill(0, $prize->quantity, $prize);
        })->flatten()->random();

        // 景品履歴の保存
        $request->user()->prizes()->attach($prize);
        // 残り抽選可能回数を取得
        $remainingNumberOfDrawing = $request->user()->remainingNumberOfDrawing();

        return response()->json(compact('remainingNumberOfDrawing', 'prize'));
    }
}
