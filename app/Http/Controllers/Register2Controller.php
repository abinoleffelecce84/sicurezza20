<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\Agency;
use App\Notification;
use App\Description;
use Auth;
use DB;

class Register2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $agencies = Agency::all()->toArray();
        $notifications = Notification::all()->toArray();
        $count = Notification::where('nickname','=',Auth::user()->nick)->count();
        $descriptions = Description::all()->toArray();
        return view('index',compact('agencies','notifications','descriptions','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function check(Request $request, $id)
    {
        $agencies = Agency::all()->toArray();
        $user = User::find($id);
        $user->nick = $request->get('nick');
        $count = User::where('nick','=',$user->nick)->count();
        if($count>0){
            $count = 0;
            return view('home',compact('agencies','count'));
        }
        else{
            $user->checked = 1;
            $user->save();
            return view('home',compact('agencies'));
        }   
    }
/*
    public function showChangePassword()
    {
        $count = -1;
        $countEmail = -1;
        $id = -1;
        return view('auth.show',compact('count','id','countEmail'));
    }

    public function checkNick(Request $request)
    {
        $user = $request->get('nick');
        $count = User::where('nick','=',$user)->count();
        $users = User::all();
        foreach($users as $userNick){
            if($userNick->nick == $user){
                $id = $userNick->id;
                $countEmail = -1;
            }
        }
        if($count>0){
            return view('auth.show',compact('count','user','id','countEmail'));
        } else{
            $count = 0;
            return view('auth.show',compact('count','id'));
        }
    }

    public function checkEmail(Request $request, $id)
    {
        $email = $request->get('email');
        $count = User::where('email','=',$email)->count();
        $user = User::find($id);
        $countEmail = 0;
        if($user->email == $email)
            $countEmail=1;
        if($countEmail>0){
            return view('auth.show',compact('count','email','countEmail','id','user'));
        } else {
            return view('auth.show',compact('count','email','countEmail','id','user'));
        }
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = NULL;
        return ''.$user->password;
    }
*/
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->phone = $request->get('phone');
        $user->work_at = $request->get('work_at');
        $user->save();
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
