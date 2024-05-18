@if (isset($paginator) && $paginator->lastPage() > 1)
<nav aria-label="Page navigation">
    <ul class="pagination">
        @php 
        $interval = isset($interval) ? abs(intval($interval)) : 3 ; 
        $from = $paginator->currentPage() - $interval; 
        if($from < 1){ 
            $from=1; 
        } 
        $to=$paginator->currentPage() + $interval; 
        if($to > $paginator->lastPage()){ 
            $to = $paginator->lastPage(); 
        } 
        @endphp

        <li class="page-item">
            <a class="page-link text-primary" href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        @for($i = $from; $i <= $to; $i++) 
        @php 
        $isCurrentPage=$paginator->currentPage() == $i;
        @endphp
        <li class="page-item {{ $isCurrentPage ? 'active' : '' }}">
            <a class="page-link text-primary" href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}">{{ $i }}</a>
        </li>
        @endfor

        <li class="page-item">
            <a class="page-link text-primary" href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</nav>
@endif

