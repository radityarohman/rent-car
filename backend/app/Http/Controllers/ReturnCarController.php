<?php

namespace App\Http\Controllers;

use App\Models\ReturnCar;
use Illuminate\Http\Request;

class ReturnCarController extends Controller
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

        $data = ReturnCar::with("penalties")->get();

        return response()->json([
            "data" => $data
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
            "tenant" => "required",
            "no_car" => "required|string",
            "id_penalties" => "required|string",
            "date_borrow" => "required|date",
            "date_return" => "required|date",
            "down_payment" => "required|min:4",
            "discount" => "nullable",
            "total" => "required|min:4",
        ]);

        if ($request->date_borrow === $request->date_return || $request->date_borrow > $request->date_return) {
            return response()->json([
                "message" => "tanggal pinjam dan tanggal kembali tidak valid, periksa kembali"
            ], 401);
        };

        ReturnCar::create($request->all());

        return response()->json([
            'message' => 'create Return success'
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
        $return = ReturnCar::find($id);

        // jika tidak ada user
        if (!$return) {
            return response()->json([
                "message" => "return not found"
            ], 404);
        }

        return response()->json([
            "data" => $return
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

        $return = ReturnCar::find($id);

        // jika tidak ada return
        if (!$return) {
            return response()->json([
                "message" => "return not found"
            ], 404);
        }

        $request->validate([
            "tenant" => "required",
            "no_car" => "required|string",
            "id_penalties" => "required|string",
            "date_borrow" => "required|date",
            "date_return" => "required|date",
            "down_payment" => "required|min:4",
            "discount" => "nullable",
            "total" => "required|min:4",
        ]);

        if ($request->date_borrow === $request->date_return || $request->date_borrow > $request->date_return) {
            return response()->json([
                "message" => "tanggal pinjam dan tanggal kembali tidak valid, periksa kembali"
            ], 401);
        };

        $return->update($request->all());
        $return->save();

        return response()->json([
            "message" => "update return success",
            "data" => $return
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

        $return = ReturnCar::find($id);

        // jika tidak ada user
        if (!$return) {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }

        $return->delete();

        return response()->json([
            "message" => "delete return success"
        ], 200);
    }
}
