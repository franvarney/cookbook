<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cookbook extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'cookbooks';

	/**
	* The attributes that are guarded.
	*
	* @var array
	*/
	protected $guarded = ['id'];

	/**
	* The attributes that are mass assignable.
	*
	* @var array
	*/
	protected $fillable = ['user_id', 'name', 'description', 'is_public'];

	/**
	* The attributes that hidden.
	*
	* @var array
	*/
	protected $hidden = ['deleted_at'];

	/**
	* Soft Deletes
	*/
	use SoftDeletes;

	/**
	* Dates
	*
	* @var array
	*/
	protected $dates = ['created_at', 'update_at', 'deleted_at'];

	/**
	* Relationships
	*/
	public function user()
	{
		return $this->belongsTo('App\user');
	}

}
