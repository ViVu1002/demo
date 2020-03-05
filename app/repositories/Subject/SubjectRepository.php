<?php
namespace App\Repositories\Subject;

use Illuminate\Database\Eloquent\Model;
use App\Subject;
use App\Repositories\BaseRepository;

class SubjectRepository extends BaseRepository implements SubjectRepositoryInterface
{
    public function __construct(Subject $subject)
    {
        parent::__construct($subject);
    }
}

?>
