@extends('layouts.apptemp')

@section('content')

<div class="container">

    <form class="form-horizontal" method="POST" action="{{ route('profile-update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <label for="username" class="col-md-4 control-label">Username</label>

            <div class="col-md-6">
                <input id="username" type="text" class="form-control" name="username" value="{{ $profile->user->username }}" disabled>

                @if ($errors->has('username'))
                    <span class="help-block">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="col-md-4 control-label">Email</label>

            <div class="col-md-6">
                <input id="email" type="text" class="form-control" name="email" value="{{ $profile->user->email }}" disabled>

                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $profile->name }}">

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('contact') ? ' has-error' : '' }}">
            <label for="contact" class="col-md-4 control-label">Contact</label>

            <div class="col-md-6">
                <!-- <textarea id="contact" class="form-control" name="contact" required></textarea> -->
                <div class="input-group mb-3">
                    <input id="contact" type="text" class="form-control" name="contact" value="{{ $profile->contact }}">
                </div>

                @if ($errors->has('contact'))
                    <span class="help-block">
                        <strong>{{ $errors->first('contact') }}</strong>
                    </span>
                @endif
            </div>
        </div>

         <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
            <label for="address" class="col-md-4 control-label">Address</label>

            <div class="col-md-6">
                <!-- <textarea id="address" class="form-control" name="address" required></textarea> -->
                <div class="input-group mb-3">
                    <textarea id="address" class="form-control" name="address" required>{{ $profile->address }}</textarea>
                    <!-- <input id="address" type="text" class="form-control" name="address" value="{{ $profile->address }}" disabled> -->
                </div>

                @if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('bank_account') ? ' has-error' : '' }}">
            <label for="bank_account" class="col-md-4 control-label">Bank Account</label>

            <div class="col-md-6">
                <!-- <textarea id="bank_account" class="form-control" name="bank_account" required></textarea> -->
                <div class="input-group mb-3">
                    <input id="bank_account" type="text" class="form-control" name="bank_account" value="{{ $profile->bank_account }}">
                </div>

                @if ($errors->has('bank_account'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bank_account') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>
        </div>
    </form>
</div>

<script type='text/javascript'>
      function preview_image(event) 
      {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('output_image');
          output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>



@endsection