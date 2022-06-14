
@foreach($languages as $language)

    <div>
        <form class="btn "  method="POST" action="{{route('atpro-internalisation')}}">
            @csrf
            <input type="hidden" name="lang" value="{{$language['code']}}">
            <button type="submit" class="btn btn-sm"><i class="{{$language['icon']}}" title="{{$language['code']}}" id="{{$language['code']}}"></i>{{strtoupper($language['name'])}}</button>
        </form>
    </div>

@endforeach
