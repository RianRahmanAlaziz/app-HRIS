<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function userprofil()
    {
        return view('dashboard.user.user-profil', [
            'title' => 'User Profil',
            'user' => User::all(),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'title' => 'User Management',
            'user' => User::all(),
            'roles' => Role::all()
        ]);
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
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);
        $user->assignRole($request->roles);
        return redirect('/dashboard/data-user-management')->with('success', 'Data User Berhasil di Tambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validator = $request->validate([
            'nama' => 'required|max:255',
            'email' => 'required',
            'password' => 'nullable'
        ]);
        if ($request->filled('password')) {
            $validator['password'] = Hash::make($validator['password']);
        }


        try {
            $user = User::findOrFail($id);
            $user->roles()->detach();
            $user->update($validator);

            if ($request->filled('roles')) {
                $user->assignRole($request->roles); // Menggunakan syncRoles untuk mengganti peran yang ada
            }

            return redirect('/dashboard/data-user-management')->with('success', 'Data User Berhasil di Update');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-user-management')->with('error', 'Gagal MengUpdate User. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $pengajuanCuti = PengajuanCuti::where('user_id', $id)->get();
        try {
            User::destroy($user->id);
            Karyawan::destroy($user->karyawan->id);
            PengajuanCuti::where('user_id', $id)->delete();
            foreach ($pengajuanCuti as $cuti) {
                File::delete('assets/file/pengajuan-cuti/' . $cuti->surat);
            }
            return redirect('/dashboard/data-user-management')->with('success', 'Data User Berhasil di Hapus');
        } catch (\Exception $e) {
            return redirect('/dashboard/data-user-management')->with('error', 'Gagal menghapus User. Silakan coba lagi.');
        }
    }
}
