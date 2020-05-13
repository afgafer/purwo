<?php

namespace App\Http\Controllers;

use App\User;
use App\models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dests= \App\models\Dest::orderBy('name','ASC')->get();
        $hotels= \App\models\Hotel::orderBy('name','ASC')->get();
        $admins=Admin::orderBy('dest_id','ASC')->get();
        return view('admin.index',compact('admins','dests','hotels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dests= \App\models\Dest::orderBy('name','ASC')->get();
        $hotels= \App\models\Hotel::orderBy('name','ASC')->get();
        return view('admin.create',compact('dests','hotels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact' => ['required', 'string', 'size:12'], //hmm
            'hotel_id' => ['required'],
            'dest_id' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $user=new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->contact=$request->contact;
        $user->password=Hash::make($request->password);
        $user->type='1';
        $user->save();

        $user=User::where('email',$request->email)->first();
        $admin=new Admin();
        $admin->name=$request->name;
        $admin->email=$request->email;
        $admin->hotel_id=$request->hotel_id;
        $admin->dest_id=$request->dest_id;
        $admin->user_id=$user->id;
        $admin->save();
        $msg="The admin ".$admin->name." has been stored";

        return redirect()->route('admin.index')
                ->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin=Admin::findOrFail();
        return view('admin.show',compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dests= \App\models\Dest::orderBy('name','ASC')->get();
        $hotels= \App\models\Hotel::orderBy('name','ASC')->get();
        $user=User::where('email',$id)->first();
        return view('admin.edit',compact('dests','hotels','user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'contact' => ['required', 'string', 'size:12'], //hmm
            'hotel_id' => ['required'],
            'dest_id' => ['required'],
        ]);
        $user=User::where('email',$id)->first();
        $user->name=$request->name;
        $file=$request->file;
        if($file){
            $oldF='upload/img/'.$user->file;
            File::delete($oldF);
            $nameF = 'user_'.time().'.'.$file->getClientOriginalExtension();    
            $file->move('upload/img',$nameF);
            $user->file=$nameF;
        }
        $user->contact=$request->contact;
        $user->type='1';
        $user->save();

        $admin=Admin::where('email',$id)->first();
        $admin->name=$request->name;
        $admin->hotel_id=$request->hotel_id;
        $admin->dest_id=$request->dest_id;
        $admin->save();
        $msg="The admin ".$admin->name." has been saved";

        return redirect()->route('admin.index')
                ->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::destroy($id);
        $user=User::destroy($id);
    }
}
