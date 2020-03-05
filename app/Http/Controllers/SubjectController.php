<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestSubject;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $subjectRepository;

    public function __construct(SubjectRepositoryInterface $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('id','desc')->paginate(10);
        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestSubject $request)
    {
        $data = $request->all();
        $subject = $this->subjectRepository->create($data);
        return redirect()->route('subject.index', compact('subject'))->with('success', 'Create subject success!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subject = $this->subjectRepository->getListById($id);
        return view('admin.subjects.show', compact('subject'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subject = $this->subjectRepository->getListById($id);
        return view('admin.subjects.update', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestSubject $request, $id)
    {
        $data = $request->all();
        $subject = $this->subjectRepository->update($id, $data);
        return redirect()->route('subject.index', compact('subject'))->with('success', 'Update subject success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = $this->subjectRepository->delete($id);
        return redirect()->route('subject.index', compact('subject'))->with('success', 'Delete subject success!');
    }
}
