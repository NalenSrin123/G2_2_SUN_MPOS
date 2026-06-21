<?php

namespace App\Http\Controllers;

use App\Models\TableName;
use Illuminate\Http\Request;

class TableController extends Controller
{
    // GET /api/tables
    public function index()
    {
        $tables = TableName::all();

        return response()->json([
            'status' => 200,
            'message' => 'Tables retrieved successfully',
            'data' => $tables
        ]);
    }

    // GET /api/tables/{id}
    public function show($id)
    {
        $table = TableName::find($id);

        if (!$table) {
            return response()->json([
                'status' => 404,
                'message' => 'Table not found'
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Table retrieved successfully',
            'data' => $table
        ]);
    }

    // POST /api/tables
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:available,unavailable'
        ]);

        $table = TableName::create([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 201,
            'message' => 'Table created successfully',
            'data' => $table
        ], 201);
    }

    // PUT /api/tables/{id}
    public function update(Request $request, $id)
    {
        $table = TableName::find($id);

        if (!$table) {
            return response()->json([
                'status' => 404,
                'message' => 'Table not found'
            ], 404);
        }

        $request->validate([
            'name' => 'required|string|max:100',
            'status' => 'required|in:available,unavailable'
        ]);

        $table->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Table updated successfully',
            'data' => $table
        ]);
    }

    // DELETE /api/tables/{id}
    public function destroy($id)
    {
        $table = TableName::find($id);

        if (!$table) {
            return response()->json([
                'status' => 404,
                'message' => 'Table not found'
            ], 404);
        }

        $table->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Table deleted successfully'
        ]);
    }
}
