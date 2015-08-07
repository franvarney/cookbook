<?php namespace App\Repositories;

use App\Models\Unit;
use App\RepositoryInterfaces\UnitInterface;

class UnitRepository extends BaseRepository implements UnitInterface
{
	public function findByUnit($unit)
	{
		$unit = Unit::where([
				'unit' => $unit
			])->first();

		if ( ! $unit) {
			return false;
		}

		return $unit;
	}

	public function firstOrCreate($unit)
	{
		// TODO format string - tolower?
		$new_unit = Unit::firstOrCreate($unit);
		return $new_unit->id;
	}
}