@extends('admin.admin_layouts')
@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script> --}}

    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{ url('admin/show_attendance') }}">View Employee Attendance sheet </a>
            <span class="breadcrumb-item active">View Employee Attendance sheet </span>
        </nav>

        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>View Employee Attendance sheet</h5>
                <p>Here below is the Employee Attendance sheet</p>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Here you can find all Employee Attendance sheet</h6>
                <p class="mg-b-20 mg-sm-b-30">Searching, ordering and paging goodness will be immediately added to the
                    table, as shown in this example.</p>
                @php
                    $exp_counter = -1;
                @endphp
                {{-- {{dd($employee_table_data)}} --}}
                @foreach ($employee_table_data as $perYear)
                    @php
                        $exp_counter++;
                        // dd($exp_counter);
                    @endphp
                    <div class="table-wrapper">
                        @if ($exp_counter == 0)
                            <h1 style="text-decoration: underline; color: red">January</h1>
                        @elseif($exp_counter == 1)
                            <h1 style="text-decoration: underline; color: red">February</h1>
                        @elseif($exp_counter == 2)
                            <h1 style="text-decoration: underline; color: red">March</h1>
                        @elseif($exp_counter == 3)
                            <h1 style="text-decoration: underline; color: red">April</h1>
                        @elseif($exp_counter == 4)
                            <h1 style="text-decoration: underline; color: red">May</h1>
                        @elseif($exp_counter == 5)
                            <h1 style="text-decoration: underline; color: red">June</h1>
                        @elseif($exp_counter == 6)
                            <h1 style="text-decoration: underline; color: red">July</h1>
                        @elseif($exp_counter == 7)
                            <h1 style="text-decoration: underline; color: red">August</h1>
                        @elseif($exp_counter == 8)
                            <h1 style="text-decoration: underline; color: red">September</h1>
                        @elseif($exp_counter == 9)
                            <h1 style="text-decoration: underline; color: red">October</h1>
                        @elseif($exp_counter == 10)
                            <h1 style="text-decoration: underline; color: red">November</h1>
                        @elseif($exp_counter == 11)
                            <h1 style="text-decoration: underline; color: red">December</h1>
                        @endif
                        {{-- <h4 style="color:blue">Total: {{numberFormat($expense_total[$exp_counter])}} Taka</h4> --}}
                        {{-- <a href="{{route('view.before.download.pdf',[$exp_counter])}}"><button class="btn btn-success"> View As PDF </button></a> --}}
                        {{-- <hr> --}}
                        <table id="datatable{{ $exp_counter + 1 }}" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th style="text-align: center" class="wd-5p">Id</th>
                                    <th style="text-align: center" class="wd-10p">Employee Name</th>
                                    <th style="text-align: center" class="wd-10p">Designation</th>
                                    <th style="text-align: center" class="wd-5p">Date</th>
                                    <th style="text-align: center" class="wd-5p">Count</th>
                                    <th style="text-align: center" class="wd-5p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $month_counter= 0;
                                @endphp
                                @foreach ($perYear as $row)

                                @php
                                    $date=$row->attendance_date;
                                    $exploded_attendance_date = explode('::::', $date);
                                    $attendance_date_count = count($exploded_attendance_date);
                                    // dd($exp_image_count)
                                    $month_counter++;
                                @endphp

                                @php
                                    $date_total=cal_days_in_month(CAL_GREGORIAN,$month_counter,2021);
                                @endphp
                                {{-- {{dd($d)}} --}}
                                {{-- {{dd(CarbonInterval::week())}} --}}

                                    {{-- {{dd($row)}} --}}
                                    {{-- @foreach ($row as $item)
                                        {{dd($item->emp_name)}}
                                    @endforeach --}}
                                    {{-- <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-headingOne">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                    aria-expanded="false" aria-controls="flush-collapseOne">
                                                    Accordion Item #1
                                                </button>
                                            </h2>
                                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                                aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">



                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <tr>
                                        <td style="text-align: center">{{ $row->id }}</td>
                                        <td style="text-align: center">{{ $row->emp_name }}</td>
                                        <td style="text-align: center">{{ $row->emp_designation }}</td>
                                        <td style="text-align: center">
                                        @if ($row->attendance_date)
                                            @foreach ($exploded_attendance_date as $v_date)
                                            {{-- {{dd($v_date)}} --}}
                                                {{ YmdTodmYPmdMyPM($v_date) }}
                                                <br>
                                            @endforeach
                                        @endif
                                    </td>

                                        <td style="text-align: center">{{ $attendance_date_count }} OUT OF {{$date_total}}</td>
                                        <td style="white-space: nowrap;">
                                            <a href="{{ URL::to('admin/delete/employee/' . $row->id) }}"
                                                class="btn btn-sm btn-danger" id="delete"
                                                style="margin-left:35%;">Delete</a>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
                @endforeach


            </div><!-- card -->
        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
