<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'users';

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
	protected $fillable = ['username', 'first_name', 'last_name' 'email', 'location', 'is_admin'];

	/**
	* The attributes excluded from the model's JSON form.
	*
	* @var array
	*/
	protected $hidden = ['password', 'remember_token', 'deleted_at'];

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
		return $this->hasMany('App\Cookbook');
	}

	public function receiver()
	{
		return $this->belongsTo('App\ContributorRequest', 'id', 'receiver_user_id');
	}

	public function sender()
	{
		return $this->belongsTo('App\ContributorRequest', 'id', 'sender_user_id');
	}

}
