<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Repositories\CountryRepository;
use App\Repositories\ForumPostRepository;
use Illuminate\Http\Request;

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Forum\Admin
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * @var ForumPostRepository
     */
    private $postRepository;

    /**
     * construct new model for search in repository
     *
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->countryRepository = app(CountryRepository::class);
        $this->postRepository = app(ForumPostRepository::class);
    }

    /**
     * Show all user with search column
     *
     * @param Request $request
     * @return mixed
     */
    public function show(Request $request)
    {
        $wordSearch = $request->selectedSearch;
        $columnSearch = $request->selected;

        $users = $this->userRepository->getAllUsers($wordSearch, $columnSearch);

        return $users;
    }

    /**
     * get user for edit in admin panel
     *
     * @param Request $request
     * @return mixed
     */
    public function newOrEditUser(Request $request)
    {
        if ($request->id) {
            $data['user'] = $this->userRepository->getEdit($request->id);
            $data['role'] = [];
            foreach ($data['user'] as $user) {
                $data['role'][] = $user->rolesId;
            }
        } else {
            $data['user'] = null;
        }

        return $data;
    }

    /**
     * update user
     *
     * @param Request $request
     * @return mixed
     */
    public function updateUser(Request $request)
    {
        $roles = $request->role * 1;
        $country = $this->countryRepository->getIdRu($request->country);

        if ($request->id) {
            $user = $this->userRepository->getUpdate($request->id);

            $user->name = $request->user['name'];
            $user->email = $request->user['email'];
            $user->phone = $request->user['phone'];
            if ($request->user['password']) {
                $user->password = bcrypt($request->user['password']);
            }
            $user->updated_at = time();
            $user->country_id = $country;
            $user->save();
        } else {
            $data_user['name'] = $request->user['name'];
            $data_user['country_id'] = $country;
            $data_user['password'] = bcrypt($request->user['password']);
            $data_user['email'] = $request->user['email'];
            if ($request->phone) $data_user['phone'] = $request->user['phone'];

            $user = new User($data_user);
            $user->save();
        }
        $user->roles()->detach([1, 2, 3]);
        $user->roles()->attach($roles);

        return 'success';
    }

    /**
     * delete user
     *
     * @param Request $request
     * @return string
     */
    public function deleteUser(Request $request)
    {
        $this->postRepository->deleteForce($request->id);
        $user = $this->userRepository->getUpdate($request->id);
        $user->roles()->detach();
        $user->forceDelete();

        return 'success';
    }
}
