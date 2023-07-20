<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\SeatingPlan;
use Illuminate\Http\Request;

class SeatingPlanController extends Controller
{
    public function create(Bus $bus)
    {
        return view('seating_plans.create', compact('bus'));
    }

    public function show(SeatingPlan $seatingPlan)
    {
        return view('seating_plans.show', compact('seatingPlan'));
    }

    public function store(Request $request, Bus $bus)
    {
        $validatedData = $request->validate([
            'row' => 'required|integer',
            'column' => 'required|integer',
        ]);

        $seatingPlan = new SeatingPlan($validatedData);
        $bus->seatingPlan()->save($seatingPlan);

        return redirect()->route('buses.index')->with('success', 'Seating plan created successfully.');
    }

    public function edit(SeatingPlan $seatingPlan)
    {
        return view('seating_plans.edit', compact('seatingPlan'));
    }

    public function update(Request $request, SeatingPlan $seatingPlan)
    {
        $validatedData = $request->validate([
            'row' => 'required|integer',
            'column' => 'required|integer',
        ]);

        if ($request->row < $seatingPlan->row) {
            return redirect()->back()->with('error', 'Seating Plan row must be greather than ' . $seatingPlan->row .'.');
        }

        if ($request->column < $seatingPlan->column) {
            return redirect()->back()->with('error', 'Seating Plan column must be greather than ' . $seatingPlan->column .'.');
        }

        $seatingPlan->update($validatedData);
        
        return redirect()->route('buses.index')->with('success', 'Seating plan updated successfully.');
    }
}
