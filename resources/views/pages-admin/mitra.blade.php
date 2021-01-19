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
                                <li class="breadcrumb-item"><a href="#">Mitra RS</a></li>
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
            </div>
        </div>
    </div>
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card bg-default">
            <div class="card-header bg-transparent">
                <div class="row">
                    <div class="col-6">
                        <h3 class="mb-0" style="color: whitesmoke">Daftar Mitra RS</h3>
                    </div>
                    <div class="col-2 d-flex flex-row-reverse">
                        <button class="btn btn-success btn-sm" onclick="modal('add')">
                            <i class="fa fa-plus-square" aria-hidden="true"></i>
                            Add Mitra
                        </button>
                    </div>
                    <div class="col-2 d-flex flex-row-reverse">
                        <button class="btn btn-info btn-sm">
                            <i class="fa fa-upload" aria-hidden="true"></i>
                            Upload Mitra
                        </button>
                    </div>
                    <div class="col-2 d-flex flex-row-reverse">
                        <button class="btn btn-primary btn-sm">
                            <i class="fa fa-download" aria-hidden="true"></i>
                            Download Mitra
                        </button>
                    </div>
                </div>
                
            </div>
            <div class="card-body">
                <div class="table-responsive" >
                    <table class="table align-items-center table-bordered table-flush table-sm" id="table" style="color: white" width="100%">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" >#</th>
                                <th scope="col" class="sort" >Nama Mitra</th>
                                <th scope="col" class="sort" >Alamat</th>
                                <th scope="col" class="sort" >No. Telephone</th>
                                <th scope="col" class="sort" >Type</th>
                                <th scope="col" class="sort" >Edit</th>
                                <th scope="col" class="sort" >Delete</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="closeModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form">
                    @csrf
                    <div class="form-group">
                        <label >Mitra Name</label>
                        <input type="text" class="form-control" id="mitra_name" name="mitra_name"  placeholder="Name Hospital or Clinic">
                        <small id="mitra_name_alert" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label >Mitra Address</label>
                        <input type="text" class="form-control" id="mitra_address" name="mitra_address" placeholder="Mitra Address">
                        <small id="mitra_address_alert" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label >Mitra Telephone</label>
                        <input type="text" class="form-control" id="mitra_phone" name="mitra_phone" placeholder="Mitra Address">
                        <small id="mitra_phone_alert" class="form-text text-danger"></small>
                    </div>
                    <div class="form-group">
                        <label >Mitra Type</label>
                        <select name="mitra_type" id="mitra_type" class="form-control">
                            <option value="">Select Type</option>
                            <option value="swab">Swab</option>
                            <option value="rapid">Rapid</option>
                            <option value="all">All</option>
                        </select>
                        <small id="mitra_type_alert" class="form-text text-danger"></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-primary" id="btn-save">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#table').DataTable({
                "destroy":true,
                "language": {
                    "paginate": {
                        "previous": "<<",
                        "next" : ">>"
                    }
                },
                ajax: {
                    url: "{{url('admin/mitra-rs')}}"
                },
                columns: [{
                        data: "DT_RowIndex",
                        name: "DT_RowIndex"
                    },
                    {
                        data: "mitra_name",
                        name: "mitra_name",
                    },
                    {
                        data: "mitra_address",
                        name: "mitra_address",
                    },
                    {
                        data: "mitra_phone",
                        name: "mitra_phone",
                    },
                    {
                        data: "mitra_type",
                        name: "mitra_type",
                    },
                    {
                        data: "id_mitra",
                        name: "id_mitra",
                        render:(data)=>{
                            return `<butto class="btn btn-sm btn-warning" onclick="modal('edit','${data}')">
                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        Edit
                                    </button>`
                        }
                    },
                    {
                        data: "id_mitra",
                        name: "id_mitra",
                        render:(data)=>{
                            return `<butto class="btn btn-sm btn-danger" onclick="modalDelete('${data}')">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                        Delete
                                    </button>`
                        }
                    },
                ]
            });

        });

        const field = ['mitra_name','mitra_address','mitra_phone','mitra_type'];
        const data = {
            id_name:"id_mitra",
            create: {
                url: "{{url('admin/mitra-rs')}}",
                method: "post"
            },
            update : {
                url: "{{url('admin/mitra-rs')}}",
                method: "put"
            },
            delete : {
                url: "{{url('admin/mitra-rs')}}",
                method: "delete"
            },
            edit : {
                url: "{{url('admin/mitra-rs')}}",
                method: "get"
            },
        }

        const validation = new valbon(data);

        modal = (type,id) => {
            console.log(id)
            validation.modal(type,id,'Mitra');
        }

        closeModal = () => {
            validation.closeModal();
        }

        validasi = (type) => {
            validation.validasi(type);
        }

        modalDelete = (id) => {
            validation.modalDelete(id)
        }

    </script>
@endsection