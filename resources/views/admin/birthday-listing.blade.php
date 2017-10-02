@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>
        Contact View 
        <small>{{trans('adminlabels.Birthday')}}</small>        
    </h1>
</section>

<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans('adminlabels.Birthday_list')}}</h3>
                </div>
                <div class="box-body">
                    <table id="listContact" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{trans('adminlabels.Birthday_f_name')}}</th>
                                <th>{{trans('adminlabels.Birthday_l_name')}}</th>
                                <th>{{trans('adminlabels.Birthday_email')}}</th>
                                <th>{{trans('adminlabels.Birthday_date')}}</th>
                                <th>{{trans('adminlabels.Birthday_Image')}}</th>
                                <th>{{trans('adminlabels.list_action_label')}}</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
@endsection
@section('script')

<script>
    var getadsList = function (ajaxParams) {
        $("#listContact").DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": {
                "url": "{{ url('/list-birthday-ajax') }}",
                "dataType": "json",
                "type": "POST",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }} "
                },
                "data": function (data) {
                    if (ajaxParams) {
                        $.each(ajaxParams, function (key, value) {
                            data[key] = value;
                        });
                        ajaxParams = {};
                    }
                }
            },
            "columns": [
                {"data": "firstname"},
                {"data": "lastname"},
                {"data": "birthday_email"},
                {"data": "birthdate"},
                {"data": "birthdayImage"},
                {"data": "action", "orderable": false}
            ],
            "initComplete": function (settings, json) {
                if (typeof (json.customMessage) != "undefined" && json.customMessage !== '') {
                    $('.customMessage').removeClass('hidden');
                    $('#customMessage').html(json.customMessage);
                }
            }
        });
    };
    $(document).ready(function () {
        var ajaxParams = {};
        getadsList(ajaxParams);
        // Remove user        
        $(document).on('click', '.btn-delete-birthday', function (e) {
            e.preventDefault();
            var userId = $(this).attr('data-id');
            var cmessage = 'Are you sure you want to Delete this Birthday ?';
            var ctitle = 'Delete Ads';

            ajaxParams.customActionType = 'groupAction';
            ajaxParams.customActionName = 'delete';
            ajaxParams.id = [userId];

            bootbox.dialog({
                onEscape: function () {},
                message: cmessage,
                title: ctitle,
                buttons: {
                    Yes: {
                        label: 'Yes',
                        className: 'btn-danger',
                        callback: function () {
                            getadsList(ajaxParams);
                        }
                    },
                    No: {
                        label: 'No',
                        className: 'btn-success'
                    }
                }
            });
        });
    });
</script>
@endsection