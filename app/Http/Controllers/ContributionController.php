<?php

namespace App\Http\Controllers;

use App\Models\Contribution;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContributionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * List all contributions (authenticated users).
     */
    public function index()
    {
        $contributions = Contribution::orderByDesc('created_at')->get();
        return view('contributions.index', compact('contributions'));
    }

    /**
     * (no standalone page) Show form to create a new contribution.
     * We use a modal on the index page instead, so authorize then abort.
     */
    public function create()
    {
        $this->authorizeTreasurer();
        abort(404);
    }

    /**
     * Store a new contribution record.
     */
    public function store(Request $request)
    {
        $this->authorizeTreasurer();

        $data = $request->validate([
            'contributor_name' => 'required|string|max:255',
            'amount' => 'required|integer|min:0',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['added_by'] = $request->user()->id;
        Contribution::create($data);

        return redirect()->route('contributions.index')
            ->with('success', 'Contribution recorded.');
    }

    /**
     * (no standalone page) Display a single contribution.
     * Details are shown in a modal on the index page.
     */
    public function show(Contribution $contribution)
    {
        abort(404);
    }

    /**
     * (no standalone page) Show edit form for a contribution.
     * Editing is handled with a modal on the index page.
     */
    public function edit(Contribution $contribution)
    {
        $this->authorizeTreasurer();
        abort(404);
    }

    /**
     * Update an existing contribution.
     */
    public function update(Request $request, Contribution $contribution)
    {
        $this->authorizeTreasurer();

        $data = $request->validate([
            'contributor_name' => 'required|string|max:255',
            'amount' => 'required|integer|min:0',
            'payment_method' => 'required|string|max:255',
            'payment_status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $contribution->update($data);
        return redirect()->route('contributions.index')
            ->with('success', 'Contribution updated.');
    }

    /**
     * Delete a contribution (treasurer only).
     */
    public function destroy(Contribution $contribution)
    {
        $this->authorizeTreasurer();
        $contribution->delete();
        return redirect()->route('contributions.index')
            ->with('success', 'Contribution removed.');
    }

    /**
     * Helper to ensure the current user is treasurer.
     */
    protected function authorizeTreasurer()
    {
        if (auth()->user()->role !== 'treasurer') {
            abort(403, 'Only the treasurer may perform that action.');
        }
    }
}
