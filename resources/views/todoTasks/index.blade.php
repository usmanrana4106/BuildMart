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
                            <a href="javascript:add();" class="btn btn-sm btn-info " style=" font-size: 16px;"><i class="fa fa-plus"></i> {{ __('Add Task +') }}</a>

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



                            <table id="user_data" class="table table-bordered table-striped">
                            <thead>
                            <TH style="width:10%">No</TH>
                            <TH style="width:50%">Todo Task</TH>
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
                        url: "{{ route('todo-tasks.index') }}",

                    },
                    columns: [
                        {
                           render: function (data, type, row, meta) {
                                return '<input name="status_' + row.id + '" type="checkbox" class="form-control" style="width:25px" onchange="todolistComplete(this,row.id)>'
                            }
                        },
                        {
                            data: 'todo_description',
                            name: 'todo_description'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'updated_at',
                            name: 'updated_at'
                        }
                    ]

                });
            }

        });
       // var modal = document.getElementById("myModal");


        function add() {
            document.getElementById('response').innerHTML = loader;
            document.getElementById('myModal').style.display = 'block';
            $.ajax({
                type: 'GET',
                url: "{{URL("/todo-tasks/create")}}",
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
