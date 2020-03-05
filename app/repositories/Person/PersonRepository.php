<?php
namespace App\Repositories\Person;

use App\Point;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use App\Person;
use App\Repositories\BaseRepository;
use App\Subject;
use Carbon\Carbon;

class PersonRepository extends BaseRepository implements PersonRepositoryInterface
{
    protected $model;

    public function __construct(Person $person)
    {
        parent::__construct($person);
    }

    public function uploadImages($images = 'image')
    {
        $image = request()->file($images);
        $name = time() . '.' . $image->getClientOriginalExtension();
        $image->move('picture', $name);
        return sprintf('picture/%s', $name);
    }

    public function search($request = [], $subject_count = 0, $paginate = 3)
    {
        $students = $this->model->newQuery();
        // age
        if (!empty($request['min_age'])) {
            $min = Carbon::now()->subYear($request['min_age'])->startOfYear()->format('Y-m-d');
            $students->whereDate('date', '<=', $min);
        }
        if (!empty($request['max_age'])) {
            $max = Carbon::now()->subYear($request['max_age'])->startOfYear()->format('Y-m-d');
            $students->whereDate('date', '>=', $max);
        }
        //dd($students);
        if (!empty($request['student'])) {
            if ($request['student'] === Person::FINISH) {
                $students->has('subjects', $subject_count);
            } elseif ($request['student'] === Person::UN_FINISH) {
                $students->has('subjects', '<', $subject_count);
            } elseif ($request['student' === Person::FINISH_UN]) {
                $students->all();
            }
        }

        if (!empty($request['min']) || !empty($request['max'])) {
            $students->whereHas('subjects', function ($query) use ($request) {
                if (!empty($request['min'])) {
                    $query->where('point', '>=', $request['min']);
                }
                if (!empty($request['max'])) {
                    $query->where('point', '<=', $request['max']);
                }
            });

        }

        //phones
        if (!empty($request['phones'])) {
            foreach ($request['phones'] as $phone) {
                $students->orWhere('phone', 'regexp', $phone);

            }
        }

        if (!empty($request['search'])) {
            $students->where('name', 'like', '%' . $request['search'] . '%');
        }
        return $students->orderBy('id', 'desc')->paginate($paginate);
    }

    public function getPoint()
    {
        $persons = Person::all();
        foreach ($persons as $person) {
            if (!empty(count($person->subjects) == 10)) {
                foreach ($person->subjects as $result) {
                    $points[] = $result->pivot->point;
                }
                $avg = array_sum($points) / count($points);
                $person->avg = $avg;
            }
        }
        foreach ($persons as $person) {
            if (!empty($person->avg < 5 && $person->avg > 0)) {
                $student[] = $person;
            }
        }
        return $student;
    }
}

?>
