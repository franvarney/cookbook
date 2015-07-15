<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecipeDirection extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'recipe_directions';

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
	protected $fillable = ['recipe_id', 'direction'];

	/**
	 * Soft Deletes
	 */
	use SoftDeletes;

	/**
	* Dates
	*
	* @var array
	*/
	protected $dates = ['created_at', 'updated_at', 'deleted_at'];

	/**
	 * Relationships
	 */
	public function recipe()
	{
		return $this->belongsTo('App\Models\Recipe');
	}

}
