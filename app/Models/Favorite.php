<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'favorites';

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
	protected $fillable = ['user_id', 'recipe_id', 'favorite'];

	/**
	 * Soft Deletes
	 */
	use SoftDeletes;

	/**
	* Dates
	*
	* @var array
	*/
	protected $dates = ['created_at', 'updated_at'];

	/**
	 * Relationships
	 */
	public function recipe()
	{
		return $this->belongsTo('App\Models\Recipe');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

}
