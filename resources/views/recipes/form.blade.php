
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

  <div id="ingredient-wrap"></div>

  <div id="direction-wrap"></div>

  {{-- <h3>Ingredients</h3>
  <ul id="add-ingredients">
    <li>Ingredient:
      {!! Form::text('recipe_ingredient[amount][]', null, array('placeholder' => 'amount')) !!}
      {!! Form::text('recipe_ingredient[unit][]', null, array('placeholder' => 'unit')) !!}
      {!! Form::text('recipe_ingredient[ingredient][]', null, array('placeholder' => 'ingredient')) !!}
      {!! Form::select('recipe_ingredient[optional][]', array('0' => 'No', '1' => 'Yes'), '0') !!}
    </li>
  </ul>
  <p id="ingredient-button-wrap"></p> --}}

  {{-- <h3>Directions</h3>
  <ul>
    <li>Direction: {!! Form::textarea('recipe_direction[direction][]') !!}</li>
  </ul> --}}

  {!! Form::submit('Create', array('class' => 'btn recipe-submit-button')) !!}
  {!! Form::reset('Clear', array('class' => 'btn')) !!}
