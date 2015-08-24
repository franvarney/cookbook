@extends('../templates/master')

@section('content')
  <div id="recipe-show">

    <div class="title">
      <h1>
        {!! $contents->recipe->title !!}
        <p><a href="/recipe/{!! $contents->recipe->id !!}/edit">Edit</a></p>
        <p><a href="/recipe/{!! $contents->recipe->id !!}/delete">Delete</a></p>
        @if($contents->favorite)
          <p><a href="/unfavorite/{!! $contents->favorite !!}">Unfavorite</a></p>
        @else
          <p><a href="/favorite/{!! Auth::user()->id !!}/{!! $contents->recipe->id !!}">Favorite</a></p>
        @endif
      </h1>
    </div>

    {{--$contents->recipe->details->cookbook->name--}}

    <div id="recipe-content">

      <section class="col-md-3 left-column">

        <section class="col-md-12" id="details">
          <ul>
            <li>
              Yields: {!! $contents->recipe->yields !!}
            </li>
            <li>
              Prep Time: {!! $contents->recipe->prep_time !!}
            </li>
            <li>
              Cook Time: {!! $contents->recipe->cook_time !!}
            </li>
            <li>
              By: <a href="{!! $contents->recipe->creator->url !!}" class="username">{!! $contents->recipe->creator->username !!}</a>
            </li>
            <li>
               On: {!! $contents->recipe->created !!}
            </li>
          </ul>
        </section>

        {{--<section class="col-md-12" id="tags">
          <p>Tags:
            @foreach($contents->recipe->tags as $key => $tags)
              <a href="search/tag/{!! $tags->tag->tag !!}">{{ $tags->tag->tag }}</a>@if($key + 1 !== count($contents->recipe->tags)),&nbsp;
              @endif
            @endforeach
          </p>
        </section>--}}

        <section class="col-md-12" id="variations">
          <div class="sub-title">
            <h2 class="medium">
              Variations
            </h2>
          </div>
          <ul>
            <li>
              <a href="" class="recipe-title">Chicken Soup</a>
              <img src="http://s3.amazonaws.com/gmi-digital-library/fb1058e3-3850-408e-8d4a-885e02dca10c.jpg" />
            </li>
            <li>
              <a href="" class="recipe-title">Hearty Chicken Soup</a>
              <img src="http://assets.freshandeasy.com/media/446132/100026291_true_1_976x732.jpg" />
            </li>
          </ul>
        </section>

      </section>

      <section class="col-md-9 right-column">

        @if($contents->recipe->description !== null)
          <section class="col-md-12" id="description">
            <p>{!! $contents->recipe->description !!}</p>
          </section>
        @endif

        <section class="col-md-4" id="ingredients">
          <div class="sub-title">
            <h2 class="dark">Ingredients</h2>
          </div>
          <ul>
            @foreach($contents->recipe->ingredients as $ingredients)
              <li>
                {!! $ingredients->full !!}
              </li>
            @endforeach
          </ul>
          <div class="button-wrap">
            <div class="button">
              <a href="/substitution/create">
                Add Substitution
              </a>
            </div>
          </div>
        </section>

        <div class="col-md-8">
          <section id="image">
            <img src="http://clv.h-cdn.co/assets/cm/15/10/980x490/54f4a5bf1042a_-_chicken-noodle-soup-recipe.jpg" />
          </section>
          <section id="directions">
            <div class="sub-title">
              <h2 class="dark">Directions</h2>
            </div>
            <ul>
              @foreach($contents->recipe->directions as $key => $directions)
                <li>
                  <span class="step">{!! $key + 1 !!}.</span> {!! $directions->direction !!}
                </li>
              @endforeach
            </ul>
          </section>
        </div>

        <section class="col-md-12" id="description">
          <div class="sub-title">
            <h2 class="medium">
              Comments
            </h2>
          </div>
        </section>

      </section>
    </div>
  </div>
@endsection
