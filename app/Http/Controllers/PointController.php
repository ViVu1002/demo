<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Http\Requests\RequestPoint;
use App\Person;
use App\Point;
use App\Repositories\Point\PointRepositoryInterface;
use App\Subject;
use Illuminate\Http\Request;

class PointController extends Controller
{
    protected $pointRepository;

    public function __construct(PointRepositoryInterface $pointRepository)
    {
        $this->pointRepository = $pointRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = Point::orderBy('id','desc')->paginate(10);
        return view('admin.points.index', compact('points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faculties = Faculty::all();
        $subjects = Subject::all();
        $persons = Person::all();
        return view('admin.points.create', compact('subjects', 'persons', 'faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $point = $this->pointRepository->create($data);
        return redirect()->route('point.index', compact('point'))->with('success', 'Create point success!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $point = $this->pointRepository->getListById($id);
        return view('admin.points.show', compact('point'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $point = $this->pointRepository->getListById($id)->load('person')->load('subject');
       // dd($point);
        return view('admin.points.update', compact('point', 'persons', 'subjects', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $point = $this->pointRepository->update($id, $data);
        return redirect()->route('point.index', compact('point'))->with('success', 'Update point success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $point = $this->pointRepository->delete($id);
        return redirect()->route('point.index', compact('point'))->with('success', 'Delete point success!');
    }
}
