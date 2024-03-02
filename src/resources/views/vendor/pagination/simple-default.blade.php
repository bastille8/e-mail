@section('css')
<link rel="stylesheet" href="{{ asset('css/attendance.css') }}">
@endsection

@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Previous Page Link --}}
        <div class="prev">
            @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
            @else
            <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif
        </div>

        <div class="next">
            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
            @else
            <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
            @endif
        </div>
    </ul>
</nav>
@endif