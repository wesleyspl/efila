<!-- filepath: resources/views/components/video-embed.blade.php -->
<div class="video-container" style="position: relative;   margin: 0 auto;">
    @if ($type === 'youtube')
        <!-- Embed YouTube Video -->
        <iframe 
            src="https://www.youtube.com/embed/{{ $videoId }}?enablejsapi&autoplay=1" 
            frameborder="0" 
            allow="autoplay; encrypted-media" 
            allowfullscreen 
            style="width: 100%; height: 100%; ">
        </iframe>
    @elseif ($type === 'vimeo')
        <!-- Embed Vimeo Video -->
        <iframe 
            src="https://player.vimeo.com/video/{{ $videoId }}" 
            frameborder="0" 
            allow="autoplay; fullscreen" 
            allowfullscreen 
            style="width: 100%; height: {{ $height ?? '450px' }};">
        </iframe>
    @elseif ($type === 'm3u8' || $type === 'mp4')
        <!-- Embed HTML5 Video -->
        <video 
            controls 
            autoplay 
            style="width: 100%; height: {{ $height ?? '450px' }};">
            <source src="{{ $videoUrl }}" type="{{ $type === 'm3u8' ? 'application/x-mpegURL' : 'video/mp4' }}">
            Your browser does not support the video tag.
        </video>
    @else
        <p>Unsupported video type.</p>
    @endif
</div>