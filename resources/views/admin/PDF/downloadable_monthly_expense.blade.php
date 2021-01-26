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
    @php
         $month_name = "";
    @endphp
    <div style="line-height: 35%;">
    <h1 style="text-align: center; line-height: 100%; "> <b style="border: solid#b3e9f5; background: #b3e9f5 "> BISMIB TECHNOLOGY </b> </h1>

    <h3 style="text-align: center; text-decoration: underline; "> <b style="border: solid#a0a6b0; background: #a0a6b0"> Expense Sheet</b></h3>
    @if ($pdf_data[2] == 0)
            <h3 style="text-align: center; color: red;">  January</h3>
            @php
                $month_name = "January";
            @endphp
        @elseif($pdf_data[2] == 1)
            <h3 style="text-align: center; color: red;">  February</h3>
            @php
                $month_name = "February";
            @endphp
        @elseif($pdf_data[2] == 2)
            <h3 style="text-align: center; color: red;">  March</h3>
            @php
                $month_name = "March";
            @endphp
        @elseif($pdf_data[2] == 3)
            <h3 style="text-align: center; color: red;">  April</h3>
            @php
                $month_name = "April";
            @endphp
        @elseif($pdf_data[2] == 4)
            <h3 style="text-align: center; color: red;">  May</h3>
            @php
                $month_name = "May";
            @endphp
        @elseif($pdf_data[2] == 5)
            <h3 style="text-align: center; color: red;">  June</h3>
            @php
                $month_name = "June";
            @endphp
        @elseif($pdf_data[2] == 6)
            <h3 style="text-align: center; color: red;">  July</h3>
            @php
                $month_name = "July";
            @endphp
        @elseif($pdf_data[2] == 7)
            <h3 style="text-align: center; color: red;">  August</h3>
            @php
                $month_name = "August";
            @endphp
        @elseif($pdf_data[2] == 8)
            <h3 style="text-align: center; color: red;">  September</h3>
            @php
                $month_name = "September";
            @endphp
        @elseif($pdf_data[2] == 9)
            <h3 style="text-align: center; color: red;">  October</h3>
            @php
                $month_name = "October";
            @endphp
        @elseif($pdf_data[2] == 10)
            <h3 style="text-align: center; color: red;">  November</h3>
            @php
                $month_name = "November";
            @endphp
        @elseif($pdf_data[2] == 11)
            <h3 style="text-align: center; color: red;">  December</h3>
            @php
                $month_name = "December";
            @endphp
        @endif

    {{-- <h4 style="text-align: center; color: blue"> Total: {{numberFormat($pdf_data[1])}}</h4> --}}
    <hr>
    <h3 style="text-align: center; text-decoration: underline">Expenses</h3>
<table>
  <tr style="background:#c8cde0">
    <th style="width: 90px">Date</th>
    <th>Title</th>
    <th style="width: 60px">Amount</th>
    <th>In details</th>
  </tr>
@foreach ($pdf_data[0] as $item)
<tr style="background:white">
    <td>{{YmdTodmY($item->exp_date)}}</td>
    <td>{{$item->category_name}}</td>
    <td>{{numberFormat($item->exp_amount)}}</td>
    <td>{!!$item->exp_comment!!}</td>
</tr>
@endforeach
<tr style="background:#c8cde0">
    <td></td>
    <td>Total</td>
    <td>{{numberFormat($pdf_data[1])}}</td>
    <td></td>
</tr>
</table>

<br><br><br>
<h3 style="text-align: center; text-decoration: underline">Category</h3>
<table style="margin-left: auto; margin-right: auto; width:50%">
    <tr style="background:#c8cde0">
      <th style="width: 150px">Expense Title</th>
      <th style="width: 30px">Qty</th>
      <th style="width: 60px">Total</th>
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
        <tr style="background:white">
            <td>{{$item->exp_category}}</td>
            <td>{{$pdf_data[4][$cat_counter]}}</td>
            @php
                $sum_cat_counter = $sum_cat_counter + $pdf_data[4][$cat_counter]
            @endphp
            <td>{{numberFormat($pdf_data[5][$cat_counter])}}</td>
        </tr>
    @endif
    @endforeach
    {{-- {{dd($sum_cat_counter)}} --}}
  <tr style="background:#c8cde0">
    <td>Total</td>
    <td>{{$sum_cat_counter}}</td>
    <td>{{numberFormat($pdf_data[1])}}</td>
</tr>
  </table>
  {{-- {{dd('asdadsads')}} --}}
</div>

</body>
</html>