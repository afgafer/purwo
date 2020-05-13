<?php

namespace App\Http\Controllers;

use App\models\Dest;
use Illuminate\Http\Request;
use File;

class DestApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(auth()->user());
        //$dest_id=auth()->user();
        $dests=Dest::get();
        return $dests;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dest=new Dest();
        $dest->name=$request->name;
        $file=$request->file;
        if($file){
            $nameF = 'dest_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $dest->file=$nameF;
        }
        $dest->contact=$request->contact;
        $dest->address=$request->address;
        $dest->lat=$request->lat;
        $dest->lng=$request->lng;
        $dest->desc=$request->desc;
        $dest->save();
        $msg="The dest ".$dest->name." has been saved";

        return redirect()->route('dest.index')->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Dest  $dest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dest=Dest::findOrFail($id);
        return $dest;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Dest  $dest
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dest=Dest::findOrFail($id);
        return view('dest.edit',compact('dest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Dest  $dest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dest=Dest::findOrFail($id);
        $dest->name=$request->name;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$dest->file;
            File::delete($oldF);
            $nameF = 'dest_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $dest->file=$nameF;
        }
        $dest->contact=$request->contact;
        $dest->address=$request->address;
        $dest->lat=$request->lat;
        $dest->lng=$request->lng;
        $dest->desc=$request->desc;
        $dest->save();
        $msg="The dest ".$dest->name." has been saved";

        return redirect()->route('dest.index')->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Dest  $dest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dest=Dest::findOrFail($id);
        $oldF='upload/img/'.$dest->file;
        File::delete($oldF);
        Dest::destroy($id);
        $msg="The dest ".$dest->name." has been deleted";
        return redirect()->route('dest.index')->with('message',$msg);
    }

    public function indexA()
    {
        $dests=Dest::orderBy('name','ASC')->get();
        return view('auth.dest.index',compact('dests'));
    }

    
}
