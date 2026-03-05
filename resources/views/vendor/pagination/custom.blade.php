@if ($paginator->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="custom-pagination">
    <div class="pagination-container">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-btn disabled">
                <i class="fas fa-chevron-left"></i>
                <span class="pagination-text">Previous</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="pagination-btn">
                <i class="fas fa-chevron-left"></i>
                <span class="pagination-text">Previous</span>
            </a>
        @endif

        {{-- Pagination Elements --}}
        <div class="pagination-numbers">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="pagination-dots">{{ $element }}</span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="pagination-number active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="pagination-number">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="pagination-btn">
                <span class="pagination-text">Next</span>
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <span class="pagination-btn disabled">
                <span class="pagination-text">Next</span>
                <i class="fas fa-chevron-right"></i>
            </span>
        @endif
    </div>

    {{-- Info Text --}}
    <div class="pagination-info">
        Showing <strong>{{ $paginator->firstItem() }}</strong> to <strong>{{ $paginator->lastItem() }}</strong> of <strong>{{ $paginator->total() }}</strong> results
    </div>
</nav>

<style>
.custom-pagination {
    display: flex;
    flex-direction: column;
    gap: 15px;
    padding: 20px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.pagination-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    flex-wrap: wrap;
}

.pagination-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    background: white;
    border: 1.5px solid #e5e7eb;
    border-radius: 6px;
    color: #374151;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
    cursor: pointer;
}

.pagination-btn:hover:not(.disabled) {
    background: #f9fafb;
    border-color: #d1d5db;
    color: #1f2937;
}

.pagination-btn.disabled {
    opacity: 0.5;
    cursor: not-allowed;
    pointer-events: none;
}

.pagination-btn i {
    font-size: 12px;
}

.pagination-numbers {
    display: flex;
    gap: 4px;
    align-items: center;
}

.pagination-number {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 36px;
    height: 36px;
    padding: 0 8px;
    background: white;
    border: 1.5px solid #e5e7eb;
    border-radius: 6px;
    color: #374151;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s;
}

.pagination-number:hover {
    background: #f9fafb;
    border-color: #d1d5db;
    color: #1f2937;
}

.pagination-number.active {
    background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
    border-color: #991b1b;
    color: white;
    font-weight: 600;
}

.pagination-dots {
    padding: 0 8px;
    color: #9ca3af;
    font-size: 14px;
}

.pagination-info {
    text-align: center;
    color: #6b7280;
    font-size: 13px;
}

.pagination-info strong {
    color: #374151;
    font-weight: 600;
}

.pagination-text {
    font-size: 14px;
}

@media (max-width: 640px) {
    .pagination-text {
        display: none;
    }
    
    .pagination-btn {
        padding: 8px 12px;
    }
    
    .pagination-number {
        min-width: 32px;
        height: 32px;
        font-size: 13px;
    }
}
</style>
@endif