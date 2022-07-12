<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = Position::select('id', 'name', 'alias', 'organization_id')
                                        ->with(['organization:id,name,alias'])
                                        ->paginate();

        // return $position;
        return response()->json($positions, 200);
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
        $request->validate([
            'name' => 'required|min:5|max:50',
            'alias' => 'nullable|min:1|max:20',
            'organization_id' => 'required',
        ]);

        $position = Position::create([
            'name' => $request->name,
            'alias' => $request->alias,
            'organization_id' => $request->organization_id,
            'is_operator' => $request->is_operator,
        ]);

        return response()->json($position->load('organization:id,name,alias'), 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        
        return response()->json($position->load('organization:id,name,alias'), 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit(Position $position)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $request->validate([
            'name' => 'required|min:5|max:50',
            'alias' => 'nullable|min:1|max:20',
            'organization_id' => 'required',
        ]);

        $position->update([
            'name' => $request->name,
            'alias' => $request->alias,
            'organization_id' => $request->organization_id,
        ]);

        return response()->json($position, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy(Position $position)
    {
        $position->delete();
        return response()->json('Data Telah Dihapus', 200);
    }
}
