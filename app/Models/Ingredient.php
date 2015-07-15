<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'ingredients';

	/**
	* The attributes that are guarded.
	*
	* @var array
	*/
	protected $guarded = ['id'];

	/*
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['ingredient', 'count'];

	/**
	 * Timestamps
	 */
	public $timestamps = false;

	/**
	 * Relationships
	 */
	public function recipe_ingredient()
	{
		return $this->hasMany('App\Models\RecipeIngredient');
	}

}
