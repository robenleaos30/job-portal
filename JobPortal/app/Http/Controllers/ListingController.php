<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // Show All Listing
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // Show Single Listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // Show Create Form
    public function create()
    {
        return view('listings.create');
    }

    // Store Listing Form
    public function store(Request $request)
    {
        $formField = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formField['user_id'] = auth()->id();

        Listing::create($formField);

        return redirect('/')->with('message', 'Listing added sucessfully!!!');
    }

    // Show Edit Form
    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    // Update Listing
    public function update(Request $request, Listing $listing)
    {
        // Make sure of your listing
        if ($listing['user_id'] != auth()->id()) {
            abort(403, 'Anthrorize Access!!');
        }

        $formField = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('logo')) {
            $formField['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->update($formField);

        return back()->with('message', 'Listing updated sucessfully!!!');
    }

    // Delete Listing
    public function destroy(Listing $listing)
    {
        // Make sure of your listing
        if ($listing['user_id'] != auth()->id()) {
            abort(403, 'Anthrorize Access!!');
        }

        $listing->delete();
        return redirect('/')->with('message', 'Listing deleted sucessfully!!!');
    }

    // Manage Listing
    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings]);
    }
}
