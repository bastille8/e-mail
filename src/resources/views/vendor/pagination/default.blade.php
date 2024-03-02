@if ($paginator->hasPages())
<ul class="pagination" role="navigation">
    {{--}} 最初のページへのリンク
    {{-- First Page View --}}
    <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url(1) }}">&laquo;</a>
    </li>

    {{--}} 前のページへのリンク
    {{-- Previous Page Link --}}
    <li class="page-item {{ $paginator->onFirstPage() ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->previousPageUrl() }}">&lsaquo;</a>
    </li>


    {{-- Pagination Elements --}}
    @foreach ($elements as $element)
    {{-- "Three Dots" Separator --}}
    @if (is_string($element))
    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
    @endif

    {{-- Array Of Links --}}
    @if (is_array($element))
    @foreach ($element as $page => $url)
    @if ($page == $paginator->currentPage())
    {{-- 現在のページ --}}
    <li class="active" aria-current="page"><span>&nbsp;{{ $page }}</span></li>
    {{-- 現在のページと最後の総ページの間の「/」--}}
    &nbsp;/&nbsp;
    {{-- 総ページ数（＝最後のページ）--}}
    <li class="active" aria-current="page"><span>{{ $paginator->lastPage() }}&nbsp;</span></li>
    @endif
    @endforeach
    @endif
    @endforeach

    {{--}} 次のページへのリンク
    {{-- Next Page Link --}}
    <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->nextPageUrl() }}">&rsaquo;</a>
    </li>

    {{--}} 最後のページへのリンク
    {{-- Last Page Link --}}
    <li class="page-item {{ $paginator->currentPage() == $paginator->lastPage() ? ' disabled' : '' }}">
        <a class="page-link" href="{{ $paginator->url($paginator->lastPage()) }}">&raquo;</a>
    </li>
</ul>
@endif