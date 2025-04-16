<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the organizations.
     */
    public function index()
    {
        $organizations = Organization::all();

        return view('admin.src.organization.index', compact('organizations'));
    }

    /**
     * Show the form for creating a new organization.
     */
    public function create()
    {

        $organizations = Organization::all();

        return view('admin.src.organization.index', compact('organizations'));
    }

    /**
     * Store a newly created organization in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $data['status'] = 'active';  // Set default status to 'active'

        // Create the organization
        Organization::create($data);

        return redirect()->back()->with('success', 'Organization created successfully.');
    }


    /**
     * Display the specified organization.
     */
    public function show(Organization $organization)
    {
        return view('admin.src.organization.index', compact('organization'));
    }

    /**
     * Show the form for editing the specified organization.
     */
    public function edit(Organization $organization)
    {
        return view('admin.src.organization.index', compact('organization'));
    }

    /**
     * Update the specified organization in storage.
     */
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $organization->update($request->all());

        return redirect()->back()->with('success', 'Organization updated successfully.');
    }

    /**
     * Remove the specified organization from storage.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return redirect()->back()->with('success', 'Organization deleted successfully.');
    }
}
