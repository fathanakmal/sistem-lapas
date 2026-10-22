<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Cek Keamanan: Mengamankan seluruh fungsi di controller ini
    private function pastikanSuperadmin() {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Ditolak: Anda tidak memiliki wewenang untuk mengakses halaman ini.');
        }
    }

    // 1. Tampilkan Daftar Pengguna
    public function index() {
        $this->pastikanSuperadmin();
        $semuaUser = User::orderBy('role', 'asc')->get();
        return view('users.index', compact('semuaUser'));
    }

    // 2. Tampilkan Formulir Tambah
    public function create() {
        $this->pastikanSuperadmin();
        return view('users.create');
    }

    // 3. Simpan Pengguna Baru
    public function store(Request $request) {
        $this->pastikanSuperadmin();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:superadmin,supervisor,petugas',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect('/manajemen-pengguna')->with('success', 'Akun petugas baru berhasil dibuat!');
    }

    // 4. Tampilkan Formulir Edit
    public function edit($id) {
        $this->pastikanSuperadmin();
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    // 5. Update Data Pengguna
    public function update(Request $request, $id) {
        $this->pastikanSuperadmin();
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|in:superadmin,supervisor,petugas',
            'password' => 'nullable|string|min:6', // Password opsional saat edit
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Hanya ganti password jika kotak input diisi oleh superadmin
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect('/manajemen-pengguna')->with('success', 'Data akun berhasil diperbarui!');
    }

    // 6. Hapus Akun Petugas
    public function destroy($id) {
        $this->pastikanSuperadmin();
        $user = User::findOrFail($id);

        // Mencegah Superadmin tidak sengaja menghapus dirinya sendiri
        if ($user->id === Auth::id()) {
            return redirect('/manajemen-pengguna')->with('success', 'Gagal: Anda tidak bisa menghapus akun Anda sendiri.');
        }

        $user->delete();
        return redirect('/manajemen-pengguna')->with('success', 'Akun petugas telah dihapus dari sistem.');
    }
}