<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Birthday;
use Redirect;
use Illuminate\Validation\Rule;
use Config;
use Response;
use Validator;
use File;
use Image;

class BirthdayController extends Controller {

    public function __construct() {
        $this->objBirthday = new Birthday();
        $this->birthdayOriginalImageUploadPath = Config::get('constant.BIRTHDAY_ORIGINAL_IMAGE_UPLOAD_PATH');
        $this->birthdayThumbImageUploadPath = Config::get('constant.BIRTHDAY_THUMB_IMAGE_UPLOAD_PATH');
        $this->birthdayThumbImageHeight = Config::get('constant.BIRTHDAY_THUMB_IMAGE_HEIGHT');
        $this->birthdayThumbImageWidth = Config::get('constant.BIRTHDAY_THUMB_IMAGE_WIDTH');
    }

    public function index() {
        return view('admin.birthday-listing');
    }

    public function save() {
        $birthdayData = Input::all();
        $date = $birthdayData['birthdate'];
        $birthdayData['birthdate'] = date('Y-m-d', strtotime($date));
        $hiddenProfile = Input::get('hidden_profile');
        $birthdayData['birthdayImage'] = $hiddenProfile;
        if (Input::file()) {
            $file = Input::file('birthdayImage');
            if (!empty($file) || isset($file)) {
                $imageType = array('image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/jpe');
                if (in_array($file->getMimeType(), $imageType)) {
                    $firstname = $birthdayData['firstname'];
                    $fileName = 'Birthday' . $firstname . '-' . time() . '.' . $file->getClientOriginalExtension();
                    $pathOriginal = public_path($this->birthdayOriginalImageUploadPath . $fileName);
                    $pathThumb = public_path($this->birthdayThumbImageUploadPath . $fileName);
                    if (!file_exists(public_path($this->birthdayOriginalImageUploadPath)))
                        File::makeDirectory(public_path($this->birthdayOriginalImageUploadPath), 0777, true, true);
                    if (!file_exists(public_path($this->birthdayThumbImageUploadPath)))
                        File::makeDirectory(public_path($this->birthdayThumbImageUploadPath), 0777, true, true);

                    Image::make($file->getRealPath())->save($pathOriginal);
                    Image::make($file->getRealPath())->resize($this->birthdayThumbImageWidth, $this->birthdayThumbImageHeight)->save($pathThumb);

                    if ($hiddenProfile != '' && $hiddenProfile != "default.png") {
                        $imageOriginal = public_path($this->birthdayOriginalImageUploadPath . $hiddenProfile);
                        $imageThumb = public_path($this->birthdayThumbImageUploadPath . $hiddenProfile);
                        if (file_exists($imageOriginal) && $hiddenProfile != '') {
                            File::delete($imageOriginal);
                        }
                        if (file_exists($imageThumb) && $hiddenProfile != '') {
                            File::delete($imageThumb);
                        }
                    }
                    $birthdayData['birthdayImage'] = $fileName;
                }
            }
        }
        if (!empty($birthdayData)) {
            $this->objBirthday->create($birthdayData);
            $msg['success'] = 'Thank You Very Much...!';
            return $msg;
        } else {
            $msg['error'] = 'Please Input All values...!';
            return $msg;
        }
    }

    public function listBirthdayAjax() {
        $records = array();
        if (Input::get('customActionType') == 'groupAction') {
            $action = Input::get('customActionName');
            $idArray = Input::get('id');
            switch ($action) {
                case "delete":
                    foreach ($idArray as $_idArray) {
                        $birthdayDelete = Birthday::find($_idArray);
                        $birthdayDelete->delete();
                    }
                    $records["customMessage"] = trans('adminmsg.delete_birthday');
            }
        }
        $columns = array(
            0 => 'firstname',
            1 => 'lastname',
            2 => 'birthday_email',
            3 => 'birthdate',
            4 => 'birthdayImage',
        );
        $order = Input::get('order');
        $search = Input::get('search');
        $records["data"] = array();
        $iTotalRecords = Birthday::count();
        $iTotalFiltered = $iTotalRecords;
        $iDisplayLength = intval(Input::get('length')) <= 0 ? $iTotalRecords : intval(Input::get('length'));
        $iDisplayStart = intval(Input::get('start'));
        $sEcho = intval(Input::get('draw'));
        $records["data"] = Birthday::select('*');
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
                $birthdayDate = $_records->birthdate;
                $birthdayDate = date_create($_records->birthdate);                 
                $edit = route('Birthday.edit', $_records->id);                               
                $records["data"][$key]['birthdate'] = (date_format($birthdayDate, 'd-M-Y'));
                $records["data"][$key]['birthdayImage'] = ($_records->birthdayImage != '' && File::exists(public_path($this->birthdayThumbImageUploadPath . $_records->birthdayImage)) ? '<img src="' . url($this->birthdayThumbImageUploadPath . $_records->birthdayImage) . '"  height="50" width="50">' : '<img src="' . asset('/uploads/user/thumb/default.png') . '" class="user-image" alt="Default Image" height="50" width="50">');
                $records["data"][$key]['action'] = "&emsp;<a href='{$edit}' title='Edit Birthday' ><span class='glyphicon glyphicon-edit'></span></a>                                                    
                                                    &emsp;<a href='javascript:;' data-id='" . $_records->id . "' class='btn-delete-birthday' title='Delete Birthday' ><span class='glyphicon glyphicon-trash'></span></a>";
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalFiltered;

        return Response::json($records);
    }

}
