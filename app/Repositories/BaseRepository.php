<?php

namespace App\Repositories;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 * @package App\Repositories
 */
abstract class BaseRepository implements EloquentRepositoryInterface
{
    protected array $fillable = [];

    /**
     * @var Container
     */
    private Container $container;

    /**
     * BaseRepository constructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    abstract public function getModel(): string;

    public function create(array $data)
    {
        $model = $this->fill($data, $this->makeModel());

        $model->save();

        return $model;
    }

    /**
     * Update a database object
     *
     * @param array $data
     * @param int|Model $model
     * @param array $fillable
     *
     * @return Model
     */
    public function update(array $data, $model, array $fillable = [])
    {
        if (! ($model instanceof Model)) {
            $model = $this->find($model);
        }

        $model = $this->fill($data, $model, $fillable);
        $model->save();

        return $model;
    }

    public function delete($object): bool
    {
        if (is_numeric($object)) {
            $object = $this->find($object)->first();
        }

        return $object->delete();
    }

    public function save(Model $object): bool
    {
        return $object->save();
    }

    public function find(int $id, $select = ['*']): ?Model
    {
        return $this->query()->find($id, $select);
    }

    public function findAll()
    {
        return $this->load($this->query()->get());
    }

    public function findBy($column, $value, $select = ['*'])
    {
        return $this->query()
            ->where($column, '=', $value)
            ->first($select);
    }

    /**
     * Load $object
     *
     * @param $object
     *
     * @return mixed
     */
    public function load($object)
    {
        return $object;
    }

    /**
     * Make model
     *
     * @return Model
     *
     * @throws RuntimeException
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeModel(): Model
    {
        $model = $this->container->make($this->getModel());

        if (! $model instanceof Model) {
            throw new \RuntimeException(
                "Class {$this->getModel()} must be an instance of Illuminate\\Database\\Eloquent\\Model",
            );
        }

        return $model;
    }

    /**
     * This method will fill the given $object by the given $array.
     * If the $fillable parameter is not available it will use the fillable
     * array of the class.
     *
     * @param array $data
     * @param Model $model
     * @param array $fillable
     *
     * @return mixed
     */
    public function fill(array $data, Model $model, array $fillable = [])
    {
        if (empty($fillable)) {
            $fillable = $this->fillable;
        }

        if (! empty($fillable)) {
            // just fill when fillable array is not empty
            $model->fillable($fillable)->fill($data);
        }

        return $model;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws RepositoryException
     */
    public function query()
    {
        return $this->makeModel()->newQuery();
    }

    public function loadRelations(Model $model, array $relations = []): Model
    {
        return $model->load($relations);
    }
}
