<?php

namespace App\Http\Controllers;

use App\Constant\HasilUjian;
use App\Constant\StatusValidasi;
use App\Http\Requests\PendaftaranRequest;
use App\Models\Bimbingan;
use App\Models\DetailBimbingan;
use App\Models\JadwalUjian;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $logged_in_mhs = Auth::user()->nim;
            $pendaftarans = Pendaftaran::with('mahasiswa', 'dosen')
                ->when(isset($request->status), function ($q) use ($request) {
                    $q->where('status', 'like', '%' . $request->status . '%');
                })
                ->where('nim', $logged_in_mhs)->latest()->paginate(10);
            $status = [];
            $acc = false;
            $arr = $pendaftarans->toArray();
            foreach ($arr['data'] as $val) {
                $status[] = $val['status'];
            }
            if (in_array(StatusValidasi::VALIDASI, $status)) {
                $acc = true;
            }
            $ujianDitolak = JadwalUjian::with('bimbingan.pendaftaran')->whereHas('bimbingan.pendaftaran', function ($q) use ($logged_in_mhs) {
                $q->where('nim', $logged_in_mhs);
            })->where('hasil_ujian', HasilUjian::TIDAK_LULUS)->latest()->count();
            return view('mahasiswa.index', compact('pendaftarans', 'acc', 'ujianDitolak'));
        } elseif (Auth::guard('dosen')->check()) {
            // dd($request);
            $logged_in_dosen = Auth::guard('dosen')->user()->id;
            $pendaftarans = Pendaftaran::with('mahasiswa', 'dosen')->where('id_dosen', $logged_in_dosen)
                ->when(isset($request->q), function ($q) use ($request) {
                    $q->where('nim', 'like', '%' . $request->q . '%')
                        ->orWhereHas('mahasiswa', function ($q) use ($request) {
                            $q->where('nama_mahasiswa', 'like', '%' . $request->q . '%');
                        });
                })
                ->selectRaw('id_pendaftaran,nim,id_dosen, count(*) as total')
                ->groupBy('nim')->latest()->paginate(10);
            return view('dosen.pembimbing.index', compact('pendaftarans'));
        }
    }
    public function create()
    {
        return view('mahasiswa.create');
    }
    public function edit($id_pendaftaran)
    {
        $pendaftaran = Pendaftaran::with('mahasiswa', 'dosen')->find($id_pendaftaran);
        return view('mahasiswa.edit', compact('pendaftaran'));
    }

    public function store(PendaftaranRequest $request)
    {
        $save = Pendaftaran::create($request->data());
        if ($save) {
            return redirect()->route('mahasiswa.pendaftaran.index')->with('success', 'Berhasil melakukan pendaftaran');
        }
        return redirect()->route('mahasiswa.pendaftaran.index')->with('error', 'Gagal melakukan pendaftaran');
    }
    public function update(PendaftaranRequest $request, $id_pendaftaran)
    {
        $pendaftaran = Pendaftaran::find($id_pendaftaran)->update($request->data());
        if ($pendaftaran) {
            return redirect()->route('mahasiswa.pendaftaran.index')->with('success', 'Pendaftaran berhasil diubah');
        }
        return redirect()->route('mahasiswa.pendaftaran.index')->with('error', 'Pendaftaran gagal diubah');
    }

    public function detailDosen($nim)
    {
        $logged_in_dosen = Auth::guard('dosen')->user()->id;
        $details = Pendaftaran::where('id_dosen', $logged_in_dosen)->where('nim', $nim)->latest()->paginate(5);
        $status = [];
        $acc = false;
        $arr = $details->toArray();
        foreach ($arr['data'] as $val) {
            $status[] = $val['status'];
        }
        if (in_array(StatusValidasi::VALIDASI, $status)) {
            $acc = true;
        }
        return view('dosen.pembimbing.detail', compact('details', 'acc'));
    }

    public function detail($id)
    {
        $pendaftaran = Pendaftaran::with(['mahasiswa', 'dosen', 'bimbingan.detailBimbingan'])->find($id);
        $bimbingan = Bimbingan::where('id_pendaftaran', $id)->first();
        $detailBimbingans = DetailBimbingan::where('id_bimbingan', $bimbingan->id_bimbingan ?? null)->latest()->paginate(5);
        return view('mahasiswa.detail', compact('pendaftaran', 'detailBimbingans', 'bimbingan'));
    }

    public function addBimbingan(Request $request, $id)
    {
        DB::beginTransaction();
        $skripsi = Skripsi::find($id);
        if ($request->hasFile('file')) {
            $name = $request->file('file')->getClientOriginalName();
            if (Auth::user()->level == 'mahasiswa') {
                $file = 'Mhs_' . $name;
            } else {
                $file = 'DosPem_' . $name;
            }
            $request->file('file')->move('bimbingan-proposal/files/', $file);
        } else {
            $file = null;
        }
        try {
            Bimbingan::create([
                'id_skripsi' => $skripsi->id,
                'file' => $file,
                'catatan' => $request->catatan,
                'tanggal' => Carbon::now()
            ]);

            DB::commit();
            return redirect()->route('riwayat', $skripsi->id)->with('success', 'Berhasil menambah bimbingan');
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal Menambahkan bimbingan');
        }
    }
}
