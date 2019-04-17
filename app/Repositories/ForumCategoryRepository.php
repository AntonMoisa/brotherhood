<?php

namespace App\Repositories;

use App\Models\ForumCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ForumCategoryRepository
 *
 * @package App\Repositories
 */
class  ForumCategoryRepository extends CoreRepository
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
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this
            ->startConditions()
            ->find($id);
    }

    /**
     * get slug for admin panel
     *
     * @param $slug
     * @return mixed
     */
    public function getIdSlug($slug)
    {
        return $this
            ->startConditions()
            ->where('slug', '=', $slug)
            ->first()
            ->id;
    }

    /**
     * Get list category for show on collection list
     *
     * @return Collection
     */
    public function getForComboBox()
    {
        $columns = implode(', ', [
            'id',
            'title',
        ]);

        $data = $this->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $data;
    }

    /**
     * get title
     *
     * @param $id
     * @return mixed
     */
    public function getCategoryTitle($id)
    {
        $columns = implode(', ', [
            'id',
            'title'
        ]);

        $data = $this
            ->startConditions()
            ->where('id', '=', $id)
            ->selectRaw($columns)
            ->toBase()
            ->first();

        return $data;
    }

    /**
     * get all project with name && slug for url
     *
     * @return mixed
     */
    public function getAllProject()
    {
        $columns = [
            'title',
            'slug'
        ];

        $data = $this
            ->startConditions()
            ->select($columns)
            ->get();

        return $data;
    }

    /**
     * get all category with paginator
     *
     * @param null $perPage
     * @return mixed
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title'];

        $data = $this
            ->startConditions()
            ->select($columns)
            ->paginate($perPage);

        return $data;
    }
}