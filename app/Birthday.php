<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Birthday extends Model {

    use Notifiable;

use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ku_birthday';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['firstname', 'lastname', 'birthday_email', 'birthdate', 'birthdayImage', 'tagline','address','message','status'];

    /**
     * The attributes that are dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function scopeSearchByName($query, $value) {
        return $query->Where('firstname', 'LIKE', "%$value%");
    }
    
}
