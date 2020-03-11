<?php
namespace App\Repositories\Person;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use App\Person;
use App\Repositories\BaseRepositoryInterface;

interface PersonRepositoryInterface extends BaseRepositoryInterface
{
    public function uploadImages($images);

    public function search($data = [], $subject_count = 0);

    public function getPoint();

}

?>
