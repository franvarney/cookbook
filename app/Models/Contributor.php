<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contributor extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'contributors';

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
	protected $fillable = ['user_id', 'cookbook_id', 'role_id'];

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
	public function cookbook()
	{
		return $this->belongsTo('App\Cookbook');
	}

	public function permission()
	{
		return $this->hasMany('App\ContributorPermission');
	}

	public function role()
	{
		return $this->belongsTo('App\Role');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
