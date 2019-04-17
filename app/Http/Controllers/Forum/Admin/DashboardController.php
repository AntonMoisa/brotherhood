<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\ForumPostRepository;
use App\Repositories\ForumCategoryRepository;
use App\Repositories\UserRepository;

class DashboardController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var ForumPostRepository
     */
    private $forumPostRepository;

    /**
     * @var ForumCategoryRepository
     */
    private $forumCategoryRepository;

    /**
     * construct new model for search in repository
     *
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->forumPostRepository = app(ForumPostRepository::class);
        $this->forumCategoryRepository = app(ForumCategoryRepository::class);
    }

    /**
     * Dashboard panel for admin
     *
     * @return mixed
     */
    public function index()
    {
        $data['count_users'] = $this->userRepository->getCountUser();
        $data['published'] = $this->forumPostRepository->getPublishedCount();
        $data['on_moderate'] = $this->forumPostRepository->getOnModerateCount();

        return $data;
    }

    /**
     * setting to coordinate && mail
     * if we get exception parameter we'll return 404
     *
     * @param Request $request
     * @param $param
     * @return array|int|string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function settings(Request $request, $param)
    {
        if ($param === 'mail') {
            $environmentVariable = [
                'MAIL_USERNAME' => $request->MAIL_USERNAME,
                'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
                'MAIL_ADMIN' => $request->MAIL_ADMIN
            ];
            foreach ($environmentVariable as $item => $key) {
                if (!$key) {
                    $environmentVariable[$item] = env($item);
                } else {
                    self::changeEnvironmentVariable($item, $key);
                }
            }

            return $environmentVariable;
        }

        if ($param === 'coordinate') {
            $file = json_decode(Storage::disk('public')->get('ru.place.json'));
            $count = $file->features;

            return $count;
        }

        if ($param === 'newCoordinate') {

            $old_file = json_decode(Storage::disk('public')->get('ru.place.json'));
            $count = count($old_file->features);
            $mag = rand(10, 25);
            $coordinates = [
                0 => $request->coordinate1,
                1 => $request->coordinate2
            ];
            self::changeMessagePlace($count, $request->text, $coordinates, $mag);

            return 'success';
        }

        if ($param === 'editCoordinate') {

            if (!$request->text) {
                $file = json_decode(Storage::disk('public')->get('ru.place.json'), true);
                $item = $file['features'][$request->id];
            } else {
                $coordinates = [
                    0 => $request->coordinate1,
                    1 => $request->coordinate2
                ];
                self::changeMessagePlace($request->id, $request->text, $coordinates);

                return 'success';
            }

            return $item;
        }

        if ($param === 'deleteCoordinate') {

            $oldFile = json_decode(Storage::disk('public')->get('ru.place.json'), true);
            $oldArray = $oldFile['features'];
            unset($oldArray[$request->id]);
            $oldFile['features'] = array_values($oldArray);
            $newFile = json_encode($oldFile);
            json_encode(Storage::disk('public')->put('ru.place.json', $newFile));

            return 'success';
        }

        return abort(404);
    }

    /**
     * get url project to asideBar
     *
     * @return mixed
     */
    public function projectSlug()
    {
        $getAllProject = $this->forumCategoryRepository->getAllProject();

        return $getAllProject;
    }

    /**
     * Change or create new coordinate, message on Earth
     *
     * @param $item
     * @param null $message
     * @param null $coordinates
     * @param null $mag
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function changeMessagePlace($item, $message = null, $coordinates = null, $mag = null)
    {
        if ($item <= 0) $item = 0;

        $old_file = json_decode(Storage::disk('public')->get('ru.place.json'));
        $count = count($old_file->features);

        if ($item >= $count) {
            $item = $count;
            $old_file->features[$item] = $old_file->features[0];
        }

        if ($mag) $old_file->features[$item]->properties->mag = $mag;
        if ($message) $old_file->features[$item]->properties->place = $message;
        if ($coordinates) $old_file->features[$item]->geometry->coordinates = $coordinates;

        $new_file = json_encode($old_file);
        json_encode(Storage::disk('public')->put('ru.place.json', $new_file));
    }

    /**
     * Change email for recaptcha in environment file
     *
     * @param $key
     * @param $value
     */
    public static function changeEnvironmentVariable($key, $value)
    {
        $path = base_path('.env');

        if (env($key)) {
            $old = env($key);
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=" . $old, "$key=" . $value, file_get_contents($path)
            ));
        }
    }
}
