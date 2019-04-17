<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
		'country_id'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token'
	];

	/**
	 *
	 * Many-to-many \App\Models\Role
	 *
	 **/
	public function roles() {
		return $this->belongsToMany( 'App\Models\Role', 'role_user', 'user_id', 'role_id' );
	}

	/**
	 * $roles mixed
	 **/
	public function hasAnyRole( $roles ) {
		if ( is_array( $roles ) ) {
			foreach ( $roles as $role ) {
				if ( $this->hasRole( $role ) ) {
					return true;
				}
			}
		} else {
			if ( $this->hasRole( $roles ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * $role mixed
	 * isset this 'name' in \App\Models\Role
	 **/
	public function hasRole( $role ) {
		if ( $this->roles()->where( 'name', $role )->first() ) {
			return true;
		}

		return false;
	}
}