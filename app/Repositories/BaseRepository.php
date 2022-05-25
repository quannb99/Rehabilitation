<?php

namespace App\Repositories;

class BaseRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     * @param Illuminate\Database\Eloquent\Model $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Get detail
     * @param $conditions
     * @return mixed
     */
    public function detail($conditions)
    {
        if (!is_array($conditions)){
            return $this->model->findOrFail($conditions);
        }

        return $this->model->where($conditions)->firstOrFail();
    }

    /**
     * Create
     * @param $data
     * @return mixed
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * Saving multiple records
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * Update
     * @param $data
     * @param $id
     * @return mixed
     */
    public function update($data, $id)
    {
        return $this->detail($id)->update($data);
    }

    /**
     * Get collection
     * @param $params
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getCollection($params)
    {
        $query = $this->model->query()
            ->with($params['with'] ?? [])
            ->select($params['select'] ?? '*')
            ->where($params['conditions'] ?? []);
        if (!empty($params['where_in'])) {
            $whereIn = $params['where_in'];
            foreach ($whereIn as $key => $value) {
                $query->whereIn($key, $value);
            }
        }
        if (!empty($params['where_not_in'])) {
            $whereNotIn = $params['where_not_in'];
            foreach ($whereNotIn as $key => $value) {
                $query->whereNotIn($key, $value);
            }
        }

        return $query;
    }

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        return $this->detail($id)->delete();
    }

    /**
     * Update multiple items
     * @param array $conditions
     * @param array $items
     * @return mixed
     */
    public function updateMultipleItems(array $conditions, array $items)
    {
        return $this->model
            ->where($conditions)
            ->update($items);
    }

    /**
     * Update multiple items by id.
     * @param $ids
     * @param $items
     * @return mixed
     */
    public function updateMultipleItemsById($ids, $items)
    {
        return $this->model
            ->whereIn('id', $ids)
            ->update($items);
    }
}
