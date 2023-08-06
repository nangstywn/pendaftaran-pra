<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $dosens = [
            [
                'nidn' => "123456789",
                'nama_dosen' => "Muhammad Guntara",
                'no_tlpn' => "0813424212",
                'role' => "akademik",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0015037810",
                'nama_dosen' => "Pulut Suryati",
                'no_tlpn' => "0813423242",
                'role' => "kaprodi",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0515048402",
                'nama_dosen' => "Sumiyatun",
                'no_tlpn' => "0813233242",
                'role' => "sekprodi",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0511108603",
                'nama_dosen' => "Nafisatul Lutfi",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0511046702",
                'nama_dosen' => "Indra Yatini Buryadi",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0522126901",
                'nama_dosen' => "Wagito",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0026108101",
                'nama_dosen' => "Yohakim Marwanta",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "05144077501",
                'nama_dosen' => "Edi Iskandar",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0519067401",
                'nama_dosen' => "Cosmas Haryawan",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0511107301",
                'nama_dosen' => "Deborah Kurniawati",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0526096701",
                'nama_dosen' => "Dison Librado",
                'no_tlpn' => "0813233242",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0502117203",
                'nama_dosen' => "Edi Prayitno",
                'no_tlpn' => "081323323422",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
            [
                'nidn' => "0003037901",
                'nama_dosen' => "Emy Susanti",
                'no_tlpn' => "0813233234",
                'role' => "dosen",
                'password' => bcrypt('12345678'),
            ],
        ];
        Dosen::insert($dosens);
    }
}
