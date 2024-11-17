<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Fetch all to-do items
    public function index()
    {
        return Todo::all();  // Return all to-do items
    }

    // Create a new to-do item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
    
        try {
            $todo = Todo::create([
                'name' => $request->name,
            ]);
    
            return response()->json($todo, 201);  // Return created to-do
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    

    // Update a to-do item
    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $todo->name = $request->name;
        $todo->save();

        return response()->json($todo);
    }

    // Delete a to-do item
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json(null, 204);  // Return 204 for successful deletion
    }
}
