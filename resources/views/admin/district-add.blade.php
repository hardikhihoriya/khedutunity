@extends('layouts.admin-master')
@section('content')
<section class="content-header">
    <h1>
        District Management
        <small>Create district</small>
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
                <form class="form-horizontal" id="districtForm" enctype="multipart/form-data" method="POST" action="{{ url('admin/district-save') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?php echo (isset($editDistrict) && !empty($editDistrict) ? $editDistrict->id : '0'); ?>" >
                        <input type="hidden" name="hidden_profile" value="<?php echo(isset($editDistrict) && !empty($editDistrict) ? $editDistrict->district_image : ''); ?>">
                        <input type="hidden" class="form-control"  name="state_code" id="state_code" value="GU"/>
                        <?php $districtName = old('district_name') ? old('district_name') : (isset($editDistrict) ? $editDistrict->district_name : ''); ?>
                        <div class="form-group">
                            <label for="district_name" class="col-md-2 control-label">District Name</label>                        
                            <div class="col-md-6 ">
                                <input type="text" class="form-control"  name="district_name" id="district_name" placeholder="Please Enter District Name" value="{{ $districtName }}" />                        
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('district_name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <?php $districtCode = old('district_code') ? old('district_code') : (isset($editDistrict) ? $editDistrict->district_code : ''); ?>
                        <div class="form-group">
                            <label for="district_code" class="col-md-2 control-label">District Code</label>
                            <div class="col-md-6 ">
                                <input type="text" class="form-control"  name="district_code" id="district_code" placeholder="Please Enter District code  @example GJ-1" value="{{ $districtCode }}" />                        
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('district_code') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="district_image" class="col-md-2 control-label">District Image</label>
                            <div class="col-md-6 ">
                                <input type="file" class="form-control" id="district_image" name="district_image">
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
                    </div>
                    <div class="box-footer">
                        <div class="form-group">
                            <div class="col-md-1 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>

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
    
</script>
@endsection