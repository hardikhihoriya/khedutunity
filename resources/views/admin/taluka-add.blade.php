@extends('layouts.admin-master')
@section('content')
<section class="content-header">
    <h1>
        {{trans('adminlabels.talukamanagement')}}
        <small><?php echo (isset($editDistrict) && !empty($editDistrict)) ? trans('adminlabels.edit') : trans('adminlabels.create') ?> {{ trans('adminlabels.taluka') }}</small>        
    </h1>     
</section>
<section class="content">
    <div class="row">
        <!-- right column -->
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo (isset($editDistrict) && !empty($editDistrict)) ? trans('adminlabels.edit') : trans('adminlabels.create') ?>District</h3>
                </div>
                <form class="form-horizontal" id="talukaForm" enctype="multipart/form-data" method="POST" action="{{ url('admin/taluka-save') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?php echo (isset($editDistrict) && !empty($editDistrict) ? $editDistrict->id : '0'); ?>" >
                        <input type="hidden" name="hidden_profile" value="<?php echo(isset($editDistrict) && !empty($editDistrict) ? $editDistrict->district_image : ''); ?>">

                        <div class="form-group">
                            <label class="col-md-2 control-label" for="district_code"> District List</label>
                            <div class="col-md-6 ">
                                <select class="form-control" name="district_code" id="district_code">
                                    <?php foreach ($districtList as $key => $_value) {
                                        ?>
                                        <option value="{{ $_value->district_code }}">{{ $_value->district_name }}</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="taluka_name" class="col-md-2 control-label">{{trans('adminlabels.talukaname')}}</label>                        
                            <div class="col-md-6 ">
                                <input type="text" class="form-control"  name="taluka_name" id="taluka_name" placeholder="Please Enter Taluka Name" value=""/>                        
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('taluka_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>                        
                        <div class="form-group">
                            <label for="taluka_image" class="col-md-2 control-label">{{trans('adminlabels.talukaimage')}}</label>
                            <div class="col-md-6 ">
                                <input type="file" class="form-control" id="taluka_image" name="taluka_image">
                                <?php
                                if (isset($editDistrict->id) && $editDistrict->id != '0') {
                                    if (File::exists(public_path($districtImagePath . $editDistrict->district_image)) && $editDistrict->district_image != '') {
                                        ?>
                                        <img src="{{ url($districtImagePath.$editDistrict->district_image) }}" alt="{{$editDistrict->district_image}}"  height="70" width="70">
                                    <?php } else { ?>
                                        <img src="{{ asset('/uploads/user/thumb/default.png')}}" class="user-image" alt="Default Image" height="70" width="70">
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="taluka_description">{{trans('adminlabels.talukadescription')}}</label>
                            <div class="col-md-6">
                                <textarea class="form-control" rows="5"  name="taluka_description" id="taluka_description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-1 col-md-offset-2">                                
                                <input type="submit" value="submit" class="btn btn-primary"/>
                            </div>
                            <div class="col-md-2">
                                <a href="{{url('admin/district')}}" class="btn btn-primary">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!--/.col (right) -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endsection
@section('script')
<script>
//    $(document).ready(function () {
//        $('#talukaForm').on('submit', function (e) {
//            e.preventDefault();
//            var formData = new FormData($(this)[0]);
//            $.ajax({
//                url: "{{ url('/admin/taluka-save') }}",
//                type: "POST",
//                data: formData,
//                cache: false,
//                processData: false, // Don't process the files
//                contentType: false,
//                headers: {
//                    'X_CSRF_TOKEN': '{{ csrf_field() }}',
//                },
//                success: function (data) {
//                    window.location.href = 'http://khedutunity.localhost.com/admin/taluka';
//                }
//            });
//        });
//    });
</script>
@endsection