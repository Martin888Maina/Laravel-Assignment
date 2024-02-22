<?php

namespace App\Http\Controllers;

use App\Models\organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //display all
        $organizations = Organization::all();
        //dd($contacts);
        //var_dump($contacts);
        return view('organization.index', ['organizations' => $organizations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //create crud
        return view('organizations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //validate the request
        $request->validate([
            'name' => 'required',
            'industry' => 'required',
            'size' => 'required',
        ]);
        //store the request
        Organization::create($request->all());
        //use the new contact to create a new organization
        $organization = new Organization();
        $organization->name = $request->name;
        $organization->industry = $request->industry;
        $organization->size = $request->size;
        $organization->save();
        //redirect to the index page
        return redirect()->route('organization.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(organization $organization)
    {
        // //show the contact
        $organization = Organization::find($organization);
        //use find or fail
        $organization = Organization::findOrFail($organization);
        //the difference between find and find or fail is that find or 
        //fail will throw an error if the contact is not found
        return view('organization.show', ['organization' => $organization]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(organization $organization)
    {
        //
         //edit one contact
         $organization = Organization::find($organization);
         return view('organization.edit', ['organization' => $organization]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, organization $organization)
    {
        //
        //update contact using the request by first validating the request
        $request->validate([
            'name' => 'required',
            'industry' => 'required',
            'size' => 'required',
        ]);
        //store the request
        $organization->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(organization $organization)
    {
        //
         //delete the contact
         $organization->delete();
    }
}
