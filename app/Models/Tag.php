<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['tag'];

	/**
	 * Timestamps
	 */
	public $timestamps = false;

	/**
	 * Relationships
	 */
	public function recipe()
	{
		return $this->hasMany('App\Recipe');
	}

}
