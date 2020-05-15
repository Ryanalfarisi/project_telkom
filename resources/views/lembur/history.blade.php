@extends('layouts.app', ['activePage' => 'history', 'titlePage' => __('History Overtime')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="table_lembur">
                <thead class="">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Posisi</th>
                  <th>Description</th>
                  <th>Lembur on</th>
                  <th>Lembur off</th>
                  <th>Insert date</th>
                  <th>Status</th>
                  <th>Approver</th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      Jhon doe
                    </td>
                    <td>
                      Staff
                    </td>
                    <td>
                    <p>Lembur antr engineer kunjungan ke customer </p>
                    </td>
                    <td>
                      10 Mei 2020 17:00:00
                    </td>
                    <td>
                      10 Mei 2020 20:00:00
                    </td>
                    <td>
                      12 Mei 2020 12:00:00 
                    </td>
                    <td>
                    <span class="badge badge-warning">On process</span>
                    </td>
                    <td>
                    Susilo
                    </td>
                  </tr>
                  <tr>
                    <td>
                      2
                    </td>
                    <td>
                      Alex
                    </td>
                    <td>
                      Staff
                    </td>
                    <td>
                    <p>Lembur antr engineer kunjungan ke customer </p>
                    </td>
                    <td>
                      10 Mei 2020 17:00:00
                    </td>
                    <td>
                      10 Mei 2020 20:00:00
                    </td>
                    <td>
                      12 Mei 2020 12:00:00 
                    </td>
                    <td>
                    <span class="badge badge-success">Approved</span>
                    </td>
                    <td>
                    Ramadina
                    </td>
                  </tr>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                      Deby
                    </td>
                    <td>
                      Staff
                    </td>
                    <td>
                    <p>Lembur input data customer cluster baru </p>
                    </td>
                    <td>
                      10 Mei 2020 17:00:00
                    </td>
                    <td>
                      10 Mei 2020 20:00:00
                    </td>
                    <td>
                      12 Mei 2020 12:00:00 
                    </td>
                    <td>
                    <span class="badge badge-danger">Reject</span>
                    </td>
                    <td>
                    Ramadina
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('js')
  <script>
    $(document).ready(function() {
      $(document).ready( function () {
    $('#table_lembur').DataTable();
} );
    });
  </script>
@endpush