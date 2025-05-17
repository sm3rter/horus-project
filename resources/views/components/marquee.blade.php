@props(['text' => 'Welcome to our website!', 'speed' => '20s'])

<div class="marquee-container" style="width: 100%; overflow: hidden; white-space: nowrap; padding: 10px 0;">
    <div class="marquee-content" style="display: inline-block; animation: marquee {{ $speed }} linear infinite; font-size: 14px; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">
        {!! $text !!}
    </div>
</div>

<style>
    @keyframes marquee {
        0% {
            transform: translateX(100%);
        }
        100% {
            transform: translateX(-100%);
        }
    }
</style>