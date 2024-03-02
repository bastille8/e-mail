<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stamp;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


class AuthenticatedSessionController extends Controller
{
    public function index(Request $request)
    {
        //｛勤務開始｝
        // ログインしているIDを取得
        $auth = auth()->user()->id;
        // 現日時を取得
        $today = Carbon::now()->toDateString();
        // ログインしているID(以下割愛)と一致し且つ当日に打刻されているレコードを探す
        $stamp = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->first();
        // 既に出勤しているかチェック
        if ($stamp == null) {
            // 出勤している場合
            $stamp = true;
        } else {
            // 出勤していない場合
            $stamp = false;
        }

        //｛勤務終了｝
        // 勤務終了を押していないレコードを探す
        $stampend = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->where('work_out')->first();
        // 休憩を終了させていないレコードを探す
        $stampstop = Rest::where('rests_id', $auth)->where('rest_out', null)->first();

        if (!$stampend == null && $stampstop == null) {
            $stampend = true;
        } else {
            $stampend = false;
        }

        //｛休憩開始｝
        // 当日既に出勤していて且つ退勤していないレコードを探す
        $rest = Stamp::where('stamps_id', $auth)->where('stamps_day', $today)->where('work_out', null)->first();
        // 最後に休憩終了を押していない形跡を探す
        $rest_notend = Rest::where('rests_id', $auth)->where('rest_out', null)->first();
        // 既に出勤しており且つ退勤をしておらず、休憩開始をしていないかチェック(休憩終了を押すと復活)
        if (!$rest == null && $rest_notend == null) {
            $rest = true;
        } else {
            $rest = false;
        }

        //｛休憩終了｝
        // 休憩を終了させていないレコードを探す
        $restend = Rest::where('rests_id', $auth)->where('rest_out', null)->first();

        if (!$restend == null) {
            $restend = true;
        } else {
            $restend = false;
        }
        return view('index', compact('stamp', 'stampend', 'rest', 'restend'));
    }

    public function create(Request $request)
    {
        $stamps_day = Stamp::select('stamps_day')->simplePaginate(1);
        $date = Stamp::Paginate(5);
        return view('attendance', compact('date', 'stamps_day'));
    }
    
}