@extends('../../templates/master')

@section('content')

  <div id="recipe-create">

    <div class="title">
      <h1>Create Recipe</h1>
    </div>

    <div id="recipe-form-content">

      {!! Form::open(array('url' => '/recipe', 'class' => 'recipe-form', 'method' => 'POST')) !!}
        <section class="col-md-3 left-column">
          {!! Form::hidden('user_id', Auth::user()->id) !!}
          {!! Form::select('cookbook_id', $contents->cookbooks, 'Choose...') !!}
          <div class="sub-title">
            <h2 class="dark">Details</h2>
          </div>
          <ul>
            <li>Title: {!! Form::text('title') !!}</li>
            <li>Prep Time: {!! Form::text('prep_time') !!} {!! Form::select('prep_time_units', array('seconds' => 'Seconds', 'minutes' => 'Minutes', 'hours' => 'Hours', 'days' => 'Days', 'weeks' => 'Weeks', 'months' => 'Months'), 'minutes') !!}</li>
            <li>Cook Time: {!! Form::text('cook_time') !!} {!! Form::select('cook_time_units', array('seconds' => 'Seconds', 'minutes' => 'Minutes', 'hours' => 'Hours', 'days' => 'Days', 'weeks' => 'Weeks', 'months' => 'Months'), 'minutes') !!}</li>
            <li>
              Yields: {!! Form::text('yields_amount', null,
                          array('placeholder' => 'amount')) !!}
                      {!! Form::text('unit', null,
                          array('placeholder' => 'units')) !!}
            </li>
            <li>Tags: {!! Form::text('recipe_tags') !!}</li>
          </ul>
        </section>

        <section class="col-md-9 right-column">
          <div id="recipe-form-wrap">
            <p>Description: {!! Form::textarea('description') !!}</p>

            {{-- <div id="ingredient-wrap"></div> --}}
            {{-- <div id="direction-wrap"></div> --}}

            <div class="sub-title">
              <h2 class="dark">Ingredients</h2>
            </div>
            <ul id="add-ingredients">
              <li>Ingredient:
                {!! Form::text('recipe_ingredient[amount][]', null, array('placeholder' => 'amount')) !!}
                {!! Form::text('recipe_ingredient[unit][]', null, array('placeholder' => 'unit')) !!}
                {!! Form::text('recipe_ingredient[ingredient][]', null, array('placeholder' => 'ingredient')) !!}
                {!! Form::select('recipe_ingredient[optional][]', array('0' => 'No', '1' => 'Yes'), '0') !!}
                <a class="remove-ingredient">X</a>
              </li>
            </ul>
            <p id="ingredient-button-wrap">
              <a id="add-ingredient">Add Ingredient</a>
            </p>

            <div class="sub-title">
              <h2 class="dark">Directions</h2>
            </div>
            <ul id="add-directions">
              <li>Direction: {!! Form::textarea('recipe_direction[direction][]') !!}<a class="remove-direction">X</a></li>
            </ul>
            <p id="direction-button-wrap">
              <a id="add-direction">Add Direction</a>
            </p>

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
