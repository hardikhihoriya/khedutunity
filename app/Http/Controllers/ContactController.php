<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Contact;
use Redirect;
use Illuminate\Validation\Rule;
use Config;
use Response;
use Validator;

class ContactController extends Controller {

    public function __construct() {
        $this->objContact = new Contact();
    }

    public function index() {
        return view('admin.contact-listing');
    }

    public function save() {
        $contactData = Input::all();
        $msg = [];
        if (!empty($contactData)) {
            $this->objContact->create($contactData);
            $msg['success'] = 'Thank You Very much !.....';
            return $msg;
        } else {
            $msg['error'] = 'Please Input All values....!';
            return $msg;
        }
    }

    public function listContactAjax() {
        $records = array();
        //processing custom actions
        if (Input::get('customActionType') == 'groupAction') {
            $action = Input::get('customActionName');
            $idArray = Input::get('id');
            switch ($action) {
                case "delete":
                    foreach ($idArray as $_idArray) {
                        $districtDelete = Contact::find($_idArray);                        
                        $districtDelete->delete();
                    }
                    $records["customMessage"] = trans('adminmsg.delete_district');
            }
        }
        $columns = array(
            0 => 'first_name',
            1 => 'last_name',
            2 => 'contact_email',
            3 => 'contact_subject',
            4 => 'message',
        );
        $order = Input::get('order');
        $search = Input::get('search');
        $records["data"] = array();
        $iTotalRecords = Contact::count();
        $iTotalFiltered = $iTotalRecords;
        $iDisplayLength = intval(Input::get('length')) <= 0 ? $iTotalRecords : intval(Input::get('length'));
        $iDisplayStart = intval(Input::get('start'));
        $sEcho = intval(Input::get('draw'));
        $records["data"] = Contact::select('*');
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
                $edit = route('contact.edit', $_records->id);                
                $records["data"][$key]['action'] = "&emsp;<a href='{$edit}' title='Edit Contact' ><span class='glyphicon glyphicon-edit'></span></a>                                                    
                                                    &emsp;<a href='javascript:;' data-id='" . $_records->id . "' class='btn-delete-district' title='Delete Contact' ><span class='glyphicon glyphicon-trash'></span></a>";
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $iTotalRecords;
        $records["recordsFiltered"] = $iTotalFiltered;

        return Response::json($records);
    }

}
