<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->page);
        $organizations = Organization::select('id', 'name', 'alias');
        $organizations = $organizations->with(['positions:id,organization_id,name,alias']);
        if ($request->has('search')) {
            $organizations = $organizations->search($request->search);
        }
        $organizations = $organizations->paginate();

        // return $organization;
        return response()->json($organizations, 200);
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
        // $request->validate([
        //     'name' => 'required',
        // ]);

        // dd($request->all);

        $this->validate($request, [
            'name' => 'required|min:4|max:50',
        ]);

        // dd('aaaa');

        $organization = Organization::create([
            'name' => $request->name,
            'alias' => $request->alias,
        ]);

        return response()->json($organization, 200, );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        return response()->json($organization, 200, );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        // dd($request->all);
        $request->validate([
            'name' => 'required|min:4|max:50',
            'alias' => 'nullable|min:3|max:20',
        ]);


        $organization->update([
            'name' => $request->name,
            'alias' => $request->alias,
        ]);

        return response()->json($organization, 200, );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        // $organization->delete();
        if (Organization::find($organization->id) !== null) {
            $organization->delete();
            return response()->json('Data Telah Dihapus', 200, );
        }
        
        return response()->json('Data Tidak Ditemukan', 200, );
    }
}
