@extends('admin.admin_layouts')
@section('admin_content')
@php
    $image=$expense_table_data->exp_category_image;
    $exp_image = explode('::::', $image);

    $document=$expense_table_data->exp_document;
    $exp_document = explode('::::', $document);
@endphp
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">Admin Panel</a>
            <a class="breadcrumb-item" href="{{ url('admin/view/expense') }}">Expense Sheet</a>
            <span class="breadcrumb-item active">Expense Sheet Details</span>
        </nav>

        {{-- {{dd($expense_table_data)}} --}}
        <div class="sl-pagebody" style="  overflow-x: scroll !important; display: table; width: 100%; height: 100vh">
            <div class="sl-page-title">
                <h5>Expense Sheet Details</h5>
                <p>Here below is the Expense Sheet Details</p>
            </div><!-- sl-page-title -->
            <div class="card">
                <div class="card-header" style="text-align: center">
                  <h3 style="color:red; display:inline"> Expense Title : </h3><h3 style="color:black; display: inline; text-transform: capitalize">{{$expense_table_data->exp_name}}<h3>
                  <h6 style="color:red; display:inline"> Category : </h6><h6 style="color:black; display: inline; text-transform: capitalize">{{$expense_table_data->category_name}}<h6>
                </div>
                <div class="card-body">
                    <table id="datatable1" class="table display responsive nowrap">
                        <tr>
                            <th style="text-align: center">Expense Title</th>
                            <td style="text-align: center">{{$expense_table_data->exp_name}}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Category</th>
                            <td style="text-align: center">{{$expense_table_data->category_name}}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Category Details</th>
                            <td style="text-align: center">{!!$expense_table_data->exp_category_details!!}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Category Image</th>
                            <td style="text-align: center">
                                @foreach($exp_image as $v_exp_image)
                                <div class="text-center" style='display:inline-block; max-height:150px; max-width:150px;'>
                                    <img src="{{asset($v_exp_image)}}" style="max-height:100px; max-width:100px;padding:10px">
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Amount</th>
                            <td style="text-align: center">{{numberFormat($expense_table_data->exp_amount)}} TK</td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Date</th>
                            <td style="text-align: center">{{YmdTodmY($expense_table_data->exp_date)}}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Comment</th>
                            <td style="text-align: center">{!!$expense_table_data->exp_comment!!}</td>
                        </tr>
                        <tr>
                            <th>Expense Documents</th>
                            <td>
                                @foreach($exp_document as $v_exp_document)
                                <div class="text-center" style='display:inline-block; max-height:150px; max-width:150px;'>
                                    <img src="{{asset($v_exp_document)}}" style="max-height:100px; max-width:100px;padding:10px"><br>
                                    {{-- {{dd($v_exp_document)}} --}}
                                    <a href="{{$v_exp_document}}" download="{{$v_exp_document}}"><button class="btn btn-sm btn-primary">Download</button></a>
                                </div>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Created At</th>
                            <td style="text-align: center">{{YmdTodmYPmdMyPM($expense_table_data->created_at)}}</td>
                        </tr>
                        <tr>
                            <th style="text-align: center">Updated At</th>
                            <td style="text-align: center">{{YmdTodmYPmdMyPM($expense_table_data->updated_at)}}</td>
                        </tr>
                    </table>
                </div>
              </div>


        </div><!-- sl-pagebody -->


    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
