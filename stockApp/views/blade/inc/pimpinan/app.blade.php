@extends('layout.waitres')

@section('title', $title)

@section('load_css')
@parent
        <link href="{{ base_url('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ base_url('plugins/bower_components/morrisjs/morris.css') }}" rel="stylesheet" type="text/css" />

@section('load_js')

@parent
        <!--Morris JavaScript -->
        <script src="{{ base_url('plugins/bower_components/raphael/raphael-min.js') }}"></script>
        <script src="{{ base_url('plugins/bower_components/morrisjs/morris.js') }}"></script>
        <script src="{{ base_url('plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>

        <script src="{{ base_url('js/module/pimpinan/statistik.js') }}" type="text/javascript"></script>
@endsection

@section('content')
            <div class="row">

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-2 pull-right">
                            <button id="btnFilterStatistik" class="btn btn-rounded form-control" onclick="loadDataCS()">
                                <i class="fa fa-search"></i>
                                <span>Filter</span>
                            </button>
                        </div>
                        <div class="col-md-4 pull-right">
                            <div class="input-daterange input-group" id="date-range">
                                <input type="text" class="form-control" name="start" value="{{ date('Y-m-01') }}">
                                <span class="input-group-addon bg-info b-0 text-white">to</span>
                                <input type="text" class="form-control" name="end" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="white-box">
                        <h3>Statistik Pendapatan</h3>
                        <hr>
                        <ul class="list-inline text-right" id="statusSectionLogistics">
                            <li>
                                <h5>
                                    <i class="fa fa-circle m-r-5" style="color: #FF7A01;"></i>
                                    Income
                                </h5>
                            </li>
                        </ul>
                        <div id="morris-area-chart"></div>
                    </div>
                </div>
                <div class="col-md-4 white-box">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Nama</td>
                                <td>Qty</td>
                                <td>Total</td>
                            </td>
                        </thead>
                        <tbody id="contentTableProduct">
                        </tbdoy>
                    </table>
                </div>
            </div>
@endsection
