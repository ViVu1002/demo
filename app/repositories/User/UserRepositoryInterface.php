<?php
namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Repositories\BaseRepositoryInterface;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function uploadImages($images);
}

?>
