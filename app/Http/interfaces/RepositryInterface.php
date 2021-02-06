<?php

namespace App\Http\interfaces;

use App\Http\interfaces\RepositryInterface;

interface RepositryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data ,$id);

    public function delete($id);

    public function show($id);
}