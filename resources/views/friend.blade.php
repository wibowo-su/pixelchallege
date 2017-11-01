@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="tabs-container">
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"> Friend</a></li>
                <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false">People</a></li>
            </ul>
            <br/>
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                      <div class="panel-body">
                        <ul class="list-group">
                          @foreach ($friends as $friend)
                              <li class="list-group-item">
                                <div class="row">
                                  <div class="col-md-2 text-center">
                                    <img class="friend-avatar" src="{{ asset('assets/img/' . $friend->user->avatar) }}" alt="{{ $friend->user->name }}">
                                  </div>
                                  <div class="col-md-10">
                                    <p class="friend-name">{{ $friend->user->name }}</p>
                                    <form action="{{ url('friend/' . $friend->user->id) }}" method="post" style="margin-top: -10px;">
                                      {{ csrf_field() }}
                                      <button type="submit" class="btn btn-danger btn-xs" name="delete">unfriend</button>
                                      <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                  </div>
                                </div>
                              </li>
                          @endforeach
                        </ul>
                      </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                          <ul class="list-group">
                            @foreach ($people as $person)
                              <li class="list-group-item">
                                <div class="row">
                                  <div class="col-md-2 text-center">
                                    <img class="friend-avatar" src="{{ asset('assets/img/' . $person->avatar) }}" alt="{{ $person->name }}">
                                  </div>
                                  <div class="col-md-10">
                                    <p class="friend-name">{{ $person->name }}</p>
                                    @if ($person->isFriend)
                                      <form action="{{ url('friend/' . $person->id) }}" method="post" style="margin-top: -10px;">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs" name="delete">unfriend</button>
                                        <input type="hidden" name="_method" value="DELETE">
                                      </form>
                                    @else
                                      <form action="{{ url('friend/') }}" method="POST" style="margin-top: -10px;">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="friend_id" value="{{ $person->id }}">
                                        <button type="submit" class="btn btn-primary btn-xs" name="add">add as a friend</button>
                                      </form>
                                    @endif
                                  </div>
                                </div>
                              </li>
                            @endforeach
                          </ul>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection
