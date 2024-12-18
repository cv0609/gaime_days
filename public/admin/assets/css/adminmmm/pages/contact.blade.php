@extends('admin.layout.main')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Contact Us List</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">Data</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              {{-- <h5 class="card-title">Datatables</h5>
              <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable. Check for <a href="https://fiduswriter.github.io/simple-datatables/demos/" target="_blank">more examples</a>.</p> --}}

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      S.No
                    </th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th data-type="date" data-format="YYYY/DD/MM">Date</th>
                  </tr>
                </thead>
                <tbody>
                @php
                    $sno = 1;
                @endphp

                  @foreach($contact as $value)
                    <tr>
                        <td>{{ $sno }}</td>
                        <td>{{ $value->full_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->subject }}</td>
                        <td>{{ $value->message }}</td>
                        <td>{{ $value->created_at }}</td>
                    </tr>

                    @php
                        $sno++;
                    @endphp
                  @endforeach
               
                 
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

@endsection

@section('custom-script')

@endsection
