@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Todo List') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
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

                </div>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {
        fill_datatable();
        function fill_datatable(filter_name = '', filter_user_type_id = '', filter_active_status = '') {
            if (filter_name != '') {
                console.log(filter_name);
            }
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

                "pagingType": "full_numbers",
                "autoWidth": false,
                // "drawCallback": function (settings) {
                //     $('[data-toggle="tooltip"]').tooltip();
                // },

            });
        }

    });
</script>






@endsection
