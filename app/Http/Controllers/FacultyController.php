<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Http\Requests\RequestFaculty;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use Illuminate\Http\Request;
use Redirect;
class FacultyController extends Controller
{
    protected $facultyRepository;

    public function __construct(FacultyRepositoryInterface $facultyRepository)
    {
        $this->facultyRepository = $facultyRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::orderBy('id','desc')->paginate(10);
        return view('admin.faculties.index', compact('faculties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestFaculty $request)
    {
        $locale = \App::getLocale();
        $data = $request->all();
        $this->facultyRepository->create($data);
        return Redirect::to($locale.'/faculty')->with('success', 'Create faculty success!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = $this->facultyRepository->getListById($id);
        return view('admin.faculties.show', compact('faculty'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty = $this->facultyRepository->getListById($id);
        return view('admin.faculties.update', compact('faculty'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestFaculty $request, $id)
    {
        $data = $request->all();
        $faculty = $this->facultyRepository->update($id, $data);

        return redirect()->route('faculty.index', compact('faculty'))->with('success', 'Update faculty success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty = $this->facultyRepository->delete($id);
        return redirect()->route('faculty.index', compact('faculty'))->with('success', 'Delete faculty success!');
    }
}
