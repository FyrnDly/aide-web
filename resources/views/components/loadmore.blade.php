@if($paginator->count() < $paginator->total())
    @php
    $url = url()->full();
    $arrUrl = parse_url($url);
    if (isset($arrUrl['query'])) {
    $urlNextPage = $url.'&'.$paginator->getPageName().'='.($paginator->count()+1);
    } else {
    $urlNextPage = $url.'?'.$paginator->getPageName().'='.($paginator->count()+1);
    }
    @endphp
    <div class="text-center my-2">
        <button onclick="window.location.href='{{ $urlNextPage }}'" class="btn btn-primary">
            Tampilkan Lebih Banyak
        </button>
    </div>
    @endif

