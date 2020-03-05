<?php
namespace App\Repositories\Point;

use Illuminate\Database\Eloquent\Model;
use App\Point;
use App\Repositories\BaseRepository;

class PointRepository extends BaseRepository implements PointRepositoryInterface
{
    public function __construct(Point $point)
    {
        parent::__construct($point);
    }
}

?>
