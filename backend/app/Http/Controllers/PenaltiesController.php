<?php

namespace App\Http\Controllers;

use App\Models\Penalties;
use Illuminate\Http\Request;

class PenaltiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // memastikan user admin berdasarkan username
        if ($request->user()->username != "admin1") {
            return response()->json([
                "message" => "forbidden"
            ], 403);
        };

        $penalties = Penalties::all();

        return response()->json([
            "data" => $penalties
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // memastikan user admin berdasarkan username
        if ($request->user()->username != "admin1") {
            return response()->json([
                "message" => "forbidden"
            ], 403);
        };

        $request->validate([
            "penalties_name" => "required|string",
            "description" => "required|string",
            "no_car" => "required|string",
            "penalties_total" => "required|string",
        ]);

        Penalties::create($request->all());

        return response()->json([
            'message' => 'create Penalties success'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        // memastikan user admin berdasarkan username
        if ($request->user()->username != "admin1") {
            return response()->json([
                "message" => "forbidden"
            ], 403);
        };

        // mencari user berdasarkan id
        $penalties = Penalties::find($id);

        // jika tidak ada user
        if (!$penalties) {
            return response()->json([
                "message" => "penalties not found"
            ], 404);
        }

        return response()->json([
            "data" => $penalties
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->user()->username != "admin1") {
            return response()->json([
                "message" => "forbidden"
            ], 403);
        };

        $penalties = Penalties::find($id);

        // jika tidak ada return
        if (!$penalties) {
            return response()->json([
                "message" => "return not found"
            ], 404);
        }

        $request->validate([
            "penalties_name" => "required",
            "description" => "nullable|string",
            "no_car" => "required|string",
            "penalties_total" => "required|string",
        ]);

        $penalties->update($request->all());
        $penalties->save();

        return response()->json([
            "message" => "update return success",
            "data" => $penalties
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        // memastikan user admin berdasarkan username
        if ($request->user()->username != "admin1") {
            return response()->json([
                "message" => "forbidden"
            ], 403);
        };

        $penalties = Penalties::find($id);

        // jika tidak ada user
        if (!$penalties) {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }

        $penalties->delete();

        return response()->json([
            "message" => "delete return success"
        ], 200);
    }
}
