@extends('../../templates/master')

@section('content')

  <div id="recipe-import">

    <div class="title">
      <h1>Import Recipe</h1>
    </div>

    <div id="recipe-form-content">
      @if(session('message'))
        <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.<br><br>
          <ul>
            <li>{!! session('message') !!}</li>
          </ul>
        </div>
      @endif

      {!! Form::open(array('url' => '/recipe/import', 'class' => 'recipe-form', 'method' => 'POST')) !!}
        <section class="col-md-3 left-column">
            <div>
            Url: {!! Form::textarea('url') !!}
            </div>

            <div class="button-wrap">
              <div class="button">
                {!! Form::submit('Create', array('class' => 'btn recipe-submit-button')) !!}
              </div>
            </div>
            <div class="button-wrap">
              <div class="button">
                {!! Form::reset('Clear', array('class' => 'btn')) !!}
              </div>
            </div>
          </div>
        </section>
      {!! Form::close() !!}
    </div>
  </div>

@endsection
