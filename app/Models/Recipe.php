<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Recipe extends Model {

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'recipes';

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
	protected $fillable = [ 'user_id', 'cookbook_id', 'unit_id', 'title', 'prep_time', 'cook_time', 'yields_amount', 'description', 'source_url', 'is_public'];

	/**
	* The attributes that hidden.
	*
	* @var array
	*/
	protected $hidden = ['password', 'deleted_at', 'comment', 'tag'];

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
	public function comment()
	{
		return $this->belongsToMany('App\Comment');
	}

	public function cookbook()
	{
	  return $this->belongsTo('App\Cookbook');
	}

	public function tag()
	{
		return $this->belongsToMany('App\Tag')->withTimestamps();
	}

	public function unit()
	{
		return $this->belongsTo('App\Unit');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
