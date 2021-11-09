@extends('layouts.app')

<style>
    body {font-family: Arial, Helvetica, sans-serif;}

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }

    /* Modal Content */
    .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    /* The Close Button */
    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>




@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Todo List') }}
                        <div style="float: right;" >
                            <a href="javascript:add();" class="btn btn-sm btn-info " style=" font-size: 16px;"><i class="fa fa-plus"></i> {{ __('Add List +') }}</a>

                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(session('success'))

                            <div id="alert-success_div" class="alert alert-dismissible alert-success">
                                <button onclick="document.getElementById('alert-success_div').style.display='none'" type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>Well done!</strong>   {{session('success')}}.
                            </div>

                        @endif
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div id="alert-error_div" class="alert alert-dismissible alert-danger">
                                        <button onclick="document.getElementById('alert-error_div').style.display='none'" type="button" class="close" data-dismiss="alert">&times;</button>
                                        <strong>Error !</strong>   {{$error}}.
                                    </div>
                                @endforeach
                            @endif


                        <table id="user_data" class="table table-bordered table-striped">
                            <thead>
                            <TH style="width:50%">Todo Lists</TH>
                            <TH style="width:20%">Created_at</TH>
                            <TH style="width:30%">Action</TH>

                            </thead>
                            <tbody>
                            </tbody>
                        </table>



                        <div id="myModal" class="modal" >

                            <!-- Modal content -->
                            <div id="edit_modal" class="modal-content animate-zoom" style="max-width:1000px">
                                <div class="center-block">
                                    <span onclick="document.getElementById('myModal').style.display='none'" class="btn close btn btn-sm btn-info  pull-right" style="height: 40px; width:50px; float: right; background:red; border: red;">&times;</span>
                                </div>
                                <br>
                                <div style="width:100%;clear:both;" id="response">

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>




        <script>
            $(document).ready(function () {
                fill_datatable();
                function fill_datatable() {

                    var dataTable = $('#user_data').DataTable({
                        //searching: false,
                        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
                        dom: 'lBfrtip',

                        "buttons": [
                            {
                                extend: 'excel',
                                text: 'Export to Excel',
                                exportOptions: {
                                    modifier: {
                                        search: 'applied',
                                        order: 'applied'
                                    }
                                }
                            }
                        ],

                        responsive: true,
                        processing: true,
                        serverSide: true,
                        stateSave: true,
                        bStateSave: true,
                        "pagingType": "full_numbers",
                        "autoWidth": false,
                        ajax: {
                            url: "{{ route('home') }}",

                        },
                        columns: [

                            {
                                data: 'todo_description',
                                render: function (data, type, row, meta) {

                                    var url = "{{URL('/taskLists')}}" +'/'+ row.id;
                                    return '<a href="' + url + '" >'+ data +'</a>';


                                }
                            },
                            {
                                data: 'created_at',
                                name: 'created_at'
                            },
                            {
                                "orderable": false,
                                className: "dt-nowrap",
                                "targets": -1,
                                //"data": 'id',
                                "render": function (data, type, row, meta) {
                                        return '<input type="hidden" id="IDs_all_' + meta.row + '" name="IDs_all_' + meta.row + '" value="' + row.id + '">' +
                                            '<a id=' + row.id + ' data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn btn-primary edit"> <i class="fa fa-pencil"></i> </a>' +
                                            '&nbsp;<a id=' + row.id + ' data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn btn-danger delete"> <i class="fa fa-times"></i> </a>';
                                }
                            }
                        ]

                    });
                }


                $('#user_data tbody').on('click', '.edit', function (e) {
                    e.preventDefault();
                    document.getElementById('response').innerHTML = loader;
                    document.getElementById('myModal').style.display = 'block';
                    var id = $(this).attr('id');

                    $.ajax({
                        type: 'GET',
                        url: "{{URL('/edit-todoList')}}" + "/" + id ,
                        contentType: "html",
                        dataType: 'html',
                        success: function (data) {

                            document.getElementById('response').innerHTML = data;

                        }
                    });
                });


                $('#user_data tbody').on('click', '.delete', function (e) {
                    e.preventDefault();
                    document.getElementById('response').innerHTML = loader;
                    document.getElementById('myModal').style.display = 'block';
                    var id = $(this).attr('id');

                    $.ajax({
                        type: 'GET',
                        url: "{{URL('/delete-todoList')}}" + "/" + id ,
                        contentType: "html",
                        dataType: 'html',
                        success: function (data) {

                            document.getElementById('response').innerHTML = data;

                        }
                    });
                });



            });
            // var modal = document.getElementById("myModal");


            function add() {
                document.getElementById('response').innerHTML = loader;
                document.getElementById('myModal').style.display = 'block';
                $.ajax({
                    type: 'GET',
                    url: "{{URL("/create-todoList")}}",
                    contentType: "html",
                    dataType: 'html',
                    success: function (data) {
                        $('#response').empty().append(data)
                        document.getElementById('response').innerHTML=data;
                    }
                });
            }

            function todolistComplete(obj,id)
            {

            }


        </script>





@endsection
