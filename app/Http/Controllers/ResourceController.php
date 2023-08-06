<?php

namespace App\Http\Controllers;

use App\Constant\BimbinganStatus;
use App\Constant\StatusValidasi;
use App\Models\Bimbingan;
use App\Models\Dosen;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function getPembimbing(Request $request)
    {
        $dosen = Dosen::where('role', 'dosen')->where('nama_dosen', 'like', '%' . $request->search . '%')->latest()->paginate(10);
        $dosen->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama_dosen,
            ];
        });
        return response()->json($dosen);
    }
    public function accJudul(Request $request)
    {
        $id_pendaftaran = $request->id;
        $res = Pendaftaran::find($id_pendaftaran)->update(['status' => StatusValidasi::VALIDASI]);
        return response()->json(['success' => 'Judul berhasil disetujui']);
    }

    public function deleteJudul($id)
    {
        $pendaftaran = Pendaftaran::find($id);
        $pendaftaran->delete();
        return response()->json(['success' => 'Data berhasil dihapus']);
    }

    public function getNim(Request $request)
    {
        // $nim = Pendaftaran::with('bimbingan')->where('status', StatusValidasi::VALIDASI)
        //     ->whereHas('bimbingan', function ($q) {
        //         $q->where('status', BimbinganStatus::DITERIMA);
        //     })->when(isset($request->search), function ($q) use ($request) {
        //         $q->where('nim', 'like', '%' . $request->search . '%');
        //     })->paginate(10);
        $nim = Bimbingan::with('pendaftaran.mahasiswa')->where('status', BimbinganStatus::DITERIMA)
            ->when(isset($request->search), function ($q) use ($request) {
                $q->where('nim', 'like', '%' . $request->search . '%');
            })->paginate(10);
        $nim->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id_bimbingan,
                'text' => $item->pendaftaran->nim,
                'id_dosen' => $item->pendaftaran->id_dosen
            ];
        });

        return response()->json($nim);
    }

    public function getPendaftaran(Request $request)
    {
        $pendaftaran = Pendaftaran::with('mahasiswa', 'dosen')->where('nim', $request->nim)->first();
        return response()->json($pendaftaran);
    }

    public function getPenguji(Request $request)
    {
        $penguji = Dosen::where('role', '!=', 'akademik')->where('id', '!=', $request->id_dosen)
            ->when(isset($request->search), function ($q) use ($request) {
                $q->where('nama_dosen', 'like', '%' . $request->search . '%');
            })
            ->paginate(10);
        $penguji->getCollection()->transform(function ($item) {
            return [
                'id' => $item->id,
                'text' => $item->nama_dosen,
            ];
        });
        return response()->json($penguji);
    }
}