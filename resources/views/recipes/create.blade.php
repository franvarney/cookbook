@extends('../../templates/master')

@section('content')

  <div id="recipe-create">

    <div class="title">
      <h1>Create Recipe</h1>
    </div>

    <div id="recipe-form-content">

      <section class="col-md-3 left-column">

      </section>

      <section class="col-md-9 right-column">
        <div id="recipe-form-wrap">{{-- See Reactjs --}}
          {!! Form::open(array('url' => '/recipe', 'class' => 'recipe-form')) !!}
            {!! Form::hidden('user_id', 1) !!}{{-- TODO Add auth id --}}
            {!! Form::hidden('cookbook_id', 1) !!}{{-- TODO Add select list --}}
            <div class="sub-title">
              <h2 class="dark">Details</h2>
            </div>
            <ul>
              <li>Title: {!! Form::text('title') !!}</li>
              <li>Description: {!! Form::text('description') !!}</li>
              <li>Prep Time: {!! Form::text('prep_time') !!}</li>
              <li>Cook Time: {!! Form::text('cook_time') !!}</li>
              <li>
                Yields: {!! Form::text('yields_amount', null,
                            array('placeholder' => 'amount')) !!}
                        {!! Form::text('unit', null,
                            array('placeholder' => 'units')) !!}
              </li>
              <li>Tags: {!! Form::text('recipe_tags') !!}</li>
            </ul>

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
          {!! Form::close() !!}
        </div>
      </section>
    </div>
  </div>

@endsection