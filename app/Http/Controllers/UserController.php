<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function mahasiswa(Request $request)
    {
        $mahasiswas = User::when(isset($request->jurusan), function ($q) use ($request) {
            $q->where('jurusan', $request->jurusan);
        })->when(isset($request->jk), function ($q) use ($request) {
            $q->where('jenis_kelamin', $request->jk);
        })->when(isset($request->q), function ($q) use ($request) {
            $q->where('nim', 'like', '%' . $request->q . '%')->orWhere('nama_mahasiswa', 'like', '%' . $request->q . '%');
        })
            ->latest()->paginate(10);
        return view('dosen.prodi.mahasiswa', compact('mahasiswas'));
    }
    public function dosen(Request $request)
    {
        $dosens = Dosen::when(isset($request->q), function ($q) use ($request) {
            $q->where('nip', 'like', '%' . $request->q . '%')->orWhere('nama_dosen', 'like', '%' . $request->q . '%');
        })->where('role', 'dosen')
            ->latest()->paginate(10);
        return view('dosen.prodi.dosen', compact('dosens'));
    }

    public function create()
    {
        return view('dosen.prodi.create');
    }

    public function profile($id)
    {
        if (Auth::check()) {
            $user = User::where('nim', $id)->first();
        } else {
            $user = Dosen::where('id', $id)->first();
        }
        return view('profile.index', compact('user'));
    }

    public function password(Request $request, $id)
    {
        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|min:8',
        ], messages: [
            'min' => 'password minimal 8 karakter'
        ]);
        if (Auth::check()) {
            $user = User::where('nim', $id)->first();
        } else {
            $user = Dosen::where('id', $id)->first();
        }
        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->new_password)
            ])->save();

            return redirect()->route('profile', $id)->with('success', 'Password berhasil diubah');
        } else {
            return redirect()->route('profile', $id)->withErrors('Gagal, password tidak cocok');
        }
    }
}
