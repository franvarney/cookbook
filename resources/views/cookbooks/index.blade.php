@extends('../../templates/master')

@section('content')

  <div id="cookbook-index">

    <div class="title">
      <h1>Cookbooks</h1>
    </div>

    <div class="cookbooks">
      <ul>
      @foreach($contents->cookbooks as $cookbook)
        <li>
          <div class="col-md-4 image">
            <img src="http://s3.amazonaws.com/gmi-digital-library/fb1058e3-3850-408e-8d4a-885e02dca10c.jpg" />
          </div>
          <div class="col-md-8 details">
            <h2 class="name"><a href="/cookbook/{!! $cookbook->cookbook->id !!}">{!! $cookbook->cookbook->name !!}</a></h2>
            @if($cookbook->cookbook->description)
              <p>{!! $cookbook->cookbook->description !!}</p>
            @endif
            Contributors: @foreach($cookbook->cookbook->contributors as $key => $contributor)
              @if($contributor->user->id !== Auth::user()->id)
                <a href="search/tag/{!! $contributor->user->username !!}">{!! $contributor->user->username !!}</a>@if($key + 1 !== count($cookbook->cookbook->contributors)),&nbsp;
                @endif
              @endif
            @endforeach
          </div>
        </li>
      @endforeach
      </ul>
    </div>
  </div>

@endsection