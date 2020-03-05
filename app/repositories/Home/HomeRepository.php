<?php
    namespace App\Repositories\Home;
    use App\Person;
use App\Repositories\BaseRepository;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

    class HomeRepository extends BaseRepository implements HomeRepositoryInterface{
        public function __construct(Person $person)
        {
            parent::__construct($person);
        }

        public function phone(Request $request)
        {
            //
        }
    }
?>
