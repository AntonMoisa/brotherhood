<?php

namespace App\Repositories;

use App\Models\User as Model;

/**
 * Class UserRepository
 *
 * @package App\Repositories
 */
class UserRepository extends CoreRepository
{
    /**
     * return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get model for edit in admin
     *
     * @param $email
     * @return mixed
     */
    public function getUser($email)
    {
        $data = $this
            ->startConditions()
            ->where('email', '=', $email)
            ->first();

        return $data;
    }

    /**
     * Get model for edit in admin
     *
     * @param int $id
     * @return Model
     */
    public function getUpdate($id)
    {
        return $this
            ->startConditions()
            ->find($id);
    }

    /**
     * Get model for edit in admin with role
     *
     * @param int $id
     * @return Model
     */
    public function getEdit($id)
    {
        $columns = [
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'users.phone as phone',
            'users.created_at as createdAt',
            'users.updated_at as updatedAt',
            'users.country_id as countryId',
            'countries.ru as countryName',
            'roles.id as rolesId',
            'roles.name as rolesName'
        ];

        $data = $this
            ->startConditions()
            ->select($columns)
            ->leftjoin('countries', 'country_id', '=', 'countries.id')
            ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->where('users.id', $id)
            ->orderBy('users.name')
            ->get();

        return $data;
    }

    /**
     * get count users
     *
     * @return mixed
     */
    public function getCountUser()
    {
        $data = $this
            ->startConditions()
            ->count();

        return $data;
    }

    /**
     * get all users with search
     *
     * @param $wordSearch
     * @param $columnSearch
     * @return mixed
     */
    public function getAllUsers($wordSearch, $columnSearch)
    {
        $columns = [
            'users.id as id',
            'users.name as name',
            'users.email as email',
            'users.phone as phone',
            'countries.ru as country',
            'roles.name as roles'
        ];

        $data = $this
            ->startConditions()
            ->select($columns)
            ->leftjoin('countries', 'country_id', '=', 'countries.id')
            ->leftjoin('role_user', 'users.id', '=', 'role_user.user_id')
            ->leftjoin('roles', 'role_user.role_id', '=', 'roles.id')
            ->when($wordSearch, function ($query) use ($columnSearch, $wordSearch) {
                return $query->where($columnSearch, 'like', '%' . $wordSearch . '%');
            })
            ->orderBy('users.name')
            ->paginate(20);

        return $data;
    }

    /**
     * Get model for autocomplite in admin
     *
     * @param $email
     * @return mixed
     */
    public function getUsers($name)
    {
        $columns = [
            'id',
            'name',
        ];

        $data = $this
            ->startConditions()
            ->select($columns)
            ->where('name', 'like', '%' . $name . '%')
            ->limit(15)
            ->toBase()
            ->get();

        return $data;
    }
}