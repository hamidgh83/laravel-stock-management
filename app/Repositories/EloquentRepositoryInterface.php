<?php

namespace App\Repositories;

interface EloquentRepositoryInterface
{
    public function getModel(): string;
    public function create(array $data);
    public function update(array $data, $model);
    public function delete($id): bool;
    public function find(int $id);
    public function findAll();
    public function findBy($column, $value);
}
