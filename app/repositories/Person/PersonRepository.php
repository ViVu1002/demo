<?php
namespace App\Repositories\Person;

use App\Point;
use GuzzleHttp\Psr7\Request;
use Illuminate\Database\Eloquent\Model;
use App\Person;
use App\Repositories\BaseRepository;
use App\Subject;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

    public function search($request = [],$subject_count = 0, $paginate = 50)
    {
        $students = $this->model->newQuery();
        if (!empty($request['pagination'])) {
            if ($request['pagination'] == Person::FINISH) {
                $paginate = 100;
                return $students->orderBy('updated_at', 'desc')->paginate($paginate);
            }
            if ($request['pagination'] == Person::UN_FINISH) {
                $paginate = 1000;
                return $students->orderBy('updated_at', 'desc')->paginate($paginate);
            }
            if ($request['pagination'] == Person::FINISH_3) {
                $paginate = 3000;
                return $students->orderBy('updated_at', 'desc')->paginate($paginate);
            }
        }
        if (!empty($request['min_age']) || !empty($request['max_age'])){
            if (!empty($request['min_age'])) {
                $min = Carbon::now()->subYear($request['min_age'])->startOfYear()->format('Y-m-d');
                $students->whereDate('date', '<=', $min);
            }
            if ($request['max_age'] !== null && $request['max_age'] >=0) {
                $max = Carbon::now()->subYear($request['max_age'])->startOfYear()->format('Y-m-d');
                $students->whereDate('date', '>=', $max);
            }
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
                if (!empty($request['max']) >0) {
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
        //search name
        if (!empty($request['search'])) {
            $students->where('name', 'like', '%' . $request['search'] . '%');
        }

        return $students->orderBy('updated_at', 'desc')->paginate($paginate);
    }

    public function getPoint()
    {
        $persons = Person::whereHas('subjects', function ($query) {
            $query->where('subject_id', '=', 10);
        })->get();
        foreach ($persons as $person) {
            foreach ($person->subjects as $result) {
                $points[] = $result->pivot->point;
            }
            $avg = array_sum($points) / count($points);
            $person->avg = $avg;
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
