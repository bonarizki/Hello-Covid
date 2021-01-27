@extends('TemplateUser.master')

@section('content')
    <!-- Main content -->
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
            <div class="container">
                <div class="header-body text-center">
                    <div class="row justify-content-center">
                        <h1 style="color: whitesmoke">Mitra Covid</h1>
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

        <div class="container card-container mt-2 mb-3">
            @foreach ($data as $item)
                <div class="card shadow" width="100%" >
                    <div class="card-body">
                    <h1 class="card-title">{{$item->mitra_name}} </h1>
                    <p class="card-text">Jasa : {{$item->mitra_type=='all' ? 'swab, rapid' : $item->mitra_type}}</p>
                    <p class="card-text">Telephone No : {{$item->mitra_phone}}</p>
                    <p class="card-text">Alamat : {{$item->mitra_address}}</p>
                    </div>
                </div>
            @endforeach
            
            {{$data->links()}}
        </div>
    </div>    
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            // getMitra();
        });

        // getMitra = () => {
        //     $.ajax({
        //         type:"get",
        //         url:"{{url('mitra-all')}}",
        //         success:(res) => {
        //             data = res.data;
        //             let card = ''
        //             data.forEach(item => {
        //                 card += ``
        //             });
        //             $('.number').append(res.links())
        //             $('.card-container').append(card);
        //         }
        //     })
        // }

        // type = (data) => {
        //     let type = data == 'all' ? 'swab, rapid' : data;
        //     return type;
        // }

    </script>
@endsection