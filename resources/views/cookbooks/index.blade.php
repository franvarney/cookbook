@extends('../../templates/master')

@section('content')

  <div id="cookbook-index">

    <div class="title">
      <h1>Cookbooks</h1>
    </div>

    <div class="cookbooks">
      <ul>
      @foreach($contents->cookbooks as $key => $cookbook)
        <li>
          <div class="col-md-8 details">
            <h2 class="name"><a href="{!! $cookbook->url !!}">{!! $cookbook->name !!}</a></h2>
            @if($cookbook->description)
              <p>{!! $cookbook->description !!}</p>
            @endif
            <p>Contributors: 
              @foreach($contents->contributors[$key] as $contributor_key => $contributor)
                {!! $contributor->contributor->username !!}
                @if($contributor_key + 1 != count($contents->contributors[$key]))
                  {!! ', '!!}
                @endif
              @endforeach
            </p>
          </div>
        </li>
      @endforeach
      </ul>
    </div>
  </div>

@endsection
