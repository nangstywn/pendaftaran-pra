<?php

namespace App\Http\Requests;

use App\Constant\StatusValidasi;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PendaftaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'semester' => 'required',
            'tahun_ajaran' => 'required',
            'tanggal' => 'required',
            'dosen' => 'required',
            'judul' => 'required',
        ];
    }
    public function attributes()
    {
        return [
            'semester' => 'semester'
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute wajib diisi'
        ];
    }
    public function data()
    {
        return [
            'nim' => Auth::user()->nim,
            'semester' => $this->semester,
            'tahun_ajaran' => $this->tahun_ajaran,
            'tanggal' => Carbon::parse($this->tanggal)->format('Y-m-d'),
            'status' => StatusValidasi::BELUM_VALIDASI,
            'judul' => $this->judul,
            'id_dosen' => $this->dosen
        ];
    }
}
