<div class="panel widget center bgimg" style="margin-bottom:0;overflow:hidden;background-color:rgb(0, 225, 255);">
    <div class="dimmer"></div>
    <div class="panel-content">
        @if (isset($icon))<i class='{{ $icon }}'></i>@endif
        <h4>{!! $title !!}</h4>
        <p>{!! $text !!}</p>
        <a href="{{ $button['link'] }}" class="btn btn-primary">{!! $button['text'] !!}</a>
    </div>
</div>
