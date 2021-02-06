<?php

namespace App\Repositories;
use Dotenv\Repository\RepositoryInterface;
use illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    // CREATE CONSTRACTOR TO APPEND MODEL TO REPO
    protected $model;
    
    public function __construct()
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model->paginate(PAGINATION_COUNT);
    }

    public function create(array $data)
    {
        $this->model->create($data);
    }

    public function update(array $data ,$id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    public function delete($id)
    {
        $this->model->delete($id);
    }

    public function show($id)
    {
        
    }

    // GET ALL RELATIONS FROM THIS MODEL 
    public function with($relations)
    {
        return $this->model->with($relations);
    }

}