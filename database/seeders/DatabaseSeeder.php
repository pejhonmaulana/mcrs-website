<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'test',
        //     'email' => 'test@example.com',
        // ]);

        // Residence
        // $residences = [
        //     [
        //         'residence_name' => 'New City Malang',
        //         'image' => 'new-city-malang.jpg',
        //         'location' => 'https://g.page/kawasan-new-city-malang?share',
        //         'description' => 'Perumahan new city malang dikembangkan oleh PT. Giriburing Adiraya dan berlokasi di Jl. Raya Ki Ageng Gribig, Kecamatan Kedungkandang.',
        //     ],
        //     [
        //         'residence_name' => 'City View',
        //         'image' => 'city-view.jpg',
        //         'location' => 'https://goo.gl/maps/7Q3SaTBMbBkVSVie6',
        //         'description' => 'Perumahan city view dikembangkan oleh PT. Turen Indah Property dan berlokasi di  Jl. KH. Malik Dalam, Kecamatan Kedungkandang.',
        //     ],
        //     [
        //         'residence_name' => 'De Villa',
        //         'image' => 'de-villa.jpg',
        //         'location' => 'https://goo.gl/maps/Yu8K1QKdiF4hgnJL9',
        //         'description' => 'Perumahan de villa dikembangkan oleh PT. Turen Indah Property dan berlokasi di Jl. Raya Ampeldento, Dami, Kecamatan Pakis.',
        //     ],
        //     [
        //         'residence_name' => 'Tanjung Banjar Arum Indah',
        //         'image' => 'tanjung-banjar-arum-indah.jpg',
        //         'location' => 'https://goo.gl/maps/KH3QKAvNXswf5h2b9',
        //         'description' => 'Perumahan Tanjung Banjar Arum Indah dikembangkan oleh PT. Dwirantha Karya Nusantara dan berlokasi di Tanjung, Banjararum, Kec. Singosari.',
        //     ],
        //     [
        //         'residence_name' => 'Grand Hill',
        //         'image' => 'grand-hill.jpg',
        //         'location' => 'https://goo.gl/maps/PSQmNYYJKgnFDthW6',
        //         'description' => 'Perumahan grand hill dikembangkan oleh PT. Turen Indah Property dan berlokasi di Jl. Kalianyar Buring, Wonokoyo, Kec. Kedungkandang.',
        //     ],
        // ];
        // foreach ($residences as $residence) {
        //     \App\Models\Residence::create([
        //         'residence_name' => $residence['residence_name'],
        //         'image' => $residence['image'],
        //         'location' => $residence['location'],
        //         'description' => $residence['description'],
        //     ]);
        // }

        // $getResidences = \App\Models\Residence::get();
        // $data = [
        //     // [
        //     //     'aksesibilitas_jalan_utama' => str_split("3210"),
        //     //     'aksesibilitas_sekolah' => str_split("5530"),
        //     //     'aksesibilitas_rumah_sakit' => str_split("3530"),
        //     //     'aksesibilitas_pusat_perbelanjaan' => str_split("2220"),
        //     //     'lebar_jalan' => str_split("5530"),
        //     //     'kelebihan_tanah' => str_split("4530"),
        //     //     'fasilitas_umum' => str_split("2350"),
        //     //     'harga' => str_split("3540"),
        //     //     'jaringan_listrik' => str_split("3320"),
        //     //     'keamanan' => str_split("4540"),
        //     //     'kenyamanan' => str_split("2350"),
        //     //     'luast_tanah' => str_split("4240"),
        //     //     'tipe_rumah' => str_split("3540"),
        //     //     'bukan_daerah_banjir' => str_split("2440"),
        //     //     'overall' => str_split("3250"),
        //     // ],
        //     [
        //         '1' => str_split("353254233424323"),
        //         '2' => str_split("523343353444425"),
        //         '3' => str_split("423323354425424"),
        //         '4' => str_split("455155132342242"),
        //         '5' => str_split("344254223535324"),
        //     ],
        // ];

        // // Generate Data Uji
        // for ($j=0; $j <= 9; $j++) { 
        //     foreach ($getResidences as $key => $residence) {
        //         \App\Models\Rating::create([
        //             'user_id' => $j+1,
        //             'residence_id' => $residence->id,
        //             'aksesibilitas' => $data[$j]['aksesibilitas'][$key],
        //             'fasilitas_umum' => $data[$j]['fasilitas_umum'][$key],
        //             'keamanan' => $data[$j]['keamanan'][$key],
        //             'harga' => $data[$j]['harga'][$key],
        //             'lebar_jalan' => $data[$j]['lebar_jalan'][$key],
        //             'overall' => $data[$j]['overall'][$key],
        //         ]);
    
        //     }
        // }
    }
}