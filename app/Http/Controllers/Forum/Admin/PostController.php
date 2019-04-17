<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Models\ForumPost;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForumAdminNewPostRequest;
use App\Repositories\UserRepository;
use App\Repositories\CountryRepository;
use App\Repositories\ForumPostRepository;
use App\Repositories\ForumCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class PostController extends Controller
{
    /**
     * @var ForumPostRepository
     */
    private $forumPostRepository;

    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * @var ForumCategoryRepository
     */
    private $categoryRepository;

    /**
     * construct new model for search in repository
     *
     * UserController constructor.
     */
    public function __construct()
    {
        $this->forumPostRepository = app(ForumPostRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->countryRepository = app(CountryRepository::class);
        $this->categoryRepository = app(ForumCategoryRepository::class);
    }

    /**
     * search all post with country
     *
     * @param Request $request
     * @param $category
     * @param $published
     * @return mixed
     */
    public function index(Request $request)
    {
        ($request->publish === "moderation") ? $published = false : $published = true;
        $category = $request->project;

        ($request->country) ? $country = $request->country : $country = null;

        $users = $this->forumPostRepository->getPostsWithCountry($published, $category, $country);

        return $users;
    }

    /**
     * create new post
     *
     * @param ForumAdminNewPostRequest $request
     * @return bool
     */
    public function createNewPost(ForumAdminNewPostRequest $request)
    {
        $post = new ForumPost();
        $post->text = $request->text;
        $post->is_published = $request->is_published;
        if ($post->is_published) $post->published_at = now();
        $post->user_id = $request->user_id;
        $post->text = $request->text;
        $post->country_id = $this->countryRepository->getIdRu($request->country);
        $post->category_id = $this->categoryRepository->getIdSlug($request->category);
        $post->save();

        return 'success';
    }

    /**
     * edit post
     *
     * @param Request $request
     * @return Request
     */
    public function editPost(Request $request)
    {
        ($request->country) ? $country = $request->country : $country = null;

        $post = $this->forumPostRepository->getEdit($request->id);
        $post->country->ru;
        $post->user->name;

        return $post;
    }

    /**
     * update post
     *
     * @param Request $request
     * @return mixed
     */
    public function updatePost(Request $request)
    {
        $post = $this->forumPostRepository->getEdit($request->params['id']);
        if ($request->params['userId']) $post->user_id = $request->params['userId'];
        $post->text = $request->params['text'];
        $post->updated_at = now();
        if ($request->params['country']) {
            $post->country_id = $this->countryRepository->getIdRu($request->params['country']);
        };
        $post->save();

        return $post;
    }

    /**
     * delete post
     *
     * @param Request $request
     * @return string
     */
    public function deletePost(Request $request)
    {
        ForumPost::find($request->id)->delete();

        return 'success';
    }

    /**
     * change publish post
     *
     * @param Request $request
     * @return mixed
     */
    public function rePublish(Request $request)
    {
        $post = $this->forumPostRepository->getEdit($request->id);
        $post->is_published = $request->is_published;
        ($post->is_published) ? $post->published_at = null : $post->published_at = now();
        $post->save();
        return $post;
    }

    /**
     * search on country list who's into redis (language = rus)
     *
     * @param Request $request
     * @return array
     */
    public function searchCountry(Request $request)
    {
        $result = [];
        $searchWord = $request->params['search'];

        if ($searchWord) {
            $country = json_decode(Redis::get("ru"), true);

            foreach ($country as $key => $value) {
                if (mb_stripos($value, $searchWord) !== false) {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * search user in repository
     *
     * @param Request $request
     * @return mixed
     */
    public function searchUser(Request $request)
    {
        $result = $this->userRepository->getUsers($request->params['search']);

        return $result;
    }
}