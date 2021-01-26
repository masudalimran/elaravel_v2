<!DOCTYPE html>
<html lang="en">

<head>
    <title>Expense Sheet</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('public/backend/pdf/images/icons/favicon.ico')}}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/pdf/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('public/backend/pdf/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}"> --}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/pdf/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/pdf/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/pdf/vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/pdf/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/backend/pdf/css/main.css')}}">
    <!--===============================================================================================-->
</head>

<body>
    @php
         $month_name = "";
    @endphp

    <div class="limiter" >
        <div class="container-table100" style="background: white">
            <div class="wrap-table100" >
                <h1 style="text-align: center;"> <b> BISMIB TECHNOLOGY </b> </h1>

                <h3 style="text-align: center;">Expense Sheet</h3>
                @if ($month == 0)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">January</h3>
                        @php
                            $month_name = "January";
                        @endphp
                    @elseif($month == 1)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">February</h3>
                        @php
                            $month_name = "February";
                        @endphp
                    @elseif($month == 2)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">March</h3>
                        @php
                            $month_name = "March";
                        @endphp
                    @elseif($month == 3)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">April</h3>
                        @php
                            $month_name = "April";
                        @endphp
                    @elseif($month == 4)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">May</h3>
                        @php
                            $month_name = "May";
                        @endphp
                    @elseif($month == 5)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">June</h3>
                        @php
                            $month_name = "June";
                        @endphp
                    @elseif($month == 6)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">July</h3>
                        @php
                            $month_name = "July";
                        @endphp
                    @elseif($month == 7)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">August</h3>
                        @php
                            $month_name = "August";
                        @endphp
                    @elseif($month == 8)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">September</h3>
                        @php
                            $month_name = "September";
                        @endphp
                    @elseif($month == 9)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">October</h3>
                        @php
                            $month_name = "October";
                        @endphp
                    @elseif($month == 10)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">November</h3>
                        @php
                            $month_name = "November";
                        @endphp
                    @elseif($month == 11)
                        <h3 style="text-align: center;"> <button class="badge badge-danger">December</h3>
                        @php
                            $month_name = "December";
                        @endphp
                    @endif

                <h4 style="text-align: center;"><button class="badge badge-pill badge-success"> Total: {{numberFormat($total)}}</button></h4>
                <div style="display: flex; justify-content: center;">
                    <button class="btn btn-sm btn-light" style="margin: 5px">Download CSV (coming soon)</button>
                    <a href="{{route('download.expense.pdf',[$month_name, $month])}}"><button class="btn btn-sm btn-primary" style="margin: 5px">Download PDF</button></a>
                </div>
                <hr>
                {{-- Table 1 --}}
                <div class="table">

                    <div class="row header">
                        <div class="cell">
                            Date
                        </div>
                        <div class="cell">
                            Title
                        </div>
                        <div class="cell">
                            Amount
                        </div>
                        <div class="cell">
                            In details
                        </div>
                    </div>

                    @foreach ($expense_table_data_month as $item)


                    <div class="row">
                        <div class="cell" data-title="Full Name">
                            {{YmdTodmY($item->exp_date)}}
                        </div>
                        <div class="cell" data-title="Age">
                            {{$item->category_name}}
                        </div>
                        <div class="cell" data-title="Job Title">
                            {{numberFormat($item->exp_amount)}}
                        </div>
                        <div class="cell" data-title="Location">
                            {{$item->exp_comment}}
                        </div>
                    </div>
                    @endforeach

                </div>
                <br>

                {{-- Table 2 --}}
                <div class="table">

                    <div class="row header">
                        <div class="cell">
                            Expense Title
                        </div>
                        <div class="cell">
                            Qty
                        </div>
                        <div class="cell">
                            Total
                        </div>
                    </div>
                    @php
                        $cat_counter = -1
                    @endphp
                    @foreach ($get_category as $item)
                    @php
                        $cat_counter ++;
                    @endphp
                    @if ($category_count[$cat_counter] == 0)
                    @else
                    <div class="row">
                        <div class="cell" data-title="Full Name">
                            {{$item->exp_category}}
                        </div>
                        <div class="cell" data-title="Age">
                            {{$category_count[$cat_counter]}}
                        </div>
                        <div class="cell" data-title="Job Title">
                            {{numberFormat($category_amount[$cat_counter])}}
                        </div>
                    </div>

                    @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{asset('public/backend/pdf/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/pdf/vendor/bootstrap/js/popper.js')}}"></script>
    <script src="{{asset('public/backend/pdf/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/pdf/vendor/select2/select2.min.js')}}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('public/backend/pdf/js/main.js')}}"></script>

</body>

</html>
