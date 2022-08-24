<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ContainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Container::insert([
            [
                'kode_container' => 'KT001',
                'nama_container' => 'Elektronik',
                'keterangan' => 'Semua barang di ruang multimedia',
            ],
            [
                'kode_container' => 'KT002',
                'nama_container' => 'Kendaraan',
                'keterangan' => 'Isi BBM setelah pinjam',
            ],
            [
                'kode_container' => 'KT003',
                'nama_container' => 'Ruangan',
                'keterangan' => 'Semua ruangan di sekolah',
            ],
        ]);
    }
}
