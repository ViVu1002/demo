<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestUser;
use App\Person;
use App\Repositories\User\UserRepositoryInterface;
use \App\Repositories\Person\PersonRepositoryInterface;
use App\User;
use http\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        PersonRepositoryInterface $personRepository)
    {
        $this->userRepository = $userRepository;
        $this->personRepository = $personRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUser $request)
    {
        $data = $request->all();
        $data['image'] = $this->userRepository->uploadImages();
        $data['admin'] ? 1 : 0;
        if ($data['password'] == $data['re-password']) {
            $user = $this->userRepository->create($data);
        } else {
            return redirect()->back()->with('flash_message_error', 'Password not a coincidence re-password');
        }
        Auth::login($user);
        return redirect('/login/user')->with('flash_message_success', 'Register success!');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function createLogin()
    {
        return view('admin.login');
    }

    public function storeLogin(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            if (auth()->user()->admin == 1) {
                return redirect()->route('person.index')->with('success', 'Login success');
            } else {
                $persons = DB::table('persons')->select(['slug', 'email'])->get();
                $user = $persons->whereIn('email', $data['email']);
                if ($user) {
                    foreach ($user as $value) {
                        $slug = $value->slug;
                    }
                    return redirect('/person/' . $slug)->with('info', 'Login success');
                } else {
                    return redirect()->back()->with('error', 'Login error');
                }
            }
        } else {
            return redirect()->back()->with('flash_message_error', 'Login error');
        }

    }

    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $getInfo = User::where('social_id', $user->id)->first();
            if ($getInfo) {
                Auth::login($getInfo);
                $persons = DB::table('persons')->select(['slug', 'email'])->get();
                $user = $persons->whereIn('email', $getInfo['email']);
                if ($user) {
                    foreach ($user as $value) {
                        $slug = $value->slug;
                    }
                }
                return redirect('/person/' . $slug)->with('info', 'Login success');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'social_id' => $user->id,
                    'phone' => 1,
                    'image' => 1,
                    'password' => '',
                    'admin' => 0,
                ]);
                Auth::login($newUser);
                $persons = DB::table('persons')->select(['slug', 'email'])->get();
                $user = $persons->whereIn('email', $newUser['email']);
                if ($user) {
                    foreach ($user as $value) {
                        $slug = $value->slug;
                    }
                }
                return redirect('/person/' . $slug)->with('info', 'Login success');
            }
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login/user')->with('success', 'Logout success!');
    }
}
