<?php

namespace App\Http\Requests;

use App\Constant\Keterangan;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UjianRequest extends FormRequest
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
            'nim' => 'required',
            'ruangan' => 'required',
            'tanggal' => 'required',
            'jam' => 'required',
            'ketua_penguji' => 'required',
            'anggota_penguji' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'nim' => 'nim'
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
        $data['ujian'] = [
            'id_bimbingan' => $this->nim,
            'ruangan' => $this->ruangan,
            'tanggal' => Carbon::parse($this->tanggal)->format('Y-m-d'),
            'jam' => $this->jam,
            'keterangan' => Keterangan::BELUM_UJIAN
        ];
        $data['detail_ujian'] = [
            'id_pendaftaran' => $this->id_pendaftaran,
            'ketua_penguji' => $this->ketua_penguji,
            'anggota_penguji' => $this->anggota_penguji
        ];
        return $data;
    }
}
