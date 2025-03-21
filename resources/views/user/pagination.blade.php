<nav aria-label="Pagination">
    <ul class="pagination justify-content-center mb-0">
        {{-- Tombol Previous --}}
        <li class="page-item {{ $currentPage == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="{{ route($route, array_merge(request()->except('page'), ['page' => $currentPage - 1])) }}">
                <i class="mdi mdi-chevron-left"></i>
            </a>
        </li>

        {{-- Tombol Halaman --}}
        @for ($page = 1; $page <= $totalPages; $page++)
            <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                <a class="page-link" href="{{ route($route, array_merge(request()->except('page'), ['page' => $page])) }}">
                    {{ $page }}
                </a>
            </li>
        @endfor

        {{-- Tombol Next --}}
        <li class="page-item {{ $currentPage == $totalPages ? 'disabled' : '' }}">
            <a class="page-link" href="{{ route($route, array_merge(request()->except('page'), ['page' => $currentPage + 1])) }}">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
