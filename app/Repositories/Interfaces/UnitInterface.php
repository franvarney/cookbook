<?php namespace App\RepositoryInterfaces;

interface UnitInterface extends BaseInterface {

	public function findByUnit($unit);
	public function firstOrCreate($unit);

}
