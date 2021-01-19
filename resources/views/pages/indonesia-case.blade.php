@extends('TemplateUser.master')

@section('content')
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center mb-3">
                    <div class="row justify-content-center">
                        <h1 style="color: whitesmoke">Indonesia Covid Case</h1>
                    </div>
                </div>
                <div class="row align-content-center">
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Cases</h5>
                                        <span class="h2 font-weight-bold mb-0" id="indonesia-cases"></span>
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
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Recovered</h5>
                                        <span class="h2 font-weight-bold mb-0" id="indonesia-recovered"></span>
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
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Deaths</h5>
                                        <span class="h2 font-weight-bold mb-0" id="indonesia-deaths"></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-badge"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-default mr-2"><i class="ni ni-world"></i></span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card card-stats">
                            <!-- Card body -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Active</h5>
                                        <span class="h2 font-weight-bold mb-0" id="indonesia-active"></span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                            <i class="ni ni-circle-08"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">
                                    <span class="text-default mr-2"><i class="ni ni-world"></i></span>
                                    <span class="text-nowrap">Since last month</span>
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
        <div class="container mt-2 pb-6">
            <div class="row justify-content-center">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Report Coronavirus Indonesia Cases</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush table-sm" id="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="sort" data-sort="name">Province Name</th>
                                    <th scope="col" class="sort" data-sort="budget">Case Confirm</th>
                                    <th scope="col" class="sort" data-sort="status">Recovered</th>
                                    <th scope="col" class="sort" data-sort="status">Deaths</th>
                                    <th scope="col" class="sort" data-sort="status">Active Case</th>
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
            getIndonesiaCases()

            $('#table').DataTable({
                "language": {
                    "paginate": {
                        "previous": "<<",
                        "next" : ">>"
                    }
                },
                ajax: {
                    url: "{{url('api/indonesia')}}"
                },
                columns: [{
                        data: "attributes.Provinsi",
                        name: "attributes.Provinsi"
                    },
                    {
                        data: "attributes.Kasus_Posi",
                        name: "attributes.Kasus_Posi",
                        render:(data)=>{
                            if(data == null || data == 0){
                                return data
                            }else{
                                return data.toLocaleString();
                            }
                        }
                    },
                    {
                        data: "attributes.Kasus_Meni",
                        name: "attributes.Kasus_Meni",
                        render:(data)=>{
                            if(data == null || data == 0){
                                return data
                            }else{
                                return data.toLocaleString();
                            }
                        }
                    },
                    {
                        data: "attributes.Kasus_Semb",
                        name: "attributes.Kasus_Semb",
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
                        render:(data, type, row)=>{
                            let covid = row.attributes
                            let active = covid.Kasus_Posi - covid.Kasus_Semb - covid.Kasus_Meni
                            if(active == null || active == 0){
                                return active
                            }else{
                                return active.toLocaleString();
                            }
                        }
                    },
                ]
            });
        });

        getIndonesiaCases = () => {
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
                url: "{{url('api/indonesia/cases')}}",
                success: function (res) {
                    console.log(res)
                    $('#indonesia-cases').text(res[0].positif)
                    $('#indonesia-recovered').text(res[0].sembuh)
                    $('#indonesia-deaths').text(res[0].meninggal)
                    $('#indonesia-active').text(res[0].dirawat)
                }
            })
        }

        
    </script>
@endsection