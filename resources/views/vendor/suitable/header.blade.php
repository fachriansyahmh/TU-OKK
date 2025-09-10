<div class="ui menu top attached">
    <div class="item fitted">
        {{-- Pengecekan "isset()" untuk keamanan --}}
        @if(isset($searchable) && $searchable)
            <form class="ui form" method="GET" action="">
                @foreach(request()->except('search') as $key => $value)
                    @if(is_array($value))
                        @foreach($value as $v)
                            <input type="hidden" name="{{ $key }}[]" value="{{ $v }}">
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endif
                @endforeach
                <div class="ui icon input">
                    <input type="text" name="search" placeholder="@lang('laravolt::label.search')" value="{{ request('search') }}">
                    <i class="search link icon"></i>
                </div>
            </form>
        @endif
    </div>

    <div class="right menu">
        <div class="item">
            {{-- Pengecekan "isset()" untuk keamanan --}}
            @if(isset($headerActions))
                {!! $headerActions->render() !!}
            @endif
        </div>
    </div>
</div>
