@extends('layouts.admin-master')

@section('content')

<section class="content-header">
    <h1>
        {{ trans('adminlabels.talukamanagement') }}
        <small>{{ trans('adminlabels.taluka') }}</small>
        <div class="pull-right">
            <a href="{{ url('admin/add-taluka') }}" class="btn btn-block btn-success add-btn-primary pull-right" alt="add" title="add">{{trans('labels.add')}}</a>
        </div>
    </h1>
</section>
<section class="content">
    <div class="row">        
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{trans('adminlabels.district_name_list')}}</h3>
                </div>
                <div class="box-body">
                    <table id="listTaluka" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{trans('adminlabels.talukaname')}}</th>
                                <th>{{trans('adminlabels.talukaimage')}}</th>
                                <th>{{trans('adminlabels.districtname')}}</th>
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
        $("#listTaluka").DataTable({
            "processing": true,
            "serverSide": true,
            "destroy": true,
            "ajax": {
                "url": "{{ url('admin/list-taluka-ajax') }}",
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
                {"data": "taluka_name"},
                {"data": "taluka_image", "orderable": false},
                {"data": "district_name"},
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
        $(document).on('click', '.btn-view-taluka', function (e) {
            var Data = $(this).attr('data-id');
            console.log(Data);
            var jsonData = $.parseJSON(Data);
            var districtName = jsonData.district_name;
            var districtCode = jsonData.district_code;
            var districtImage = jsonData.district_image;
            console.log(jsonData);
            var dialog = bootbox.dialog({
                title: districtName,
                message: '<div class="text-center"><i class="fa fa-spin fa-spinner"></i> Loading...</div>',
                buttons: {
//                    cancel: {
//                        label: '<i class="fa fa-times"></i> Cancel'
//                    },
                    confirm: {
                        label: '<i class="fa fa-check"></i> Confirm',
                        className: 'btn-success',
                    },
//                    confirm: {
//                        label: "Okay Done",
//                        className: 'btn-info',
//                        callback: function () {
//                            Example.show('OK clicked');
//                        }
//                    }
                },
            });
            dialog.init(function () {
                setTimeout(function () {
                    dialog.find('.bootbox-body').html('<h2>Taluka Name=> ' + districtCode + ' </h2>' + districtImage);
                }, 2000);
            });
        });
        $(document).on('click', '.btn-delete-taluka', function (e) {
            e.preventDefault();
            var userId = $(this).attr('data-id');
            var cmessage = 'Are you sure you want to Delete this Taluka ?';
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