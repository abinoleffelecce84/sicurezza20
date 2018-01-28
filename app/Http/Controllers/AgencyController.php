<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Agency;
use App\Implementation;
use App\Comment;
use App\Notification;
use Auth;

class AgencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agencies = Agency::all();
        $notifications = Notification::all();
//$count => Utente A inserisce commento -> Inserito nickname di ogni utente meno creatore commento = 1 notifica per gli utenti
        $count = Notification::where('nickname','=',Auth::user()->nick)->count();
        return view('agency.agencies',compact('agencies','notifications','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('agency.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $agency = new Agency;
        $agency->name = $request->get('name');
        $agency->phone = $request->get('phone');
        $agency->address = $request->get('address');
        $agency->save();
        for($a=1;$a<=121;$a++){
            $impl = new Implementation;
            $impl->implementation = NULL;
            $impl->work_at = $agency['id'];
            $impl->id_ref = $a;
            $impl->save();
        }
        return redirect('/gestionente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $agency = Agency::find($id);
        return view('agency.delete',compact('agency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agency = Agency::find($id);
        return view('agency.edit',compact('agency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $agency = Agency::find($id);
        $agency->name = $request->get('name');
        $agency->phone = $request->get('phone');
        $agency->address = $request->get('address');
        $agency->save();
        return redirect('/gestionente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $agency = Agency::find($id);
        $agency->delete();
        for($a=1;$a<=121;$a++){
            $impl = Implementation::where([
                            ['id_ref','=',$a],
                            ['work_at','=',$id],
                            ]);
            $impl->delete();
        }
        return redirect('/gestionente');
    }
}
