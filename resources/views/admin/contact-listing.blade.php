@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>
        Contact View 
        <small>{{trans('adminlabels.contact')}}</small>        
    </h1>
</section>

<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans('adminlabels.contact_list')}}</h3>
                </div>
                <div class="box-body">
                    <table id="listContact" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{trans('adminlabels.contact_firstname')}}</th>
                                <th>{{trans('adminlabels.contact_lastname')}}</th>
                                <th>{{trans('adminlabels.contact_email')}}</th>
                                <th>{{trans('adminlabels.contact_subject')}}</th>
                                <th>{{trans('adminlabels.contact_messge')}}</th>
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
                "url": "{{ url('/list-contact-ajax') }}",
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
                {"data": "first_name"},
                {"data": "last_name"},
                {"data": "contact_email"},
                {"data": "contact_subject"},
                {"data": "message"},
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
        $(document).on('click', '.btn-delete-district', function (e) {
            e.preventDefault();
            var userId = $(this).attr('data-id');
            var cmessage = 'Are you sure you want to Delete this District ?';
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