@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="attendance__message">
    {{ Auth::user()->name }}さんお疲れさまです!
</div>

<div class="attendance__content">
    <div class="attendance__panel">
        <form action="/work_in" method="post" class="attendance__button">
            @csrf
            <input type="hidden" name="stamps_id" value="{{ Auth::user()->id }}">
            @if ($stamp == true)
            <button class="attendance__button-submit" type="submit">勤務開始</button>
            @else
            <button class="attendance__button-submitdisabled" type="submit" disabled>勤務開始</button>
            @endif
        </form>
        <form action="/work_out" method="post" class="attendance__button">
            @csrf
            @if ($stampend == true)
            <button class="attendance__button-submit" type="submit">勤務終了</button>
            @else
            <button class="attendance__button-submitdisabled" type="submit" disabled>勤務終了</button>
            @endif
        </form>
        <form action="/rest_in" method="post" class="attendance__button">
            @csrf
            <input type="hidden" name="rests_id" value="{{ Auth::user()->id }}">
            @if ($rest == true)
            <button class="attendance__button-submit" type="submit">休憩開始</button>
            @else
            <button class="attendance__button-submitdisabled" type="submit" disabled>休憩開始</button>
            @endif
        </form>
        <form action="/rest_out" method="post" class="attendance__button">
            @csrf
            <input type="hidden" name="rests_id" value="{{ Auth::user()->id }}">
            @if ($restend == true)
            <button class="attendance__button-submit" type="submit">休憩終了</button>
            @else
            <button class="attendance__button-submitdisabled" type="submit" disabled>休憩終了</button>
            @endif
        </form>
    </div>
</div>
@endsection