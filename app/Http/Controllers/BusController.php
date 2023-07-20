<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Destination;
use Illuminate\Http\Request;

class BusController extends Controller
{
    public function index()
    {
        $buses = Bus::all();
        return view('buses.index', compact('buses'));
    }

    public function create()
    {
        $destinations = Destination::where('is_available', true)->get();
        return view('buses.create', compact('destinations'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'model' => 'required',
            'seating_capacity' => 'required|integer',
            'from' => 'required',
            'to' => 'required',
        ]);

        Bus::create($validatedData);

        return redirect()->route('buses.index')->with('success', 'Bus created successfully.');
    }

    public function edit(Bus $bus)
    {
        $destinations = Destination::where('is_available', true)->get();
        return view('buses.edit', compact('bus', 'destinations'));
    }

    public function update(Request $request, Bus $bus)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'model' => 'required',
            'seating_capacity' => 'required|integer',
            'from' => 'required',
            'to' => 'required',
        ]);

        $bus->update($validatedData);

        return redirect()->route('buses.index')->with('success', 'Bus updated successfully.');
    }

    public function destroy(Bus $bus)
    {
        $bus->delete();
        
        return redirect()->route('buses.index')->with('success', 'Bus deleted successfully.');
    }
}
