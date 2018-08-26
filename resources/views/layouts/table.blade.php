<div class="card-body">
  <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
      <thead>
        <tr>
          <th>Title</th>
          <th>tanggal</th>
          <th>content</th>
          <th>Option</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Title</th>
          <th>tanggal</th>
          <th>content</th>
          <th>Option</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach($archives as $archive)
          <tr>
            <td>{{ $archive['title'] }}</td>
            <td>{{ $archive['created_at'] }}</td>
            <!-- <td>{!! $archive['content'] !!}</td> -->
            <td>{!! substr(strip_tags($archive['content']), 0, 250) !!} <strong>. . . . .</strong></td>
            <td>
                <div class="row">
                    <div class="col">
                        <a href="{{ url('article').'/'.$archive['id'] }}" class="btn btn-primary btn-sm" target="_blank" title="Detail" style="width: 70px"><i class="fa fa-external-link"></i> detail</a>
                    </div>
                    <div class="col">
                        <a href="{{ url('article/edit').'/'.$archive['id'] }}" class="btn btn-warning btn-sm" title="Edit" style="width: 70px"><i class="fa fa-edit"></i> edit</a>
                    </div>
                    <div class="col">
                        <a class="btn btn-danger btn-sm" title="Delete" onclick="open_delete_modal({{ $archive['id'] }})" style="width: 70px"><i class="fa fa-remove"></i> delete</a>
                    </div>
                </div>
            </td>
          </tr>  
        @endforeach
      </tbody>
    </table>
  </div>
</div>