<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comments';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['comment'];

	/**
	 * Relationships
	 */
	public function recipe()
	{
		return $this->belongsTo('App\Recipe');
	}

}
