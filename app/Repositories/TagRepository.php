<?php namespace App\Repositories;

use App\Models\Tag;
use App\RepositoryInterfaces\TagInterface;

class TagRepository extends BaseRepository implements TagInterface
{
	public function clean($tags)
	{
		$tags = preg_replace('/\s+/', '', $tags); // remove all whitespace
		$tags = explode(',', $tags); // split tags by comma

		return $tags;
	}

	public function findByTag($tag)
	{
		$tag = Tag::where([
				'tag' => $tag
			])->first();

		return $tag;
	}

	public function find($id)
	{
		return Tag::find($id);
	}

	public function store($recipe_id, $tags)
	{
		$clean_tags = $this->clean($tags);
		foreach($clean_tags as $tag) {
			$new_tag = Tag::firstOrNew($tag);
			$new_tag->count++;
			$new_tag->save();
			$tag_ids[] = $new_tag->id;
		}

		return $tag_ids;
	}
}