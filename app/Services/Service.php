<?php


namespace App\Services;

abstract class Service
{
    protected $model;

    public function __construct()
    {
        $this->model = app($this->model());
    }

    abstract protected function model();

    public function all()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function query()
    {
        return $this->model->query();
    }

    public function save($model)
    {
        return $model->save();
    }

    public function latest()
    {
        return $this->model->latest();
    }

    public function paginate($model, $limit = 15, $columns = ['*'], $pageName = 'page', $page = null)
    {
        return $model->paginate($limit,$columns,$pageName,$page);
    }

    public function getBy($column, $value, $limit = 15)
    {
        return $this->model->where($column, $value)->limit($limit)->get();
    }

    public function firstBy($conditions)
    {
        return $this->model->where($conditions)->first();
    }

    public function first($models)
    {
        return $models->first();
    }

    public function filterBy($model, $request)
    {
        return $model->filter($request);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function firstOrCreate(array $data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function update($model, array $data)
    {
        return $model->update($data);
    }

    public function updateBy(array $conditions, array $data)
    {
        return $this->model->where($conditions)->update($data);
    }

    public function delete($model)
    {
        return $model->delete();
    }

    public function deleteBy($conditions)
    {
        return $this->model->where($conditions)->delete();
    }

    public function exists($column, $value)
    {
        return $this->model->where($column, $value)->exists();
    }

    public function existsBy(array $conditions)
    {
        return $this->model->where($conditions)->exists();
    }

    public function count()
    {
        return $this->model->count();
    }

    public function countBy($conditions)
    {
        return $this->model->where($conditions)->count();
    }

    public function insert(array $targets = []){
        return $this->model->insert($targets);
    }

    public function insertOrIgnore(array $data)
    {
        return $this->model->insertOrIgnore($data);
    }

    public function orderBy($column, $direction){
        return $this->model->orderBy($column, $direction);
    }

    public function where($model, $column, $value){
        return $model->where($column, $value);
    }

    public function whereNull($column)
    {
        return $this->model->whereNull($column);
    }

    public function whereIn($model, $column, $value){
        return $model->whereIn($column, $value);
    }

    public function getAccessible($model, $ownerId){
        return $model->where('owner_id', $ownerId);
    }
}
