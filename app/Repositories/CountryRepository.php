<?php

namespace App\Repositories;

use App\Models\Country as Model;

/**
 * Class CountryRepository
 *
 * @package App\Repositories
 */
class CountryRepository extends CoreRepository
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
     * @return Model
     */
    public function getId($name)
    {
        $data = $this
            ->startConditions()
            ->where('name', '=', $name)
            ->first()
            ->id;

        return $data;
    }

    /**
     * Get id on ru-list for edit in admin
     *
     * @param int $id
     * @return Model
     */
    public function getIdRu($name)
    {
        $data = $this
            ->startConditions()
            ->where('ru', '=', $name)
            ->first()
            ->id;

        return $data;
    }
}