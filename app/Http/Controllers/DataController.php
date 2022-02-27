<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Data;
use App\Models\Status;
use Inertia\Inertia;


class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $statuses = Status::with('datas')
        //                     ->where( 'user_id' , Auth::user()->id)
        //                     ->get();

        // return Inertia::render ('Main' , [
        //     'statuses' => $statuses
           
        // ]) ;

        $datas = auth() -> user() -> statuses() 
                -> with('datas') 
                ->get();

        return Inertia::render ('Main' , [
            'datas' => $datas
        ]);
    }

    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        $request -> validate ([
            'title' => [ 'required' ,'max:90'],
            'description' => 'required',
            'status_id' => 'required',
          
        ]);

     
        $order = 0 ;
        $user = Auth::user()->id ;

        $data = Data::create([
            'title' => $request -> title ,
            'description' => $request -> description,
            'order' => $order,
            'user_id' => $user,
            'status_id' => $request -> status_id,
        ]);

        return redirect()->back();

    }

    
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        
    }

    public function sync( Request $request)
    {
       $request -> validate([
           'columns' => ['required', 'array']
       ]);

       foreach ( $request-> columns as $status) {
           foreach ($status['datas'] as $i => $data) {
               $order = $i + 1;

               if($data['status_id'] !== $status['id'] || $data['order'] !== $order ) {
                   request() -> user() -> datas()
                        ->find($data['id'])
                        ->update(['status_id' => $status['id'], 'order' => $order]);
               }
           }
       }

       return redirect()->back();
    }

    
    public function update(Request $request, $id)
    {
        $request-> validate ([
            'title' => 'nullable',
            'description' => 'nullable', 
        ]);

        $data = Data::find($id);
        $data -> update( $request -> only ('title', 'description'));

        return redirect()->back();
    }

   
    
    public function destroy($id)
    {
        $data = Data::find($id);
        $data -> delete();

        return redirect()->back();
    }
}
