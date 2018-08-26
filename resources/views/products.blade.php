@extends('layouts.apptemp')

@section('content')

<div class="container">

    <form class="form-horizontal" method="POST" action="{{ route('products-update') }}">
        {{ csrf_field() }}
        
        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
            <table class="table">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col">Product Category</th>
                    <th scope="col">Status</th> 
                  </tr>
                </thead>
                <tbody>
                    @foreach($subscribed as $sub)
                        <tr>
                          <td>{{ $sub->name }}</td>
                          <td><input type="checkbox" name="category[]" value="{{ $sub->id }}" checked></td> 
                        </tr>
                    @endforeach
                    @foreach($unsubscribed as $unsub)
                        <tr>
                          <td>{{ $unsub->name }}</td>
                          <td><input type="checkbox" name="category[]" value="{{ $unsub->id }}"></td> 
                        </tr>
                    @endforeach
                </tbody>
            </table>
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