@extends('TemplateUser.master')

@section('content')
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-3">
                    <div class="row justify-content-center">
                        <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                            <h1 class="text-white">Welcome!</h1>
                            <p class="text-lead text-white">This website will provide information on covid cases,
                                information on hospitals that receive swab tests.
                                and information on covid prevention
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-content-center">
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

            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt-8 pb-6">
            <div class="row justify-content-center">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Report coronavirus cases</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-sm" id="table">
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
                            return new Date(1609528992000).toUTCString();
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