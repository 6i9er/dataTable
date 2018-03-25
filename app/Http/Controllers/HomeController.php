<?php

namespace App\Http\Controllers;

use App\Mail\ThanksSubscribeMail;
use App\User;
use Illuminate\Http\Request;
use App\Mail\TestEmail;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
            'name' => 'mina amir',
            'email' => 'eng.mina23@gmail.com',
            'subject' => 'Subscribtion Complete'
            ];

        $email = new ThanksSubscribeMail($data);
        $email->setData($data) ;
        Mail::to($data['email'])->send($email);

        return "email Has Send Success";
    }

    public function listUsers(Request $request ){

        $users = User::paginate(1);
        if($request->Ajax()){
            $orderType = (in_array($request->orderByTypeParam , ['id' , 'name' , 'email'] ))? $request->orderByTypeParam : 'id' ;
            $arrangeType = (in_array($request->arrangeTypeParam , ["ASC" , "DESC"])) ? $request->arrangeTypeParam : "ASC" ;
            $users = User::orderBy($orderType , $arrangeType)->paginate(1);
            $userTemplate = '';
            if(count($users) > 0){
                foreach($users as $user){
                    $userTemplate .= view('home.userTableRow_tmpl' )->with('user' , $user)->render();
                }
                return response()->json(['error' => 0 , 'data' => $userTemplate], 200);
            }else{
                return response()->json(['error' => 1 , 'data' => ''], 200);
            }
        }else{
            return view('home.index')->with('users' , $users);
        }
    }
}
