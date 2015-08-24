@extends('../../templates/master')

@section('content')

  <div id="recipe-edit">

    <div class="title">
      <h1>Edit Recipe</h1>
    </div>

    <div id="recipe-form-content">
      {!! Form::open(array('url' => '/recipe/' . $contents->recipe->id, 'class' => 'recipe-form', 'method' => 'PUT')) !!}
        <section class="col-md-3 left-column">
          {!! Form::hidden('user_id', Auth::user()->id) !!}
          {!! Form::select('cookbook_id', $contents->cookbooks, $contents->recipe->cookbook->id) !!}
          <div class="sub-title">
            <h2 class="dark">Details</h2>
          </div>
          <ul>
            <li>Title: {!! Form::text('title', $contents->recipe->title) !!}</li>
            <li>Prep Time: {!! Form::text('prep_time', explode(' ', $contents->recipe->prep_time)[0]) !!} {!! Form::select('prep_time_units', array('seconds' => 'Seconds', 'minutes' => 'Minutes', 'hours' => 'Hours', 'days' => 'Days', 'weeks' => 'Weeks', 'months' => 'Months'), explode(' ', $contents->recipe->prep_time)[1]) !!}</li>
            <li>Cook Time: {!! Form::text('cook_time', explode(' ', $contents->recipe->cook_time)[0]) !!} {!! Form::select('cook_time_units', array('seconds' => 'Seconds', 'minutes' => 'Minutes', 'hours' => 'Hours', 'days' => 'Days', 'weeks' => 'Weeks', 'months' => 'Months'), explode(' ', $contents->recipe->cook_time)[1]) !!}</li>
            <li>
              Yields: {!! Form::text('yields_amount', explode(' ', $contents->recipe->yields)[0],
                          array('placeholder' => 'amount')) !!}
                      {!! Form::text('unit', explode(' ', $contents->recipe->yields)[1],
                          array('placeholder' => 'units')) !!}
            </li>
            <li>Tags: {!! Form::text('recipe_tags', $contents->recipe->tags) !!}</li>
          </ul>
        </section>

        <section class="col-md-9 right-column">
          <div id="recipe-form-wrap">
            <p>Description: {!! Form::textarea('description', $contents->recipe->description) !!}</p>

            {{-- <div id="ingredient-wrap"></div> --}}
            {{-- <div id="direction-wrap"></div> --}}

            <div class="sub-title">
              <h2 class="dark">Ingredients</h2>
            </div>
            <ul id="add-ingredients">
              @foreach($contents->recipe->ingredients as $ingredient)
                <li>Ingredient:
                  {!! Form::text('recipe_ingredient[amount][]', $ingredient->amount, array('placeholder' => 'amount')) !!}
                  {!! Form::text('recipe_ingredient[unit][]', $ingredient->unit, array('placeholder' => 'unit')) !!}
                  {!! Form::text('recipe_ingredient[ingredient][]', $ingredient->ingredient, array('placeholder' => 'ingredient')) !!}
                  {!! Form::select('recipe_ingredient[optional][]', array('0' => 'No', '1' => 'Yes'), $ingredient->optional) !!}
                  <a class="remove-ingredient">X</a>
                </li>
              @endforeach
            </ul>
            <p id="ingredient-button-wrap">
              <a id="add-ingredient">Add Ingredient</a>
            </p>

            <div class="sub-title">
              <h2 class="dark">Directions</h2>
            </div>
            <ul id="add-directions">
              @foreach($contents->recipe->directions as $direction)
                <li>Direction: {!! Form::textarea('recipe_direction[direction][]', $direction->direction) !!}<a class="remove-direction">X</a></li>
              @endforeach
            </ul>
            <p id="direction-button-wrap">
              <a id="add-direction">Add Direction</a>
            </p>

            <div class="button-wrap">
              <div class="button">
                {!! Form::submit('Submit', array('class' => 'btn recipe-submit-button')) !!}
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
