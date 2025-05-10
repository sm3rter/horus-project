@if(session()->has('message'))
    @switch(session()->get('status'))
        @case(true)
            <div class="alert alert-success text-center" role="alert">
        @break
        @case(false)
            <div class="alert alert-danger text-center" role="alert">
        @break            
    @endswitch
        @if(session()->has('title'))
            <strong> {{session()->get('title')}} </strong>
        @endif
        {!! session()->get('message') !!}
    </div>
@endif