@extends('layouts.master')

@section('title')
    <title>PoS - Dashboard</title>
@endsection

@section('content')
    <section class="content-header">
        <h1>Dashboard<small>data</small></h1>
        <ol class="breadcrumb">
            <li class="active"><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-sm-6">
                <div id="piechart" style="width:500px; height:500px;"></div>
            </div>
            <div class="col-sm-6">
                <div id="columnchart" style="width:500px; height:500px;"></div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var stock = <?php echo $stock; ?>;

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(columnChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable(stock);

            var options = {
                title: 'Stock Products'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
        }

        function columnChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Product Name');
            data.addColumn('number', 'Stock');

            data.addRows(stock);

            var options = {
                title: 'Stock Products'
            };

            var piechart = new google.visualization.PieChart(document.getElementById('piechart'));
            var columnchart = new google.visualization.ColumnChart(document.getElementById('columnchart'));

            piechart.draw(data, options);
            columnchart.draw(data, options);
        }
    </script>    
@endpush