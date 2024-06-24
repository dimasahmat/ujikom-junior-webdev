<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    public function index()
    {
        $employees = User::orderBy('name', 'asc')->get();
        return view('pages.pegawai.index', compact('employees'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        // Handle avatar only if it's uploaded
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        } else {
            unset($validated['avatar']); // Remove avatar key if not uploaded
        }

        $validated['password'] = Hash::make($request->password);

        $employee = User::create($validated);

        return response()->json([
            'message' => 'Berhasil menambahkan pegawai baru',
            'data' => $employee
        ], 201);
    }

    public function show(string $id)
    {
        $employee = User::findOrFail($id);

        return response()->json([
            'message' => 'Berhasil menampilkan detail pegawai',
            'data' => $employee
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'min:3', 'max:255'],
            'email' => ['nullable', 'email', Rule::unique('users')->ignore($id)],
            'password' => ['nullable', 'string', 'min:8'],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);

        $user = User::findOrFail($id);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // Jangan ubah password jika tidak diisi
        }

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $validated['avatar'] = $avatarPath;
        } else {
            unset($validated['avatar']); // Jangan ubah avatar jika tidak diupload
        }

        $user->update($validated);

        return response()->json([
            'message' => 'Data pengguna berhasil diperbarui',
            'data' => $user
        ], 200);
    }


    public function destroy(string $id)
    {
        $employee = User::findOrFail($id);
        $employee->delete();

        return response()->json([
            'message' => 'Berhasil menghapus data pegawai',
            'data' => $employee
        ], 200);
    }
}
