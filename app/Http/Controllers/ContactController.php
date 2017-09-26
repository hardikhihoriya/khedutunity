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

}
