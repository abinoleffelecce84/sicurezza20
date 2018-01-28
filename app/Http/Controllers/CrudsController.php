<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Description;
use App\Implementation;
use App\Agency;
use App\Comment;
use App\Notification;
use App\Utility;
use DB;
use Auth;

class CrudsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexs($id)
    {
        $agency = Agency::find($id);
        $users = User::all();
        $descs = Description::all();
        $impls = Implementation::all();
        $impl = Implementation::first();
        $notifications = Notification::all();
        $count = Notification::where('nickname','=',Auth::user()->nick)->count();
        $agencies = Agency::all();
        return view('cruds.index',compact('agency','users','descs','impls','impl','notifications','count','agencies'));
    }

/*
    public function getQuery($agency,$lev,$id)
    {
        $agency = Agency::find($agency);
        $descs = Description::where([
                ['id_1','=',$id],
                ['level','=',$lev],
            ])->first();
        $impls = Implementation::where([
                ['work_at','=',$agency],
                ['id_ref','=',$id],
            ])->first();
        $notifications = Notification::all();
        $count = Notification::where('nickname','=',Auth::user()->nick)->count();
        $agencies = Agency::all();
        return view('cruds.index_queried',compact('descs','impls','notifications','count','agencies','agency'));
    }
 
    public function getLev($agency,$lev)
    {
        $agency = Agency::find($agency);
        $descs = Description::where('level','=',$lev)->get();
        foreach($descs as $desc){
            $id = DB::table('descriptions')->select('id')
                                           ->where('level','=',$lev)->first();
            $impls = Implementation::where([
                    ['work_at','=',$agency],
                    ['id_ref','=',$id],
                ])->first();
        }
        $notifications = Notification::all();
        $count = Notification::where('nickname','=',Auth::user()->nick)->count();
        $agencies = Agency::all();
        return view('cruds.index_queried',compact('descs','impls','notifications','count','agencies','agency'));
    }
*/
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change($agency,$desc)
    {
        $agency = Agency::find($agency);
        $desc = Description::find($desc);
        $impl = Implementation::where([
                                ['id_ref','=',$desc->id],
                                ['work_at','=',$agency->id],
                                ])->first();
        return view('cruds.edit',compact('agency','desc','impl'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updates(Request $request,$id,$desc)
    {
        $agency = Agency::find($id);
        $desc = Description::find($desc);
        $desc->description = $request->get('description');
        $impl = Implementation::where([
                                ['id_ref','=',$desc->id],
                                ['work_at','=',$agency->id],
                                ])->first();
        $desc->level = $request->get('level');
        $impl->implementation = $request->get('implementation');
        $desc->save();
        $impl->save();
        return redirect('cruds/'.$id.'/index');
    }

    public function forum($agency,$desc)
    {
        $agency = Agency::find($agency);
        $desc = Description::find($desc);
        $descs = Description::where('id','=',$desc->id)->get();
        $impls = Implementation::where([
                                ['id_ref','=',$desc->id],
                                ['work_at','=',$agency->id],
                                ])->get();
        $comms = Comment::where([
                          ['id_ref','=',$desc->id],
                          ['work_at','=',$agency->id],
                          ])->get();
        $notifications = Notification::all();
        $users = User::all();
        foreach($notifications as $notification){
            foreach($users as $user){
                if(($notification->nickname == Auth::user()->nick)&&($notification->work_at == $agency->id)&&($notification->id_ref == $desc->id)){
                    $name = Notification::where([
                                            ['nickname','=',Auth::user()->nick],
                                            ['work_at','=',$agency->id],
                                            ['id_ref','=',$desc->id],
                                            ]);
                    $name->delete();  
                }
            }
        }
        $count = Notification::where('nickname','=',Auth::user()->nick)->count();
        $descriptions = Description::all();
        $agencies = Agency::all();
        return view('cruds.forum',compact('agency','descs','impls','comms','count','descriptions','notifications','agencies'));
    }

    public function addComment(Request $request,$id_Agency,$desc,$user)
    {
        $comment = new Comment;
        $agency = Agency::find($id_Agency);
        $desc = Description::find($desc);
        $user = User::find($user);
        $comment->user = $user->nick;
        $comment->agency = NULL;
        $comment->work_at = $agency->id;
        $comment->id_ref = $desc->id;
        $comment->comment = $request->get('comment');
        $comment->save();
        $agencies = Agency::all();
        foreach($agencies as $idAgency){
            if($user->work_at == $idAgency->id){
                $comment->agency = $idAgency->name;
            }
        }
        $comment->save();
        $users = User::all();
        foreach($users as $userz){
            $notification = new Notification;
            $notification->nickname = $userz->nick;
            $notification->id_ref = $desc->id;
            $notification->work_at = $agency->id;
            $notification->save();
        }
        return back();
    }

    public function utilities()
    {
        $utilities = Utility::all();
        $notifications = Notification::all();
        $count = Notification::where('nickname','=',Auth::user()->nick)->count();
        return view('utility.utilities',compact('utilities','notifications','count'));
    }

    public function createUtility(){
        return view('utility.add');
    }

    public function addUtility(Request $request)
    {
        $utility = New Utility;
        $utility->name = $request->get('name');
        $utility->address = $request->get('address');
        $utility->nickname = Auth::user()->nick;
        $utility->save();
        return redirect('cruds/utilities');
    }

    public function changeUtility($id)
    {   
        $utility = Utility::find($id);
        return view('utility/edit',compact('utility'));
    }

    public function editUtility(Request $request, $id)
    {
        $utility = Utility::find($id);
        $utility->name = $request->get('name');
        $utility->address = $request->get('address');
        $utility->save();
        return redirect('cruds/utilities');
    }

    public function deleteUtility($id)
    {
        $utility = Utility::find($id);
        $utility->delete();
        return redirect('cruds/utilities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back();
    }
}
