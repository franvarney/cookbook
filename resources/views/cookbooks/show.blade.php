@extends('../../templates/master')

@section('content')

  <div id="cookbook-create">

    <div class="title">
      <h1>{!! $contents->cookbook->name !!}</h1>
    </div>

    <div>
      @if($contents->cookbook->description !== null)
        <p>{!! $contents->cookbook->description !!}</p>
      @endif
      <p>By: <a href="{!! $contents->cookbook->creator->url !!}">{!! $contents->cookbook->creator->username !!}</a> on {!! $contents->cookbook->created !!}</p>
      <br />
    </div>

    <div>
      <ul>
        @foreach($contents->recipes as $recipe)
          <li class="col-md-4">
            <h3 class="title">{!! $recipe->title !!}</h3>
            <p>By: <a href="{!! $recipe->creator->url !!}">{!! $recipe->creator->username !!}</a>
          </li>
        @endforeach
      </ul>
    </div>

  </div>

@endsection