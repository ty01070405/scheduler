<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sub_url',
    ];
	
	public function departments(){
		return $this->hasMany('App\Department');
	}
}
