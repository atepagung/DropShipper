@extends('layouts.apptemp')

@section('content')

<div class="container">

    <form class="form-horizontal" method="POST" action="{{ route('store-update') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="name" class="col-md-4 control-label">Name</label>

            <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ $store->name }}" disabled>

                @if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
            <label for="url" class="col-md-4 control-label">URL</label>

            <div class="col-md-6">
                <!-- <textarea id="url" class="form-control" name="url" required></textarea> -->
                <div class="input-group mb-3">
                    <input id="url" type="text" class="form-control" name="url" value="{{ $store->url }}" disabled>                  
                </div>

                @if ($errors->has('url'))
                    <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
            <label for="logo" class="col-md-4 control-label">Logo</label>

            <div class="col-md-6">
                <img src="{{ url('').'/storage/'.$store->logo }}" id="output_image" width="90px"/>
                <br>
                <input type="file" name="logo" onchange="preview_image(event)">

                @if ($errors->has('logo'))
                    <span class="help-block">
                        <strong>{{ $errors->first('logo') }}</strong>
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