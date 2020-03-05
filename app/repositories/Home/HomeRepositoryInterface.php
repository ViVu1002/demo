<?php
    namespace App\Repositories\Home;
    use App\Repositories\BaseRepositoryInterface;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

    interface HomeRepositoryInterface extends BaseRepositoryInterface{
        public function phone(Request $request);
    }

?>
