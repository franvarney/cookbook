<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContributorRequest extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'contributor_requests';

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
	protected $fillable = ['user_id', 'cookbook_id', 'sender_user_id', 'receiver_user_id', 'approved'];

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
		return $this->belongsTo('App\Models\Cookbook');
	}

	public function receiver()
	{
		return $this->belongsTo('App\Models\User', 'receiver_user_id', 'id');
	}

	public function sender()
	{
		return $this->belongsTo('App\Models\User', 'sender_user_id', 'id');
	}

}
