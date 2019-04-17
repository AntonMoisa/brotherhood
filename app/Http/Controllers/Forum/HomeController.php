<?php

namespace App\Http\Controllers\Forum;

use App\Mail\MailClass;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeedbackRequest;
use App\Repositories\ForumCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * @var ForumCategoryRepository
     */
    private $forumCategoryRepository;

    /**
     * Create model for repository
     *
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->forumCategoryRepository = app(ForumCategoryRepository::class);
    }

    /**
     * Show start page && load country name with Redis
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function index()
    {
        if (!Redis::get('ru') || !Redis::get('en')) {
            Redis::set('ru', Storage::disk('redis')->get('ru.json'));
            Redis::set('en', Storage::disk('redis')->get('en.json'));
        }

        $categories = $this->forumCategoryRepository->getForComboBox();

        return view('forum.index', compact('categories'));
    }

    /**
     * Send feedback mail to admin
     *
     * @param FeedbackRequest $request
     *
     */
    public function sendMail(FeedbackRequest $request)
    {
        if ($request->isMethod('POST')) {

            $mail_admin = env('MAIL_ADMIN');
            $mail_user = env('MAIL_USERNAME');

            !$request['EMAIL'] ? $request['EMAIL'] = $mail_user : $mail_user = $request['EMAIL'];
            if (!$request['COMPANY']) $request['COMPANY'] = 'UNKNOWN';

            $layout_mail = [
                'name' => $request['NAME'],
                'country' => $request['COUNTRY'],
                'email' => $request['EMAIL'],
                'text' => $request['NEEDS'],
                'company' => $request['COMPANY'],
            ];

            Mail::to($mail_admin)->send(new MailClass($layout_mail));
        }
    }

    /**
     * Get country name for autocomplite witch Redis
     *
     * @param Request $request
     * @return array
     */
    public function selectedLanguage(Request $request)
    {
        $result = [];
        $word = $request->queryString;

        if ($word) {
            $country = json_decode(Redis::get(App::getlocale()), true);

            foreach ($country as $key => $value) {
                if (mb_stripos($value, $word) !== false) {
                    $result[] = $value;
                }
            }
        }

        return $result;
    }

    /**
     * switch getLocale on session
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function setlocale(Request $request)
    {
        $locale = $request['languages'];

        if (in_array($locale, Config::get('app.locales'))) {
            Session::put('locale', $locale);
        }

        return redirect()->back();
    }

    /**
     * load image from Redis
     *
     * @param $slug
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getImage($slug)
    {
        if (! Redis::get($slug)){
            Redis::set($slug, Storage::disk('image')->get($slug));
        }
        $image = Redis::get($slug);

        return $image;
    }
}
