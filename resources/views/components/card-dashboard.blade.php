<div class="col-lg-3 col-6 yellow">
    <!-- small box -->
    <div class="small-box {{ $bgColor ?? 'bg-yellow' }}">
        <div class="inner">
            <h3>{{ $count }}</h3>
            <p>{{ $title }}</p>
        </div>
        <div class="icon">
            <i class="{{ $icon }}"></i>
        </div>
        <a href="{{ $link }}" class="small-box-footer">
            {{ $footerText ?? 'Detalhes' }} <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>