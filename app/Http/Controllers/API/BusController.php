<?php

namespace App\Http\Controllers\API;

use App\Models\Bus;
use App\Http\Controllers\Controller;

class BusController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
         return response()->json(Bus::with('price', 'fromDestination', 'toDestination')->get());
    }
    public function show(Bus $bus): \Illuminate\Http\JsonResponse
    {
         return response()->json($bus->load('price', 'fromDestination', 'toDestination', 'seatingPlan', 'seatingPlan.seats'));
    }
}