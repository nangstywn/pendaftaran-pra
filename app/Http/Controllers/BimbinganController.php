<?php

namespace App\Http\Controllers;

use App\Constant\BimbinganStatus;
use App\Constant\StatusValidasi;
use App\Http\Requests\BimbinganRequest;
use App\Models\Bimbingan;
use App\Models\DetailBimbingan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class BimbinganController extends Controller
{
    public function index(Request $request)
    {
        $logged_in_nim = Auth::user()->nim;
        $bimbingans = Bimbingan::with('pendaftaran.mahasiswa', 'pendaftaran.dosen')->withCount('detailBimbingan')->whereHas('pendaftaran', function ($q) use ($logged_in_nim) {
            $q->where('nim', $logged_in_nim);
        })->when(isset($request->q), function ($q) use ($request) {
            $q->whereHas('pendaftaran', function ($q) use ($request) {
                $q->whereHas('mahasiswa', function ($q) use ($request) {
                    $q->where('nama_mahasiswa', 'like', '%' . $request->q . '%')->orWhere('nim', 'like', '%' . $request->q . '%');
                })->orWhereHas('dosen', function ($q) use ($request) {
                    $q->where('nama_dosen', 'like', '%' . $request->q . '%');
                });
            });
        })->when(isset($request->status), function ($q) use ($request) {
            $q->where('status', 'like', '%' . $request->status . '%');
        })
            ->latest()->paginate(10);
        $acc = Pendaftaran::where('status', StatusValidasi::VALIDASI)->where('nim', Auth::user()->nim)->first();
        return view('mahasiswa.bimbingan.index', compact('bimbingans', 'acc'));
    }

    public function indexBimbinganDosen(Request $request)
    {
        $logged_in_id_dosen = Auth::guard('dosen')->user()->id;
        $bimbingans = Bimbingan::with('pendaftaran.mahasiswa', 'pendaftaran.dosen')->withCount('detailBimbingan')
            ->whereHas('pendaftaran', function ($q) use ($logged_in_id_dosen) {
                $q->where('id_dosen', $logged_in_id_dosen);
            })->when(isset($request->q), function ($q) use ($request) {
                $q->whereHas('pendaftaran', function ($q) use ($request) {
                    $q->whereHas('mahasiswa', function ($q) use ($request) {
                        $q->where('nama_mahasiswa', 'like', '%' . $request->q . '%')->orWhere('nim', 'like', '%' . $request->q . '%');
                    })->orWhereHas('dosen', function ($q) use ($request) {
                        $q->where('nama_dosen', 'like', '%' . $request->q . '%');
                    });
                });
            })->when(isset($request->status), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest()->paginate(10);
        return view('dosen.pembimbing.bimbingan.index', compact('bimbingans'));
    }

    public function indexBimbinganAkademik(Request $request)
    {
        $bimbingans = Bimbingan::with('pendaftaran.mahasiswa', 'pendaftaran.dosen')->when(isset($request->q), function ($q) use ($request) {
            $q->whereHas('pendaftaran', function ($q) use ($request) {
                $q->whereHas('mahasiswa', function ($q) use ($request) {
                    $q->where('nama_mahasiswa', 'like', '%' . $request->q . '%')->orWhere('nim', 'like', '%' . $request->q . '%');
                })->orWhereHas('dosen', function ($q) use ($request) {
                    $q->where('nama_dosen', 'like', '%' . $request->q . '%');
                });
            });
        })->when(isset($request->status), function ($q) use ($request) {
            $q->where('status', $request->status);
        })
            ->latest()->paginate(10);
        return view('dosen.akademik.bimbingan.index', compact('bimbingans'));
    }

    public function indexBimbinganProdi(Request $request)
    {
        $bimbingans = Bimbingan::with('pendaftaran.mahasiswa', 'pendaftaran.dosen')
            ->when(isset($request->q), function ($q) use ($request) {
                $q->whereHas('pendaftaran', function ($q) use ($request) {
                    $q->whereHas('mahasiswa', function ($q) use ($request) {
                        $q->where('nama_mahasiswa', 'like', '%' . $request->q . '%')->orWhere('nim', 'like', '%' . $request->q . '%');
                    })->orWhereHas('dosen', function ($q) use ($request) {
                        $q->where('nama_dosen', 'like', '%' . $request->q . '%');
                    });
                });
            })->when(isset($request->status), function ($q) use ($request) {
                $q->where('status', $request->status);
            })
            ->latest()->paginate(10);
        return view('dosen.prodi.bimbingan.index', compact('bimbingans'));
    }

    public function store(BimbinganRequest $request, $id_pendaftaran)
    {
        DB::beginTransaction();
        try {
            $data = $request->data();
            $exist = Bimbingan::where('id_pendaftaran', $id_pendaftaran)->first();
            if (empty($exist)) {
                $bimbingan = Bimbingan::create($data['bimbingan']);
            } else {
                $bimbingan = $exist;
            }
            if (!empty($data['detail_bimbingan'])) {
                $bimbingan->detailBimbingan()->create($data['detail_bimbingan']);
            }
            DB::commit();
            return redirect()->route('mahasiswa.bimbingan.detail', $id_pendaftaran)->with('success', 'Bimbingan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('error', $e->getMessage());
        }
    }
    public function storeDosen(BimbinganRequest $request, $id_pendaftaran)
    {
        DB::beginTransaction();
        try {
            $data = $request->data();
            $exist = Bimbingan::where('id_pendaftaran', $id_pendaftaran)->first();
            if (empty($exist)) {
                $bimbingan = Bimbingan::create($data['bimbingan']);
            } else {
                $bimbingan = $exist;
            }
            if (!empty($data['detail_bimbingan'])) {
                $bimbingan->detailBimbingan()->create($data['detail_bimbingan']);
            }
            DB::commit();
            return redirect()->route('dosen.pembimbing.bimbingan.detail', $id_pendaftaran)->with('success', 'Bimbingan berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors('error', $e->getMessage());
        }
    }

    public function detail($id)
    {
        $pendaftaran = Pendaftaran::with(['mahasiswa', 'dosen', 'bimbingan.detailBimbingan'])->find($id);
        $bimbingan = Bimbingan::where('id_pendaftaran', $id)->first();
        $detailBimbingans = DetailBimbingan::where('id_bimbingan', $bimbingan->id_bimbingan ?? null)->latest()->paginate(5);
        return view('mahasiswa.bimbingan.detail', compact('pendaftaran', 'detailBimbingans', 'bimbingan'));
    }

    public function detailBimbinganDosen($id)
    {
        $pendaftaran = Pendaftaran::with(['mahasiswa', 'dosen', 'bimbingan.detailBimbingan'])->find($id);
        $bimbingan = Bimbingan::where('id_pendaftaran', $id)->first();
        $detailBimbingans = DetailBimbingan::where('id_bimbingan', $bimbingan->id_bimbingan ?? null)->latest()->paginate(5);
        return view('dosen.pembimbing.bimbingan.detail', compact('pendaftaran', 'detailBimbingans', 'bimbingan'));
    }

    public function detailBimbinganAkademik($id)
    {
        $pendaftaran = Pendaftaran::with(['mahasiswa', 'dosen', 'bimbingan.detailBimbingan'])->find($id);
        $bimbingan = Bimbingan::where('id_pendaftaran', $id)->first();
        $detailBimbingans = DetailBimbingan::where('id_bimbingan', $bimbingan->id_bimbingan ?? null)->latest()->paginate(5);
        return view('dosen.akademik.bimbingan.detail', compact('pendaftaran', 'detailBimbingans', 'bimbingan'));
    }

    public function detailBimbinganProdi($id)
    {
        $pendaftaran = Pendaftaran::with(['mahasiswa', 'dosen', 'bimbingan.detailBimbingan'])->find($id);
        $bimbingan = Bimbingan::where('id_pendaftaran', $id)->first();
        $detailBimbingans = DetailBimbingan::where('id_bimbingan', $bimbingan->id_bimbingan ?? null)->latest()->paginate(5);
        return view('dosen.prodi.bimbingan.detail', compact('pendaftaran', 'detailBimbingans', 'bimbingan'));
    }

    public function accBimbingan(Request $request, $id_pendaftaran)
    {
        if ($request->hasFile('file')) {
            $name = $request->file('file')->getClientOriginalName();
            $file = 'bukti_acc' . $name;
            $request->file('file')->move('assets/file/bimbingan/acc', $file);
        } else {
            $file = null;
        }
        $bimbingan = Bimbingan::whereHas('pendaftaran', function ($q) {
            $q->where('status', StatusValidasi::VALIDASI);
        })->where('id_pendaftaran', $id_pendaftaran)->first();
        $bimbingan->update(['status' => $request->status, 'bukti_acc' => $file, 'approver' => Auth::guard('dosen')->user()->id]);
        return redirect()->route('dosen.pembimbing.bimbingan.index')->with('success', 'Bimbingan berhasil disetujui');
    }

    public function report()
    {
        $user_id = auth()->user()->nim;
        $report = Bimbingan::with(['detailBimbingan' => function ($q) {
            $q->latest();
        }, 'pendaftaran'])
            ->whereHas('pendaftaran', function ($q) use ($user_id) {
                $q->where('nim', $user_id)->where('status', StatusValidasi::VALIDASI);
            })
            ->first();
        return view('mahasiswa.bimbingan.report', compact('report'));
    }

    public function downloadPdf()
    {
        $user_id = auth()->user()->nim;
        $nama = auth()->user()->nama_mahasiswa;
        $report = Bimbingan::with(['detailBimbingan' => function ($q) {
            $q->latest();
        }, 'pendaftaran'])
            ->whereHas('pendaftaran', function ($q) use ($user_id) {
                $q->where('nim', $user_id)->where('status', StatusValidasi::VALIDASI);
            })
            ->first();

        $pdf = PDF::loadview('mahasiswa.bimbingan.pdf', ['report' => $report]);
        return $pdf->download('Kartu Bimbingan ' . $nama . '.pdf');
    }
}
