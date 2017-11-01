@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading panel-title-modify">Profile</div>
                <div class="panel-body">
                    <div class="col-md-3">
                        <img class="img-responsive rounded-x" src="{{ asset('assets/img/' . Auth::user()->avatar) }}" alt=""><br/>
                        <button class="btn btn-primary text-center btn-sm btn-block" data-toggle="modal" data-target=".form-upload">
                            upload
                        </button>
                        @if ($errors->has('profil_picture'))
                            <span class="help-block">
                                <strong>{{ $errors->first('profil_picture') }}</strong>
                            </span>
                        @endif
                    </div>
                    <br />
                    <div class="col-md-9">
                        <form class="form-horizontal" action="{{ url('profile') . '/' . Auth::user()->name }}" method="POST">
                          {{ csrf_field() }}
                          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <div class="col-md-12">
                                  <input type="hidden" name="_method" value="PUT">
                                  <input id="name" type="text" class="form-control .input-sm" name="name" value="{{ old('name') }}" placeholder="{{ Auth::user()->name }}" autofocus>
                                  @if ($errors->has('name'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('name') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <div class="col-md-12">
                                  <input id="email" type="email" class="form-control .input-sm" name="email" value="{{ old('name') }}" placeholder="{{ Auth::user()->email }}">

                                  @if ($errors->has('email'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('email') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>

                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                              <div class="col-md-12">
                                  <input id="password" type="password" class="form-control .input-sm" name="password" value="{{ old('password') }}" placeholder="password">

                                  @if ($errors->has('password'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('password') }}</strong>
                                      </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <div class="col-md-12 text-right" style="margin-top: -2px">
                                  <button type="submit" class="btn btn-primary btn-sm">
                                      Change
                                  </button>
                              </div>
                          </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade form-upload" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                        <h4 id="myLargeModalLabel3" class="modal-title">Upload Photo</h4>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-sm-12">
                          <form class="form-horizontal" action="{{ url('profile') }}" method="POST" enctype="multipart/form-data">
                              {{ csrf_field() }}
                              <input type="file" name="profil_picture"><br/>
                              <button type="submit" class="btn btn-primary btn-sm" name="submit_btn">submit</button>
                          </form>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
