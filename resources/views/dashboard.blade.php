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
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-sm-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{ $countCategories }}</h3>
                        <p>Category</p>
                    </div>
                    <div class="icon">
                        <i class="ion-document-text"></i>
                    </div>
                    <a href="{{ route('category.index') }}" class="small-box-footer">More information <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-sm-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h3>{{ $countProducts }}</h3>
                        <p>Product</p>
                    </div>
                    <div class="icon">
                        <i class="ion-document-text"></i>
                    </div>
                    <a href="{{ route('product.index') }}" class="small-box-footer">More information <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                </div>
                <div class="box">
                    <div class="box-body">
                        <div class="col-sm-6">
                            <div id="piechart"></div>
                        </div>
                        <div class="col-sm-6">
                            <div id="columnchart"></div>
                        </div>    
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        var stock = <?php echo $stock; ?>;

        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Product Name');
            data.addColumn('number', 'Stock');

            data.addRows(stock);

            var options = {
                title: 'Stock Products',
                width: '100%',
                height: '400'
            };

            var piechart = new google.visualization.PieChart(document.getElementById('piechart'));
            var columnchart = new google.visualization.ColumnChart(document.getElementById('columnchart'));

            piechart.draw(data, options);
            columnchart.draw(data, options);
        }
    </script>    
@endpush