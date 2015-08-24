@extends('../../templates/master')

@section('content')

  <div id="cookbook-edit">

    <div class="title">
      <h1>Edit Cookbook</h1>
    </div>

    {!! Form::open(['url' => $contents->cookbook->url, 'method' => 'PUT']) !!}
      {!! Form::hidden('user_id', Auth::user()->id) !!}
      <ul>
        <li>Name: {!! Form::text('name', $contents->cookbook->name) !!}</li>
        <li>Description: {!! Form::textarea('description', $contents->cookbook->description) !!}</li>
        <li>Public: {!! Form::checkbox('is_public', $contents->cookbook->public) !!}</li>
      </ul>
      <div class="button-wrap">
        <div class="button">
          {!! Form::submit('Create', array('class' => 'btn cookbook-submit-button')) !!}
        </div>
      </div>
      <div class="button-wrap">
        <div class="button">
          {!! Form::reset('Clear', array('class' => 'btn')) !!}
        </div>
      </div>
    {!! Form::close() !!}

  </div>

@endsection
