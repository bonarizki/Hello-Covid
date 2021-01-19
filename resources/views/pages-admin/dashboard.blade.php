@extends('TemplateAdmin/master')

@section('header')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Dashboard</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Dashboards</a></li>
                                {{-- <li class="breadcrumb-item active" aria-current="page">Default</li> --}}
                            </ol>
                        </nav>
                    </div>
                    {{-- <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral">New</a>
                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                    </div> --}}
                </div>
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Cases</h5>
                                        <span class="h2 font-weight-bold mb-0" id="covid-cases"></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                            <i class="ni ni-ambulance"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-default mr-2"><i class="ni ni-world"></i></span>
                                    <span class="text-nowrap">The Entire World</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Recovered</h5>
                                        <span class="h2 font-weight-bold mb-0" id="covid-recovered"></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                            <i class="ni ni-user-run"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-default mr-2"><i class="ni ni-world"></i></span>
                                    <span class="text-nowrap">The Entire World</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Deaths</h5>
                                        <span class="h2 font-weight-bold mb-0" id="covid-deaths"></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-badge"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-default mr-2"><i class="ni ni-world"></i></span>
                                    <span class="text-nowrap">The Entire World</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card bg-default">
            <div class="card-header bg-transparent">
                <h3 class="mb-0" style="color: whitesmoke">Report coronavirus cases</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive" >
                    <table class="table align-items-center table-flush table-sm" id="table" style="color: white">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name">Country Name</th>
                                <th scope="col" class="sort" data-sort="budget">Case Confirm</th>
                                <th scope="col" class="sort" data-sort="status">Recovered</th>
                                <th scope="col" class="sort" data-sort="status">Deaths</th>
                                <th scope="col" class="sort" data-sort="status">Active Case</th>
                                <th scope="col" class="sort" data-sort="status">Last Update</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            getTotalCases();
            getRecovered();
            getDeath();
            $('#table').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<<",
                        "next" : ">>"
                    }
                },
                ajax: {
                    url: "{{url('api/covid/country')}}"
                },
                columns: [{
                        data: "attributes.Country_Region",
                        name: "attributes.Country_Region"
                    },
                    {
                        data: "attributes.Confirmed",
                        name: "attributes.Confirmed",
                        render:(data)=>{
                            if(data == null || data == 0){
                                return data
                            }else{
                                return data.toLocaleString();
                            }
                        }
                    },
                    {
                        data: "attributes.Deaths",
                        name: "attributes.Deaths",
                        render:(data)=>{
                            if(data == null || data == 0){
                                return data
                            }else{
                                return data.toLocaleString();
                            }
                        }
                    },
                    {
                        data: "attributes.Recovered",
                        name: "attributes.Recovered",
                        render:(data)=>{
                            if(data == null || data == 0){
                                return data
                            }else{
                                return data.toLocaleString();
                            }
                        }
                    },
                    {
                        data: "attributes.Active",
                        name: "attributes.Active",
                        render:(data)=>{
                            if(data == null || data == 0){
                                return data
                            }else{
                                return data.toLocaleString();
                            }
                        }
                    },
                    {
                        data: "attributes.Last_Update",
                        name: "attributes.Last_Update",
                        render:(data)=>{
                            return new Date(data).toUTCString();
                        }
                    },
                ]
            });

        });

        getTotalCases = () => {
            $.ajax({
                type: "get",
                dataType: 'json',
                contentType: 'text/html, charset=UTF-8',
                secure: true,
                headers: {
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET',
                    'Access-Control-Allow-Headers': 'text/html, charset=UTF-8',
                },
                url: "{{url('api/covid/positif')}}",
                success: function (res) {
                    $('#covid-cases').text(res.value)
                }
            })
        }

        getRecovered = () => {
            $.ajax({
                type: "get",
                dataType: 'json',
                contentType: 'text/html, charset=UTF-8',
                secure: true,
                headers: {
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET',
                    'Access-Control-Allow-Headers': 'text/html, charset=UTF-8',
                },
                url: "{{url('api/covid/recovered')}}",
                success: function (res) {
                    $('#covid-recovered').text(res.value)
                }
            })
        }

        getDeath = () => {
            $.ajax({
                type: "get",
                dataType: 'json',
                contentType: 'text/html, charset=UTF-8',
                secure: true,
                headers: {
                    'Access-Control-Allow-Credentials': true,
                    'Access-Control-Allow-Origin': '*',
                    'Access-Control-Allow-Methods': 'GET',
                    'Access-Control-Allow-Headers': 'text/html, charset=UTF-8',
                },
                url: "{{url('api/covid/deaths')}}",
                success: function (res) {
                    $('#covid-deaths').text(res.value)
                }
            })
        }
    </script>
@endsection