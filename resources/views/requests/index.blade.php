@extends('../../templates/master')

@section('content')

  <div id="request-index">

    <div class="title">
      <h1>Requests</h1>
    </div>

    <div class="requests">
      <div>
        <h2>Send a request</h2>
          {!! Form::open(array('url' => '/request', 'class' => 'request-form', 'method' => 'POST')) !!}
            {!! Form::hidden('user_id', Auth::user()->id) !!}
            <p>Select a cookbook: {!! Form::select('cookbook_id', $contents->cookbooks, 'Choose...') !!}</p>
            <p>User: {!! Form::text('receiver_user') !!}
            <div class="button-wrap">
              <div class="button">
                {!! Form::submit('Create', array('class' => 'btn request-submit-button')) !!}
              </div>
            </div>
            <div class="button-wrap">
              <div class="button">
                {!! Form::reset('Clear', array('class' => 'btn')) !!}
              </div>
            </div>
          {!! Form::close() !!}
      </div>
      <h2>Received</h2>
      <ul>
      @foreach($contents->received->requests as $received)
        @if($received->approved == 0)
          <li>
            Request from {!! $received->sender->username !!} to join {!! $received->cookbook->name !!}
            <a href="/request/{!! $received->sender->id !!}/approve">Approve</a>
            <a href="/request/{!! $received->sender->id !!}/deny">Deny</a>
          </li>
        @endif
      @endforeach
      </ul>

      <h2>Sent</h2>
      <ul>
      @foreach($contents->sent->requests as $sent)
        @if($sent->approved == 0)
          <li>
            Request to {!! $sent->receiver->username !!} to join {!! $sent->cookbook->name !!}
            <a href="/request/{!! $received->sender->id !!}/cancel">Cancel</a>
          </li>
        @endif
      @endforeach
      </ul>
    </div>
  </div>

@endsection
