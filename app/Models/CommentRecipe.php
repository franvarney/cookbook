<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentRecipe extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comment_recipe';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['recipe_id', 'comment_id'];

	/**
	 * Relationships
	 */
	public function recipe()
	{
		return $this->belongsTo('App\Recipe');
	}

	public function comment()
	{
		return $this->belongsTo('App\Comment');
	}

}
