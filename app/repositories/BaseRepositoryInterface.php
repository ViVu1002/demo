<?php
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAllList();

    public function getListById($id);

    public function create($data);

    public function update($id, $data);

    public function delete($id);
}

?>
