<?php
namespace App\Repositories\Faculty;

use Illuminate\Database\Eloquent\Model;
use App\Faculty;
use App\Repositories\BaseRepository;

class FacultyRepository extends BaseRepository implements FacultyRepositoryInterface
{
    public function __construct(Faculty $faculty)
    {
        parent::__construct($faculty);
    }
}

?>
