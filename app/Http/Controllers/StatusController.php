<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Data;
use App\Models\Status;
use Inertia\Inertia;


class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statuses = Status::all()
                    ->where('user_id', Auth::user()->id);
                    
        return Inertia::render ('Statuses' , [
            'statuses' => $statuses ,
        ]);
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
        $request -> validate ([
            'title' =>  ['required' ,'max:90'],
            'slug' => 'required',

        ]);

        $order = 1;
        $user_id = Auth::user() -> id;

        $status = Status::create([
            'title' => $request -> title,
            'slug' => $request -> slug,
            'order' => $order,
            'user_id'=> $user_id,
        ]);

        return redirect()->back();
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

   
    public function update(Request $request, $id)
    {
        $request -> validate ([
            'title' => 'nullable',
            'slug' => 'nullable',
        ]);

        $status = Status::find($id);
        $status -> update($request -> only('title' , 'slug'));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Status::find($id);
        $status -> delete();
        return redirect()->back();
    }
}
