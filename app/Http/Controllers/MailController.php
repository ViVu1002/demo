<?php

namespace App\Http\Controllers;

use App\Repositories\Person\PersonRepositoryInterface;
use Illuminate\Http\Request;
use App\Jobs\SendPostEmail;
use App\Mail\TestMail;
use Carbon\Carbon;
class MailController extends Controller
{
    public function __construct(PersonRepositoryInterface $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function test()
    {
        $users = $this->personRepository->getPoint();
       foreach ($users as $user){
           $job = (new SendPostEmail($user))->delay(Carbon::now()->addSeconds(5));
           dispatch($job);
       }
       return redirect()->back()->with('success','Send success');
    }
}
