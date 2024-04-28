<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
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

        $data = User::all();

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
            "username" => "required|string|unique:users",
            "password" => "required|string",
            "no_ktp" => "required|min:16|max:16",
            "name" => "required|string",
            "date_of_birth" => "required|date",
            "email" => "required|email|unique:users",
            "phone" => "required|min:11|max:13",
            "description" => "nullable|string",
        ]);

        User::create($request->all());

        return response()->json([
            'message' => 'create register success'
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
        $user = User::find($id);

        // jika tidak ada user
        if (!$user) {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }

        return response()->json([
            "data" => $user
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

        $user = User::find($id);

        // jika tidak ada user
        if (!$user) {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }

        $request->validate([
            "username" => "required|string",
            "password" => "string",
            "no_ktp" => "required|min:16|max:16",
            "name" => "required|string",
            "date_of_birth" => "required|date",
            "email" => "required|email",
            "phone" => "required|min:11|max:13",
            "description" => "nullable|string",
        ]);

        if ($request->username !== $user->username) {
            $request->validate([
                "username" => "unique:users",
            ]);
        };

        if ($request->email !== $user->email) {
            $request->validate([
                "email" => "unique:users",
            ]);
        };

        $user->update($request->all());
        $user->save();

        return response()->json([
            "message" => "update register success",
            "data" => $user
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

        $user = User::find($id);

        // jika tidak ada user
        if (!$user) {
            return response()->json([
                "message" => "user not found"
            ], 404);
        }

        $user->delete();

        return response()->json([
            "message" => "delete data success"
        ], 200);
    }
}
