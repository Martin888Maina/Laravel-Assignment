<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Organization;
use App\Models\Deal;
use Illuminate\Http\Request;

class DealController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        //this code displays all the records
        $deals = Deal::all();
        return view('deals.index',compact('deals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        //this code creates a single record
        // return view('deals.create');
        $org = Organization::all();
        $con = Contact::all();
        return view('deal.create', ['org' => $org]);
        return view('deal.create', ['con' => $con]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) //this remains the same
    {
        $request->validate([
            'value' => 'required',
            'probability' => 'required',
            'expected_close_date' => 'required',
            'notes' => 'required',
            'organization_id' => 'required',
            'contact_id' => 'required',

            // Before we add the foreign key
            
        ]);
       
        // $deal = new Deal();
        // $deal->fill($request->all());
        // $deal->save();

        // return redirect()->route('deals.index')->with('success', 'Deal created successfully');
        //store the request
        Deal::create($request->all());
        //use the new contact to create a new organization
        $deal = new Deal();
        $deal->value = $request->value;
        $deal->probability = $request->probability;
        $deal->expected_close_date = $request->expected_close_date;
        $deal->notes = $request->notes;
        $deal->organization_id = $request->organization_id;
        $deal->contact_id = $request->contact_id;
        $deal->save();
        //redirect to the index page
        return redirect()->route('deal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Deal $deal) //show changes to string $id only remove the Deal $deal
    {
        $deal = Deal::find($deal);
        //use find or fail
        $deal = Contact::findOrFail($deal);
        //the difference between find and find or fail is that find or 
        //fail will throw an error if the contact is not found
    
        return view('deals.show', compact('deal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Deal $deal) //edit changes to string $id only remove the Deal $deal
    {
        $deal = Deal::find($deal);
        return view('deals.edit', compact('deal')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Deal $deal) //update changes to (Request $request, string $id) remove the Deal $deal code 
    {
        
        $request->validate([
            'value' => 'required',
            'probability' => 'required',
            'expected_close_date' => 'required',
            'notes' => 'required',
            'organization_id' => 'required',
            'contact_id' => 'required',
        ]);

        //store the request
        $deal->update($request->all());

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Deal $deal) //delete changes to string $id only remove the Deal $deal
    
    {
        //delete the contact
        $deal->delete();
    }
}
