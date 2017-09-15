<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\district;
use Redirect;
use Illuminate\Validation\Rule;
use File;
use Image;
use Config;
use Response;
use Validator;

class districtController extends Controller {

    public function __construct() {
        $this->middleware('IsAdmininstrator');
        $this->objDistrict = new district();
        $this->districtOriginalImageUploadPath = Config::get('constant.DISTRICT_ORIGINAL_IMAGE_UPLOAD_PATH');
        $this->districtThumbImageUploadPath = Config::get('constant.DISTRICT_THUMB_IMAGE_UPLOAD_PATH');
        $this->districtThumbImageHeight = Config::get('constant.DISTRICT_THUMB_IMAGE_HEIGHT');
        $this->districtThumbImageWidth = Config::get('constant.DISTRICT_THUMB_IMAGE_WIDTH');
    }

    public function index() {
        return view('admin.district-listing');
    }

    public function addDistrict() {
        return view('admin.district-add');
    }

    public function saveDistrict() {
        $this->validate(request(), [
            'district_name' => 'required',
            'district_code' => 'required',
            'district_image' => 'required',
        ]);
        $districtInput = Input::all();
        $district = $this->objDistrict->find($districtInput['id']);
        $hiddenProfile = Input::get('hidden_profile');
        $districtInput['district_image'] = $hiddenProfile;
        if (Input::file()) {
            $file = Input::file('district_image');
            if (!empty($file) || isset($file)) {
                $imageType = array('image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/jpe', 'image/psd');
                if (in_array($file->getMimeType(), $imageType)) {
                    $districtCode = $districtInput['district_code'];
                    $fileName = 'District-' . $districtCode . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $pathOriginal = public_path($this->districtOriginalImageUploadPath . $fileName);
                    $pathThumb = public_path($this->districtThumbImageUploadPath . $fileName);
                    if (!file_exists(public_path($this->districtOriginalImageUploadPath)))
                        File::makeDirectory(public_path($this->districtOriginalImageUploadPath), 0777, true, true);
                    if (!file_exists(public_path($this->districtThumbImageUploadPath)))
                        File::makeDirectory(public_path($this->districtThumbImageUploadPath), 0777, true, true);

                    Image::make($file->getRealPath())->save($pathOriginal);
                    Image::make($file->getRealPath())->resize($this->districtThumbImageWidth, $this->districtThumbImageHeight)->save($pathThumb);

                    if ($hiddenProfile != '' && $hiddenProfile != "default.png") {
                        $imageOriginal = public_path($this->districtOriginalImageUploadPath . $hiddenProfile);
                        $imageThumb = public_path($this->districtThumbImageUploadPath . $hiddenProfile);
                        if (file_exists($imageOriginal) && $hiddenProfile != '') {
                            File::delete($imageOriginal);
                        }
                        if (file_exists($imageThumb) && $hiddenProfile != '') {
                            File::delete($imageThumb);
                        }
                    }
                    $districtInput['district_image'] = $fileName;
                }
            }
        }
        if (isset($districtInput['id']) && $districtInput['id'] > 0) {
            $district->district_name = $districtInput['district_name'];
            $district->district_code = $districtInput['district_code'];
            $district->district_image = $districtInput['district_image'];
            $district->save();
            return Redirect::to("/admin/district/")->with('success', trans('adminmsg.district_updated_success'));
        } else {
            try {
                $this->objDistrict->create($districtInput);
                return Redirect::to("/admin/district/")->with('success', trans('adminmsg.district_created_success'));
            } catch (\Illuminate\Database\QueryException $e) {
                return back()->withInput()->withErrors(['loang digit in district code']);
            }
        }
    }

    public function editDistrict($id) {
        $editDistrict = $this->objDistrict->find($id);
        $districtImagePath = $this->districtThumbImageUploadPath;
        return view('admin.district-add', compact('editDistrict', 'districtImagePath'));
    }

    public function listDistrictAjax() {
        $records = array();
        //processing custom actions
        if (Input::get('customActionType') == 'groupAction') {
            $action = Input::get('customActionName');
            $idArray = Input::get('id');
            switch ($action) {
                case "delete":
                    foreach ($idArray as $_idArray) {
                        $districtDelete = district::find($_idArray);
                        if ($districtDelete->file != '') {
                            $imageOriginal = public_path($this->districtOriginalImageUploadPath . $districtDelete->file);
                            $imageThumb = public_path($this->districtThumbImageUploadPath . $districtDelete->file);
                            if (file_exists($imageOriginal)) {
                                File::delete($imageOriginal);
                            }
                            if (file_exists($imageThumb)) {
                                File::delete($imageThumb);
                            }
                        }
                        $districtDelete->delete();
                    }
                    $records["customMessage"] = trans('adminmsg.delete_ads');
            }
        }
        $columns = array(
            0 => 'district_name',
            1 => 'district_image',
            2 => 'district_code'
        );
        $order = Input::get('order');
        $search = Input::get('search');
        $records["data"] = array();
        $iTotalRecords = district::count();
        $iTotalFiltered = $iTotalRecords;
        $iDisplayLength = intval(Input::get('length')) <= 0 ? $iTotalRecords : intval(Input::get('length'));
        $iDisplayStart = intval(Input::get('start'));
        $sEcho = intval(Input::get('draw'));
        $records["data"] = district::select('*');
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
                $edit = route('district.edit', $_records->id);
                $records["data"][$key]['district_image'] = ($_records->district_image != '' && File::exists(public_path($this->districtThumbImageUploadPath . $_records->district_image)) ? '<img src="' . url($this->districtThumbImageUploadPath . $_records->district_image) . '"  height="50" width="50">' : '<img src="' . asset('/uploads/user/thumb/default.png') . '" class="user-image" alt="Default Image" height="50" width="50">');
                $records["data"][$key]['action'] = "&emsp;<a href='{$edit}' title='Edit District' ><span class='glyphicon glyphicon-edit'></span></a>
                                                    &emsp;<a href='javascript:;' data-id='" . $_records . "' class='btn-view-district' title='View District' ><span class='glyphicon glyphicon-eye-open'></span></a>
                                                    &emsp;<a href='javascript:;' data-id='" . $_records->id . "' class='btn-delete-district' title='Delete District' ><span class='glyphicon glyphicon-trash'></span></a>";
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalFiltered;

        return Response::json($records);
    }

}
