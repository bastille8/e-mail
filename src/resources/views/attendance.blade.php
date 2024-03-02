@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@section('content')

<form class="form" action="/attendance" method="post">
    <div class="attendance-table">
        <td class="attendance-table__item">
            <div class="paginate_day">
                @foreach ($stamps_day as $value)
                {{ $stamps_day->links('vendor.pagination.simple-default') }}{{ $value->stamps_day }}
                @endforeach
            </div>
            <table class="attendance-table__inner">
                <tr class="attendance-table__row">
                    <th class="attendance-table__header">名前</th>
                    <th class="attendance-table__header">勤務開始</th>
                    <th class="attendance-table__header">勤務終了</th>
                    <th class="attendance-table__header">休憩時間</th>
                    <th class="attendance-table__header">勤務時間</th>
                </tr>
                @foreach ($date as $value)
                <tr class="attendance-table__row">
                    <td class="attendance-table__item">{{ $value->user->name }}</td>
                    <td class="attendance-table__item">{{ $value->work_in }}</td>
                    <td class="attendance-table__item">{{ $value->work_out }}</td>
                    <td class="attendance-table__item">{{ $value->rests_time }}</td>
                    <td class="attendance-table__item">{{ $value->work_time }}</td>
                </tr>
                @endforeach
            </table>
    </div>
</form>
<style>
    svg.w-5.h-5 {
        width: 30px;
        height: 30px;
        text-align: center;
    }
</style>
<div class="paginate">
    {{ $date->links('vendor.pagination.tailwind2') }}
</div>

{{--ページネーション候補}}
{{--<div class="nav-links">
    <a class="prev page-numbers" href="attendance?page=1">«</a><!-- 現在の前のページへのリンク -->
    <a class="page-numbers" href="attendance?page=2">1</a>
    <span class="page-numbers current">2</span><!-- 現在閲覧しているページ -->
    <a class="page-numbers" href="attendance?page=3">3</a>
    <span class="page-numbers dots">…</span>
    <a class="page-numbers" href="attendance?page=27">27</a>
    <a class="next page-numbers" href="attendance?page=3">»</a><!-- 現在の次のページへのリンク -->
</div>--}}

@endsection