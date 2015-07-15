<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContributorPermission extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'contributor_permissions';

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
	protected $fillable = ['user_id', 'contributor_id', 'can_add_contributors', 'can_edit_cookbook', 'can_delete_cookbook', 'can_edit_recipe', 'can_delete_recipe'];

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
	public function contributor()
	{
		return $this->belongsTo('App\Models\Contributor');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

}
