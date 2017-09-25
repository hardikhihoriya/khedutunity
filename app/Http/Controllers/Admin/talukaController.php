<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\district;
use App\taluka;
use Redirect;
use Illuminate\Validation\Rule;
use File;
use Image;
use Config;
use Response;
use Validator;
use DB;

class talukaController extends Controller {

    public function __construct() {
        $this->middleware('IsAdmininstrator');
        $this->objDistrict = new district();
        $this->objtaluka = new taluka();
        $this->talukaOriginalImageUploadPath = Config::get('constant.TALUKA_ORIGINAL_IMAGE_UPLOAD_PATH');
        $this->talukaThumbImageUploadPath = Config::get('constant.TALUKA_THUMB_IMAGE_UPLOAD_PATH');
        $this->talukaThumbImageHeight = Config::get('constant.TALUKA_THUMB_IMAGE_HEIGHT');
        $this->talukaThumbImageWidth = Config::get('constant.TALUKA_THUMB_IMAGE_WIDTH');
    }

    public function index() {
        return view('admin.taluka-listing');
    }

    public function addTaluka() {
        $districtList = $this->objDistrict->DistrictName();
        return view('admin.taluka-add', compact('districtList'));
    }

    public function saveTaluka() {
        $talukaInput = Input::all();
        $district_code = $talukaInput['district_code'];
        $district_Name_Id = $this->objDistrict->DistrictId($district_code);

        $taluka = $this->objtaluka->find($talukaInput['id']);
        $hiddenProfile = Input::get('hidden_profile');
        $talukaInput['taluka_image'] = $hiddenProfile;
        $talukaInput['district_id'] = $district_Name_Id->id;
        if (Input::file()) {
            $file = Input::file('taluka_image');
            if (!empty($file) || isset($file)) {
                $imageType = array('image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/jpe', 'image/psd');
                if (in_array($file->getMimeType(), $imageType)) {
                    $talukaName = $talukaInput['taluka_name'];
                    $fileName = 'Taluka-' . $talukaName . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $pathOriginal = public_path($this->talukaOriginalImageUploadPath . $fileName);
                    $pathThumb = public_path($this->talukaThumbImageUploadPath . $fileName);
                    if (!file_exists(public_path($this->talukaOriginalImageUploadPath)))
                        File::makeDirectory(public_path($this->talukaOriginalImageUploadPath), 0777, true, true);
                    if (!file_exists(public_path($this->talukaThumbImageUploadPath)))
                        File::makeDirectory(public_path($this->talukaThumbImageUploadPath), 0777, true, true);

                    Image::make($file->getRealPath())->save($pathOriginal);
                    Image::make($file->getRealPath())->resize($this->talukaThumbImageWidth, $this->talukaThumbImageHeight)->save($pathThumb);

                    if ($hiddenProfile != '' && $hiddenProfile != "default.png") {
                        $imageOriginal = public_path($this->talukaOriginalImageUploadPath . $hiddenProfile);
                        $imageThumb = public_path($this->talukaThumbImageUploadPath . $hiddenProfile);
                        if (file_exists($imageOriginal) && $hiddenProfile != '') {
                            File::delete($imageOriginal);
                        }
                        if (file_exists($imageThumb) && $hiddenProfile != '') {
                            File::delete($imageThumb);
                        }
                    }
                    $talukaInput['taluka_image'] = $fileName;
                }
            }
        }
        if (isset($talukaInput['id']) && $talukaInput['id'] > 0) {
            $taluka->taluka_name = $talukaInput['taluka_name'];
            $taluka->district_code = $talukaInput['district_code'];
            $taluka->district_id = $talukaInput['district_id'];
            $taluka->taluka_image = $talukaInput['taluka_image'];
            $taluka->taluka_description = $talukaInput['taluka_description'];
            $taluka->save();
            return Redirect::to("/admin/taluka/")->with('success', trans('adminmsg.taluka_updated_success'));
        } else {
            $this->objtaluka->create($talukaInput);
            return Redirect::to("/admin/taluka/")->with('success', trans('adminmsg.taluka_created_success'));
        }
    }

    public function editTaluka() {
        die('edit');
    }

    public function listTalukaAjax() {
        $records = array();
        //processing custom actions
        if (Input::get('customActionType') == 'groupAction') {
            $action = Input::get('customActionName');
            $idArray = Input::get('id');
            switch ($action) {
                case "delete":
                    foreach ($idArray as $_idArray) {
                        $districtDelete = taluka::find($_idArray);
                        if ($districtDelete->file != '') {
                            $imageOriginal = public_path($this->talukaOriginalImageUploadPath . $districtDelete->file);
                            $imageThumb = public_path($this->talukaThumbImageUploadPath . $districtDelete->file);
                            if (file_exists($imageOriginal)) {
                                File::delete($imageOriginal);
                            }
                            if (file_exists($imageThumb)) {
                                File::delete($imageThumb);
                            }
                        }
                        $districtDelete->delete();
                    }
                    $records["customMessage"] = trans('adminmsg.delete_taluka');
            }
        }
        $columns = array(
            0 => 'taluka_name',
            1 => 'taluka_image',
            2 => 'taluka_description'
        );
        $order = Input::get('order');
        $search = Input::get('search');
        $records["data"] = array();
        $iTotalRecords = taluka::count();
        $iTotalFiltered = $iTotalRecords;
        $iDisplayLength = intval(Input::get('length')) <= 0 ? $iTotalRecords : intval(Input::get('length'));
        $iDisplayStart = intval(Input::get('start'));
        $sEcho = intval(Input::get('draw'));
        $records["data"] = taluka::select('*');
        if (!empty($search['value'])) {
            $val = $search['value'];
            $records["data"]->where(function($query) use ($val) {
                $query->SearchByName($val);
            });
            // No of record after filtering
            $iTotalFiltered = $records["data"]->where(function($query) use ($val) {
                        $query->SearchByName($val);
                    })->count();
        }
        //order by
        foreach ($order as $o) {
            $records["data"] = $records["data"]->orderBy($columns[$o['column']], $o['dir']);
        }
        //limit
        $records["data"] = $records["data"]->take($iDisplayLength)->offset($iDisplayStart)->get();
        if (!empty($records["data"])) {
            foreach ($records["data"] as $key => $_records) {
                $districtName = $this->objDistrict->getNameDistrict($_records['district_id']);                
                $edit = route('taluka.edit', $_records->id);
                $records["data"][$key]['district_name'] = $districtName->district_name;
                $records["data"][$key]['taluka_image'] = ($_records->taluka_image != '' && File::exists(public_path($this->talukaThumbImageUploadPath . $_records->taluka_image)) ? '<img src="' . url($this->talukaThumbImageUploadPath . $_records->taluka_image) . '"  height="50" width="50">' : '<img src="' . asset('/uploads/user/thumb/default.png') . '" class="user-image" alt="Default Image" height="50" width="50">');
                $records["data"][$key]['action'] = "&emsp;<a href='{$edit}' title='Edit Taluka' ><span class='glyphicon glyphicon-edit'></span></a>
                                                    &emsp;<a href='javascript:;' data-id='" . $_records . "' class='btn-view-taluka' title='View Taluka' ><span class='glyphicon glyphicon-eye-open'></span></a>
                                                    &emsp;<a href='javascript:;' data-id='" . $_records->id . "' class='btn-delete-taluka' title='Delete Taluka' ><span class='glyphicon glyphicon-trash'></span></a>";
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalFiltered;

        return Response::json($records);
    }

}
