<?php

namespace App\Repositories;

use App\Models\User;
use DB;

class BaseRepository
{
    const MODEL = User::class;

    public function optionQuery($options, $query = null)
    {
        if (is_null($query)) {
            $query = $this->query();
        }
        foreach ($options as $key => $option) {
            if (is_array($option)) {
                if (strtolower($option[1]) == "in") {
                    $query->whereIn($option[0], $option[2]); //["start","in",[1,2,3]]
                } else {
                    $query->where($option[0], $option[1], $option[2]); //["start",">",666]
                }
            } else {
                $query->where($key, $option);
            }
        }
        return $query;
    }

    public function find($id, $options = [])
    {
        $query = $this->optionQuery($options);
        return $query->find($id);
    }
    public function create($attributes = [])
    {
        return $this->query()->create($attributes);
    }

    public function insert($attributes = [])
    {
        return $this->query()->insert($attributes);
    }

    public function query()
    {
        return call_user_func(static::MODEL . '::query');
    }

}
