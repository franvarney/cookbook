@extends('../../templates/master')

@section('content')

  <div id="cookbook-create">

    <div class="title">
      <h1>Create Cookbook</h1>
    </div>

    {!! Form::open(array('url' => '/cookbook')) !!}
      {!! Form::hidden('user_id', Auth::user()->id) !!}
      <ul>
        <li>Name: {!! Form::text('name') !!}</li>
        <li>Description: {!! Form::textarea('description') !!}</li>
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