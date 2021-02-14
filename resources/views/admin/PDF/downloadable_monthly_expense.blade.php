<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>
    {{-- {{dd($pdf_data[2])}} --}}
    <img id="watermark" src="{{asset('public/backend/img/BISMIB B ICON_Master color.png')}}"/>

    @php
         $month_name = "";
    @endphp
    <div style="line-height: 10%;">
        <div style="display:inline; float:left;">
            <img src="{{asset('public/backend/img/BISMIB TECHNOLOGY_Master color.png')}}" alt="bismib_logo" style="height: 50xp; width: 50px;">
        </div>
        <h1 style="text-align: center; line-height: 40%; "> <b style="color: blue "> BISMIB TECHNOLOGY </b> </h1>

        <h3 style="text-align: center; text-decoration: underline; line-height: 50%;"> <b style="font-size: 16px"> Expense Sheet</b></h3>
        @if ($pdf_data[2] == 0)
            <h3 style="text-align: center; color: red; line-height: 5%"> January</h3>
            @php
                $month_name = "January";
            @endphp
        @elseif($pdf_data[2] == 1)
            <h3 style="text-align: center; color: red; line-height: 5%"> February</h3>
            @php
                $month_name = "February";
            @endphp
        @elseif($pdf_data[2] == 2)
            <h3 style="text-align: center; color: red; line-height: 5%"> March</h3>
            @php
                $month_name = "March";
            @endphp
        @elseif($pdf_data[2] == 3)
            <h3 style="text-align: center; color: red; line-height: 5%"> April</h3>
            @php
                $month_name = "April";
            @endphp
        @elseif($pdf_data[2] == 4)
            <h3 style="text-align: center; color: red; line-height: 5%"> May</h3>
            @php
                $month_name = "May";
            @endphp
        @elseif($pdf_data[2] == 5)
            <h3 style="text-align: center; color: red; line-height: 5%"> June</h3>
            @php
                $month_name = "June";
            @endphp
        @elseif($pdf_data[2] == 6)
            <h3 style="text-align: center; color: red; line-height: 5%"> July</h3>
            @php
                $month_name = "July";
            @endphp
        @elseif($pdf_data[2] == 7)
            <h3 style="text-align: center; color: red; line-height: 5%"> August</h3>
            @php
                $month_name = "August";
            @endphp
        @elseif($pdf_data[2] == 8)
            <h3 style="text-align: center; color: red; line-height: 5%"> September</h3>
            @php
                $month_name = "September";
            @endphp
        @elseif($pdf_data[2] == 9)
            <h3 style="text-align: center; color: red; line-height: 5%"> October</h3>
            @php
                $month_name = "October";
            @endphp
        @elseif($pdf_data[2] == 10)
            <h3 style="text-align: center; color: red; line-height: 5%"> November</h3>
            @php
                $month_name = "November";
            @endphp
        @elseif($pdf_data[2] == 11)
            <h3 style="text-align: center; color: red; line-height: 5%">  December</h3>
            @php
                $month_name = "December";
            @endphp
        @endif

    {{-- <h4 style="text-align: center; color: blue"> Total: {{numberFormat($pdf_data[1])}}</h4> --}}
    {{-- <hr> --}}
    <h3 style="text-align: left; text-decoration: underline">Expenses</h3>
<table>
  <tr style="background:#c8cde0">
    <th style="width: 90px; font-size: 14px; line-height:50%">Date</th>
    <th style="width: 140px; font-size: 14px; line-height:50%">Title</th>
    <th style="width: 95px; font-size: 14px; line-height:50%">Amount</th>
    <th style="line-height:50%"> In details</th>
  </tr>
    @foreach ($pdf_data[0] as $item)
    <tr class="rm_padding_margin" style="background:white;">
        <td class="rm_padding_margin" style="font-size: 14px; line-height:80%">{{YmdTodmY($item->exp_date)}}</td>
        <td class="rm_padding_margin" style="font-size: 14px; line-height:80%">{{$item->category_name}}</td>
        <td class="rm_padding_margin" style="font-size: 14px; line-height:80%"> {{numberFormat($item->exp_amount)}}</td>
        {{-- @if ({{$item->exp_comment}}) --}}
            <td class="rm_padding_margin" style="font-size: 14px; line-height:80%">{!!$item->exp_comment!!}</td>
        {{-- @endif --}}
        {{-- <td class="rm_padding_margin_without_comment" style="font-size: 14px; line-height:80%">{!!$item->exp_comment!!}</td> --}}
    </tr>
    @endforeach
    <tr style="background:#c8cde0">
        <td style="font-size: 14px; line-height:50%"></td>
        <td style="font-size: 14px; line-height:50%">Total</td>
        <td style="font-size: 14px; line-height:50%"> {{numberFormat($pdf_data[1])}} <span> BDT</span></td>
        <td style="font-size: 14px; line-height:50%"></td>
    </tr>
</table>
<br>
<h3 style="text-align: center; text-decoration: underline">Category</h3>
<table style="margin-left: auto; margin-right: auto; width:50%">
    <tr style="background:#c8cde0">
      <th style="width: 150px; font-size: 14px; line-height:50%">Expense Title</th>
      <th style="width: 30px; font-size: 14px; line-height:50%">Qty</th>
      <th style="width: 80px; font-size: 14px; line-height:50%">Total</th>
    </tr>
    @php
        $cat_counter = -1;
        $sum_cat_counter = 0;
    @endphp
    {{-- {{dd($get_category)}} --}}
  @foreach ($pdf_data[3] as $item)
  @php
        $cat_counter ++;
    @endphp
    @if ($pdf_data[4][$cat_counter] != 0)
        <tr style="background:white;">
            <td style="font-size: 14px; line-height:10%">{{$item->exp_category}}</td>
            <td style="font-size: 14px; line-height:10%">{{$pdf_data[4][$cat_counter]}}</td>
            @php
                $sum_cat_counter = $sum_cat_counter + $pdf_data[4][$cat_counter]
            @endphp
            <td style="font-size: 14px; line-height:10%"> {{numberFormat($pdf_data[5][$cat_counter])}}</td>
        </tr>
    @endif
    @endforeach
    {{-- {{dd($sum_cat_counter)}} --}}
  <tr style="background:#c8cde0">
    <td style="font-size: 14px; line-height:40%">Total</td>
    <td style="font-size: 14px; line-height:40%">{{$sum_cat_counter}}</td>
    <td style="font-size: 14px; line-height:40%">{{numberFormat($pdf_data[1])}} BDT</td>
</tr>
  </table>
  {{-- {{dd('asdadsads')}} --}}
</div>


<style>
    #watermark{
        position:fixed;
        top:25%;
        /* top:25%; */
        left: 25%;
        /* right:25%; */
        opacity:0.07;
        z-index:99;
        color:white;
    }

    .rm_padding_margin{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        line-height: 100% !important;
    }
    .rm_padding_margin_without_comment{
        margin-top: 0px !important;
        margin-bottom: 0px !important;
        padding-top: 0px !important;
        padding-bottom: 0px !important;
        line-height: 100% !important;
    }
</style>

{{-- {{dd()}} --}}

</body>
</html>
