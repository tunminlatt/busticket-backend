<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Price;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    public function create(Bus $bus)
    {
        return view('prices.create', compact('bus'));
    }

    public function store(Request $request, Bus $bus)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $price = new Price($validatedData);
        $bus->price()->save($price);
        
        return redirect()->route('buses.index')->with('success', 'Price created successfully.');
    }

    public function edit(Price $price)
    {
        return view('prices.edit', compact('price'));
    }

    public function update(Request $request, Price $price)
    {
        $validatedData = $request->validate([
            'amount' => 'required|numeric',
        ]);

        $price->update($validatedData);

        return redirect()->route('buses.index')->with('success', 'Price updated successfully.');
    }
}
