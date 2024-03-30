<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\PengajuanCuti;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function userprofil()
    {
        return view('dashboard.user.user-profil', [
            'title' => 'User Profil',
            'user' => User::all()
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.user.index', [
            'title' => 'User Management',
            'user' => User::all()
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
            'level' => 'required',
            'password' => 'required|min:5|max:255'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
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
            'level' => 'required',
            'password' => 'sometimes'
        ]);
        if ($request->filled('password')) {

            $validator['password'] = Hash::make($validator['password']);
        }


        try {
            User::where('id', $id)->update($validator);
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
