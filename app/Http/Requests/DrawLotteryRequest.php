<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DrawLotteryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 抽選可能回数が残っている場合のみリクエストを認可
        return $this->user()->remainingNumberOfDrawing() >= 1;
    }
}
