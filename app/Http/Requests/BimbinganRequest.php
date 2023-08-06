<?php

namespace App\Http\Requests;

use App\Constant\BimbinganStatus;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BimbinganRequest extends FormRequest
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
            'catatan' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'catatan.required' => 'Catatan bimbingan Wajib diisi'
        ];
    }

    public function getfile()
    {
        if ($this->hasFile('file')) {
            $name = $this->file('file')->getClientOriginalName();
            if (Auth::guard('web')->check()) {
                $file = 'Mhs_' . $name;
            } else {
                $file = 'DosPem_' . $name;
            }
            $this->file('file')->move('assets/file/bimbingan', $file);
        } else {
            $file = null;
        }

        return $file;
    }

    public function data()
    {
        $data['bimbingan'] = [
            'id_pendaftaran' => $this->id_pendaftaran,
            'status' => BimbinganStatus::PROSES
        ];
        $data['detail_bimbingan'] = [
            'id_bimbingan' => $this->id_pendaftaran,
            'file' => $this->getfile(),
            'catatan' => $this->catatan,
            'tanggal' => Carbon::now(),
            'auth' => Auth::user()->nama_mahasiswa ?? Auth::user()->nama_dosen
        ];
        return $data;
    }
}