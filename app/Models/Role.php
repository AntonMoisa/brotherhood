<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * eloquent model belongToMany role to user
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
	 */
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_role', 'role_id', 'user_id');
    }
}
