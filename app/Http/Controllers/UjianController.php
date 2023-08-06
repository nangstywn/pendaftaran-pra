<?php

namespace App\Http\Controllers;

use App\Constant\Keterangan;
use App\Http\Requests\UjianRequest;
use App\Models\JadwalUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    public function index(Request $request)
    {
        $ujians = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')
            ->when(isset($request->keterangan), function ($q) use ($request) {
                $q->where('keterangan', $request->keterangan);
            })
            ->when(isset($request->q), function ($q) use ($request) {
                $q->whereHas('bimbingan.pendaftaran.mahasiswa', function ($q) use ($request) {
                    $q->where('nim', 'like', '%' . $request->q . '%')->orWHere('nama_mahasiswa', 'like', '%' . $request->q . '%');
                });
            })
            ->latest()->paginate(10);
        return view('dosen.akademik.ujian.index', compact('ujians'));
    }
    public function indexMahasiswa(Request $request)
    {
        $logged_in_mhs = Auth::user()->nim;
        $ujians = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')
            ->whereHas('bimbingan.pendaftaran', function ($q) use ($logged_in_mhs) {
                $q->where('nim', $logged_in_mhs);
            })
            ->latest()->paginate(10);
        return view('mahasiswa.ujian.index', compact('ujians'));
    }
    public function indexDosen(Request $request)
    {
        $logged_in_dosen = Auth::user()->id;
        $ujians = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')
            ->whereHas('bimbingan.pendaftaran', function ($q) use ($logged_in_dosen) {
                $q->where('id_dosen', $logged_in_dosen);
            })->when(isset($request->keterangan), function ($q) use ($request) {
                $q->where('keterangan', $request->keterangan);
            })
            ->when(
                isset($request->q),
                function ($q) use ($request) {
                    $q->whereHas('bimbingan.pendaftaran.mahasiswa', function ($q) use ($request) {
                        $q->where('nim', 'like', '%' . $request->q . '%')->orWHere('nama_mahasiswa', 'like', '%' . $request->q . '%');
                    });
                }
            )
            ->latest()->paginate(10);
        return view('dosen.pembimbing.ujian.index', compact('ujians'));
    }
    public function indexProdi(Request $request)
    {
        $logged_in_dosen = Auth::user()->id;
        $ujians = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')
            ->when(isset($request->keterangan), function ($q) use ($request) {
                $q->where('keterangan', $request->keterangan);
            })
            ->when(
                isset($request->q),
                function ($q) use ($request) {
                    $q->whereHas('bimbingan.pendaftaran.mahasiswa', function ($q) use ($request) {
                        $q->where('nim', 'like', '%' . $request->q . '%')->orWHere('nama_mahasiswa', 'like', '%' . $request->q . '%');
                    });
                }
            )
            ->latest()->paginate(10);
        return view('dosen.prodi.ujian.index', compact('ujians'));
    }

    public function create()
    {
        return view('dosen.akademik.ujian.create');
    }

    public function store(UjianRequest $request)
    {
        $data = $request->data();
        $ujian = JadwalUjian::create($data['ujian']);
        $ujian->detailUjian()->create($data['detail_ujian']);
        return redirect()->route('dosen.akademik.ujian.index')->with('success', 'Jadwal Ujian berhasil ditambahkan');
    }

    public function detail($id)
    {
        $ujian = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')->where('id_jadwal_ujian', $id)->first();
        return view('dosen.akademik.ujian.detail', compact('ujian'));
    }
    public function detailMahasiswa($id)
    {
        $ujian = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')->where('id_jadwal_ujian', $id)->first();
        return view('mahasiswa.ujian.detail', compact('ujian'));
    }
    public function detailDosen($id)
    {
        $ujian = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')->where('id_jadwal_ujian', $id)->first();
        return view('dosen.pembimbing.ujian.detail', compact('ujian'));
    }
    public function detailProdi($id)
    {
        $ujian = JadwalUjian::with('bimbingan.pendaftaran.mahasiswa', 'bimbingan.pendaftaran.dosen', 'detailUjian.ketuaPenguji', 'detailUjian.anggotaPenguji')->where('id_jadwal_ujian', $id)->first();
        return view('dosen.prodi.ujian.detail', compact('ujian'));
    }

    public function selesai(Request $request, $id)
    {
        $ujian = JadwalUjian::where('id_jadwal_ujian', $id)->first();
        $ujian->update(['hasil_ujian' => $request->hasil, 'keterangan' => Keterangan::SUDAH_UJIAN]);
        return redirect()->route('dosen.akademik.ujian.index')->with('success', 'Data Ujian berhasil diupdate ');
    }
}