<?php namespace App;

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
	protected $guarded = ['id', 'deleted_at'];

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
		return $this->belongsTo('Recipe');
	}

	public function user()
	{
		return $this->belongsTo('User');
	}

}
