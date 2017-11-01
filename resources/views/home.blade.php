@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="bg-light-grey">
                <form class="form-horizontal" action="{{ url('twit') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                        <div class="col-md-12">
                            <input id="status" type="text" class="form-control input-tall " name="status" value="{{ old('status') }}" placeholder="Say something..." maxlength="255" autofocus/>
                            @if ($errors->has('status'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary btn-sm">
                              Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="timeline">
            @foreach ($twits as $twit)
                @if ($twit->user_id == Auth::user()->id)
                  <div class="twit right bg-light-green">
                @else
                  <div class="twit left bg-white">
                @endif
                    <img class="twit-avatar" src="{{ asset('assets/img/' . $twit->avatar) }}" alt="{{ $twit->name }}">
                    <div class="message">
                        <p class="message-user">{{ $twit->name }}</p>
                        <span class="message-content">
                        {{ $twit->message }}
                        </span>
                    </div>
                  </div>
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
