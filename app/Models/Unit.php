<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'units';

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
	protected $fillable = ['unit'];

	/**
	 * Timestamps
	 */
	public $timestamps = false;

	/**
	 * Relationships
	 */
	public function recipe()
	{
		return $this->hasMany('App/Models/Recipe');
	}

	public function recipeIngredient()
	{
		return $this->hasMany('App/Models/RecipeIngredient');
	}

}
