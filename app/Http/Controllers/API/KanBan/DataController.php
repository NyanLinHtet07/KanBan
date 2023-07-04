<?php

namespace App\Http\Controllers\API\KanBan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Data;

class DataController extends Controller
{

    public function index()
    {
        $datas = Data::orderBy('order')
                        ->get();
                        
        return response()->json($datas);
    }

    
    public function store(Request $request)
    {
        $request -> validate ([
            'title' => ['required', 'max:90'],
            'description' => 'required',
            'status_id' => 'required',
            'start' => 'nullable',
            'end' => 'nullable'
        ]);

        $order = Data::where('description', $request->description)
                        ->max('order') + 1;
        $user = Auth::user() -> id;
        
        $data = Data::create([
            'title' => $request -> title,
            'description' => $request -> description,
            'order' => $order,
            'user_id' => $user,
            'status_id' => $request -> status_id,
            'start' => $request -> start,
            'end' => $request -> end
        ]);

        return response()->json($data);
    }

   
    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
