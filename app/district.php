<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class district extends Model {

    use Notifiable;

use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ku_district';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['district_name', 'district_code', 'state_code', 'district_image'];

    /**
     * The attributes that are dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function scopeSearchByName($query, $value) {
        return $query->Where('district_name', 'LIKE', "%$value%");
    }
}
