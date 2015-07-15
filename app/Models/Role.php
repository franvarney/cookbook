<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'roles';

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
	protected $fillable = ['role'];

	/**
	 * Timestamps
	 */
	public $timestamps = false;

	/**
	 * Relationships
	 */
	public function role()
	{
		return $this->morphTo();
	}

}
