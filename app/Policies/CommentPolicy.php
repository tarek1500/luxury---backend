<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
	use HandlesAuthorization;

	/**
	 * Determine whether the user can update the model.
	 *
	 * @param \App\User $user
	 * @param \App\Comment $comment
	 *
	 * @return mixed
	 */
	public function update(User $user, Comment $comment)
	{
		return $user->id === $comment->user_id;
	}

	/**
	 * Determine whether the user can delete the model.
	 *
	 * @param \App\User $user
	 * @param \App\Comment $commen
	 *
	 * @return mixed
	 */
	public function delete(User $user, Comment $comment)
	{
		return $user->id === $comment->user_id;
	}
}