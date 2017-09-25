<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class taluka extends Model {

    use Notifiable;

use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ku_taluka';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['taluka_name', 'district_code', 'district_id', 'taluka_image', 'taluka_description', 'status'];

    /**
     * The attributes that are dates
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    public function scopeSearchByName($query, $value) {
        return $query->Where('taluka_name', 'LIKE', "%$value%");
    }
    
}
