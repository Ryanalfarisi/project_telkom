@extends('layouts.app', ['activePage' => 'table', 'titlePage' => __('Table List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary" style="background: #76ebac !important;">
            <h4 class="card-title font-weight-bold">List pengajuan lembur</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                <thead class=" text-primary">
                  <th>
                    ID
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Posisi
                  </th>
                  <th>
                  Description
                  </th>
                  <th>
                    Lembur on
                  </th>
                  <th>
                    Lembur off
                  </th>
                  <th>
                    Insert date
                  </th>
                  <th>
                    Status
                  </th>
                  <th>
                  Approver
                  </th>
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
      <!-- <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0"> Table on Plain Background</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="">
                  <th>
                    ID
                  </th>
                  <th>
                    Name
                  </th>
                  <th>
                    Country
                  </th>
                  <th>
                    City
                  </th>
                  <th>
                    Salary
                  </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      Dakota Rice
                    </td>
                    <td>
                      Niger
                    </td>
                    <td>
                      Oud-Turnhout
                    </td>
                    <td>
                      $36,738
                    </td>
                  </tr>
                  <tr>
                    <td>
                      2
                    </td>
                    <td>
                      Minerva Hooper
                    </td>
                    <td>
                      Curaçao
                    </td>
                    <td>
                      Sinaai-Waas
                    </td>
                    <td>
                      $23,789
                    </td>
                  </tr>
                  <tr>
                    <td>
                      3
                    </td>
                    <td>
                      Sage Rodriguez
                    </td>
                    <td>
                      Netherlands
                    </td>
                    <td>
                      Baileux
                    </td>
                    <td>
                      $56,142
                    </td>
                  </tr>
                  <tr>
                    <td>
                      4
                    </td>
                    <td>
                      Philip Chaney
                    </td>
                    <td>
                      Korea, South
                    </td>
                    <td>
                      Overland Park
                    </td>
                    <td>
                      $38,735
                    </td>
                  </tr>
                  <tr>
                    <td>
                      5
                    </td>
                    <td>
                      Doris Greene
                    </td>
                    <td>
                      Malawi
                    </td>
                    <td>
                      Feldkirchen in Kärnten
                    </td>
                    <td>
                      $63,542
                    </td>
                  </tr>
                  <tr>
                    <td>
                      6
                    </td>
                    <td>
                      Mason Porter
                    </td>
                    <td>
                      Chile
                    </td>
                    <td>
                      Gloucester
                    </td>
                    <td>
                      $78,615
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> -->
    </div>
  </div>
</div>
@endsection