<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Support\Collection;
class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAllList()
    {
        return $this->model->all();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($id, $data)
    {
        $models = $this->getListById($id);
        return $models->update($data);
    }

    public function getListById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function delete($id)
    {
        $models = $this->getListById($id);
        return $models->delete();
    }
}

?>
