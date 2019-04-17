<?php

namespace App\Http\Controllers\Forum;

use App\Models\Role;
use App\Models\User;
use App\Models\ForumPost;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForumPostCreateRequest;
use App\Repositories\UserRepository;
use App\Repositories\CountryRepository;
use App\Repositories\ForumPostRepository;
use App\Repositories\ForumCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redis;

class ProjectController extends Controller
{
    /**
     * @var ForumPostCreateRequest
     */
    private $forumPostRepository;

    /**
     * @var ForumCategoryRepository
     */
    private $forumCategoryRepository;

    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * construct new model for search in repository
     *
     * ProjectController constructor.
     */
    public function __construct()
    {
        $this->forumPostRepository = app(ForumPostRepository::class);
        $this->forumCategoryRepository = app(ForumCategoryRepository::class);
        $this->countryRepository = app(CountryRepository::class);
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Page with show post in project
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($id)
    {
        $category = $this->forumCategoryRepository->getCategoryTitle($id);
        $count_user = $this->userRepository->getCountUser();
        return view('forum.builders', compact('category', 'count_user'));
    }

    /**
     * Load post with selected language, country
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function loadPost(Request $request, $id)
    {
        if ($request->country) {
            $county = array_search($request->country, json_decode(Redis::get(App::getlocale()), true));
        } else {
            $county = null;
        }

        $request->personsLength ? $start = $request->personsLength : $start = 0;
        $posts = $this->forumPostRepository->getAllWithCategory($id, $start, $county);

        return $posts;
    }

    /**
     * Create new posts with new or old user
     *
     * @param ForumPostCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function newPost(ForumPostCreateRequest $request)
    {
        $old_user = $this->userRepository->getUser($request->email);
        $country = $this->getCountyId($request->country);

        if (!$request->email || !$old_user) {

            $role_user = Role::where('name', 'User')->first();

            $data_user['name'] = $request->name;
            $data_user['country_id'] = $country;
            $data_user['password'] = bcrypt("$request->name");
            $data_user['email'] = $request->email;
            if ($request->phone) $data_user['phone'] = $request->phone;

            $user = new User($data_user);
            $user->save();
            $user->roles()->attach($role_user);

        } else {

            if ($request->phone) $old_user->phone = $request->phone;
            $old_user->updated_at = time();

            $user = $old_user;
            $user->save();
        }

        $cut_url = str_replace('http://bratstvo.world/project/', '', $request->url());
        $category_id = substr($cut_url, 0, mb_stripos($cut_url, '/'));

        $post = new ForumPost();
        $post->country_id = $country;
        $post->category_id = $category_id;
        $post->text = $request->text;
        $post->user()->associate($user);
        $post->save();

        if ($post && $user) {
            return redirect()->route('forum.project', $category_id);
        } else {
            return back();
        }
    }


    /**
     * Get country id
     *
     * @param $search
     * @return mixed
     */
    public function getCountyId($search)
    {
        $county_name = array_search($search, json_decode(Redis::get(App::getlocale()), true));
        $country_id = $this->countryRepository->getId($county_name);

        return $country_id;
    }
}
