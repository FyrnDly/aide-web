@if ($paginator->count() < $paginator->total())
@php
$url = url()->full();
$urlPage = url()->current();
$arrUrl = parse_url($url);
$paginatorName = $paginator->getPageName();

if (isset($arrUrl['query'])) {
parse_str($arrUrl['query'], $queryParams);
    if (isset($queryParams[$paginatorName])) {
        unset($queryParams[$paginatorName]);
    }
    $urlParams = http_build_query($queryParams);
    $urlNextPage = $urlPage.'?'.$urlParams.'&'.$paginatorName.'='.($paginator->count() + 1);
} else{
    $urlNextPage = $urlPage.'?'.$paginatorName.'='.($paginator->count() + 1);
}
@endphp
<div class="text-center my-2">
    <button onclick="window.location.href='{{ $urlNextPage }}'" class="btn btn-primary">
        Tampilkan Lebih Banyak
    </button>
</div>
@endif