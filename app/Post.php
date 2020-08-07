<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'body'
	];

	/**
	 * Perform any actions required before the model boots.
	 *
	 * @return void
	 */
	protected static function booting()
	{
		static::deleting(function ($post) {
			$post->comments()->delete();
		});
	}

	/**
	 * Many-to-one relation to the user.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}

	/**
	 * One-to-many relation to comments.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}
}