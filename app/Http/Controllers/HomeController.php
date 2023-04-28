<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\TempatKuliner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $tempatKuliners = TempatKuliner::get();
        $recommendations = null;
        $rating = Rating::where([['user_id', auth()->user()->id], ['overall', '!=', 0]])->with('tempatKuliner')->get();
        $jumlahTerRating = count($rating);
        if (Auth::user()) {
            $userId = Auth::user()->id;
            $checkRatingUser = Rating::whereUserId(Auth::user()->id)->get();
            if ($userId && count($checkRatingUser) != 0) {
                $getUnRatings = Rating::whereUserId($userId)->with('tempatKuliner')->get();
                $getURatings = Rating::with('user')->where('user_id', '!=', $userId)->get()->groupBy('user_id');

                // variable tempat_parkir
                $averageTempatParkirUn = 0;
                $averageTempatParkirU = 0;
                $sigmaTempatParkir = 0;
                $sigmaTempatParkirUn = 0;
                $sigmaTempatParkirU = 0;
                $similarityTempatParkir = 0;

                // variable harga
                $averageHargaUn = 0;
                $averageHargaU = 0;
                $sigmaHarga = 0;
                $sigmaHargaUn = 0;
                $sigmaHargaU = 0;
                $similarityHarga = 0;

                // variable pegawai
                $averagePegawaiUn = 0;
                $averagePegawaiU = 0;
                $sigmaPegawai = 0;
                $sigmaPegawaiUn = 0;
                $sigmaPegawaiU = 0;
                $similarityPegawai = 0;

                // variable menu
                $averageMenuUn = 0;
                $averageMenuU = 0;
                $sigmaMenu = 0;
                $sigmaMenuUn = 0;
                $sigmaMenuU = 0;
                $similarityMenu = 0;

                // variable akses_jalan
                $averageAksesJalanUn = 0;
                $averageAksesJalanU = 0;
                $sigmaAksesJalan = 0;
                $sigmaAksesJalanUn = 0;
                $sigmaAksesJalanU = 0;
                $similarityAksesJalan = 0;

                // variable musholla
                $averageMushollaUn = 0;
                $averageMushollaU = 0;
                $sigmaMusholla = 0;
                $sigmaMushollaUn = 0;
                $sigmaMushollaU = 0;
                $similarityMusholla = 0;

                // variable overall
                $averageOverallUn = 0;
                $averageOverallU = 0;
                $sigmaOverall = 0;
                $sigmaOverallUn = 0;
                $sigmaOverallU = 0;
                $similarityOverall = 0;

                $total = 0;
                $averageSimilarity = [];

                foreach ($getURatings as $getURating) {
                    foreach ($getUnRatings as $key => $getUnRating) {
                        // tempat_parkir
                        $averageTempatParkirUn += $getUnRating->tempat_parkir;
                        $averageTempatParkirU += $getURating[$key]['tempat_parkir'];

                        // harga
                        $averageHargaUn += $getUnRating->harga;
                        $averageHargaU += $getURating[$key]['harga'];

                        // pegawai
                        $averagePegawaiUn += $getUnRating->pegawai;
                        $averagePegawaiU += $getURating[$key]['pegawai'];

                        // menu
                        $averageMenuUn += $getUnRating->menu;
                        $averageMenuU += $getURating[$key]['menu'];

                        // akses_jalan
                        $averageAksesJalanUn += $getUnRating->akses_jalan;
                        $averageAksesJalanU += $getURating[$key]['akses_jalan'];

                        // musholla
                        $averageMushollaUn += $getUnRating->musholla;
                        $averageMushollaU += $getURating[$key]['musholla'];

                        // overall
                        $averageOverallUn += $getUnRating->overall;
                        $averageOverallU += $getURating[$key]['overall'];
                    }
                    foreach ($getUnRatings as $key => $getUnRating) {
                        // sigma 3 bagian tempat_parkir
                        $sigmaTempatParkir += (($getUnRating->tempat_parkir - ($averageTempatParkirUn / 10)) * ($getURating[$key]['tempat_parkir'] - ($averageTempatParkirU / 10)));
                        $sigmaTempatParkirUn += pow(($getUnRating->tempat_parkir - ($averageTempatParkirUn / 10)), 2);
                        $sigmaTempatParkirU += pow(($getURating[$key]['tempat_parkir'] - ($averageTempatParkirU / 10)), 2);

                        // sigma 3 bagian harga
                        $sigmaHarga += (($getUnRating->harga - ($averageHargaUn / 10)) * ($getURating[$key]['harga'] - ($averageHargaU / 10)));
                        $sigmaHargaUn += pow(($getUnRating->harga - ($averageHargaUn / 10)), 2);
                        $sigmaHargaU += pow(($getURating[$key]['harga'] - ($averageHargaU / 10)), 2);

                        // sigma 3 bagian pegawai
                        $sigmaPegawai += (($getUnRating->pegawai - ($averagePegawaiUn / 10)) * ($getURating[$key]['pegawai'] - ($averagePegawaiU / 10)));
                        $sigmaPegawaiUn += pow(($getUnRating->pegawai - ($averagePegawaiUn / 10)), 2);
                        $sigmaPegawaiU += pow(($getURating[$key]['pegawai'] - ($averagePegawaiU / 10)), 2);

                        // sigma 3 bagian manu
                        $sigmaMenu += (($getUnRating->manu - ($averageMenuUn / 10)) * ($getURating[$key]['manu'] - ($averageMenuU / 10)));
                        $sigmaMenuUn += pow(($getUnRating->manu - ($averageMenuUn / 10)), 2);
                        $sigmaMenuU += pow(($getURating[$key]['manu'] - ($averageMenuU / 10)), 2);

                        // sigma 3 bagian akses_jalan
                        $sigmaAksesJalan += (($getUnRating->akses_jalan - ($averageAksesJalanUn / 10)) * ($getURating[$key]['akses_jalan'] - ($averageAksesJalanU / 10)));
                        $sigmaAksesJalanUn += pow(($getUnRating->akses_jalan - ($averageAksesJalanUn / 10)), 2);
                        $sigmaAksesJalanU += pow(($getURating[$key]['akses_jalan'] - ($averageAksesJalanU / 10)), 2);

                        // sigma 3 bagian musholla
                        $sigmaMusholla += (($getUnRating->musholla - ($averageMushollaUn / 10)) * ($getURating[$key]['musholla'] - ($averageMushollaU / 10)));
                        $sigmaMushollaUn += pow(($getUnRating->musholla - ($averageMushollaUn / 10)), 2);
                        $sigmaMushollaU += pow(($getURating[$key]['musholla'] - ($averageMushollaU / 10)), 2);

                        // sigma 3 bagian overall
                        $sigmaOverall += (($getUnRating->overall - ($averageOverallUn / 10)) * ($getURating[$key]['overall'] - ($averageOverallU / 10)));
                        $sigmaOverallUn += pow(($getUnRating->overall - ($averageOverallUn / 10)), 2);
                        $sigmaOverallU += pow(($getURating[$key]['overall'] - ($averageOverallU / 10)), 2);
                    }
                    // similarity tempat_parkir
                    try {
                        $similarityTempatParkir = $sigmaTempatParkir / ((sqrt($sigmaTempatParkirUn)) * (sqrt($sigmaTempatParkirU)));
                    } catch (\Throwable $th) {
                        $similarityTempatParkir = 0;
                    }

                    // similarity harga
                    try {
                        $similarityHarga = $sigmaHarga / ((sqrt($sigmaHargaUn)) * (sqrt($sigmaHargaU)));
                    } catch (\Throwable $th) {
                        $similarityHarga = 0;
                    }

                    // similarity pegawai
                    try {
                        $similarityPegawai = $sigmaPegawai / ((sqrt($sigmaPegawaiUn)) * (sqrt($sigmaPegawaiU)));
                    } catch (\Throwable $th) {
                        $similarityPegawai = 0;
                    }

                    // similarity menu
                    try {
                        $similarityMenu = $sigmaMenu / ((sqrt($sigmaMenuUn)) * (sqrt($sigmaMenuU)));
                    } catch (\Throwable $th) {
                        $similarityMenu = 0;
                    }

                    // similarity akses_jalan
                    try {
                        $similarityAksesJalan = $sigmaAksesJalan / ((sqrt($sigmaAksesJalanUn)) * (sqrt($sigmaAksesJalanU)));
                    } catch (\Throwable $th) {
                        $similarityAksesJalan = 0;
                    }

                    // similarity musholla
                    try {
                        $similarityMusholla = $sigmaMusholla / ((sqrt($sigmaMushollaUn)) * (sqrt($sigmaMushollaU)));
                    } catch (\Throwable $th) {
                        $similarityMusholla = 0;
                    }

                    // similarity overall
                    try {
                        $similarityOverall = $sigmaOverall / ((sqrt($sigmaOverallUn)) * (sqrt($sigmaOverallU)));
                    } catch (\Throwable $th) {
                        $similarityOverall = 0;
                    }
                    // echo 'ID ' . $getURating[0]['user_id'] .' = '. $similarityOverall . '<br>';

                    $total = $similarityTempatParkir +
                        $similarityPegawai +
                        $similarityHarga +
                        $similarityMenu +
                        $similarityAksesJalan +
                        $similarityMusholla +
                        $similarityOverall;

                    $arr = [
                        'avgSim' => ((1 * $total) / (7 + 1)),
                        'user_id' => $getURating[0]['user_id']
                    ];
                    array_push($averageSimilarity, $arr);

                    // reset tempat_parkir
                    $averageTempatParkirUn = 0;
                    $averageTempatParkirU = 0;
                    $sigmaTempatParkir = 0;
                    $sigmaTempatParkirUn = 0;
                    $sigmaTempatParkirU = 0;

                    // reset harga
                    $averageHargaUn = 0;
                    $averageHargaU = 0;
                    $sigmaHarga = 0;
                    $sigmaHargaUn = 0;
                    $sigmaHargaU = 0;

                    // reset pegawai
                    $averagePegawaiUn = 0;
                    $averagePegawaiU = 0;
                    $sigmaPegawai = 0;
                    $sigmaPegawaiUn = 0;
                    $sigmaPegawaiU = 0;

                    // reset menu
                    $averageMenuUn = 0;
                    $averageMenuU = 0;
                    $sigmaMenu = 0;
                    $sigmaMenuUn = 0;
                    $sigmaMenuU = 0;

                    // reset akses_jalan
                    $averageAksesJalanUn = 0;
                    $averageAksesJalanU = 0;
                    $sigmaAksesJalan = 0;
                    $sigmaAksesJalanUn = 0;
                    $sigmaAksesJalanU = 0;

                    // reset musholla
                    $averageMushollaUn = 0;
                    $averageMushollaU = 0;
                    $sigmaMusholla = 0;
                    $sigmaMushollaUn = 0;
                    $sigmaMushollaU = 0;

                    // reset overall
                    $averageOverallUn = 0;
                    $averageOverallU = 0;
                    $sigmaOverall = 0;
                    $sigmaOverallUn = 0;
                    $sigmaOverallU = 0;
                }

                // mencari similarity paling besar
                $biggestEquation = 0;
                $rankOne = [];
                foreach ($averageSimilarity as $avgSim) {
                    if ($biggestEquation < $avgSim['avgSim']) {
                        $biggestEquation = $avgSim['avgSim'];
                        array_push($rankOne, $avgSim['avgSim'], $avgSim['user_id']);
                    }
                }

                // mencari user yang sudah ditemukan kesamaannya paling besar dan mengganti rating 0 pada user N dengan user yang sudah terpilih
                $getUserBiggestSimilarity = Rating::whereUserId($rankOne[1])->get();

                for ($i = 0; $i < count($getUnRatings); $i++) {
                    $ua = $getUserBiggestSimilarity->where('residence_id', $getUnRatings[$i]->residence_id)->first();

                    if ($getUnRatings[$i]->tempat_parkir == 0)
                        $getUnRatings[$i]->tempat_parkir = $ua->tempat_parkir;

                    if ($getUnRatings[$i]->harga == 0)
                        $getUnRatings[$i]->harga = $ua->harga;

                    if ($getUnRatings[$i]->pegawai == 0)
                        $getUnRatings[$i]->pegawai = $ua->pegawai;

                    if ($getUnRatings[$i]->menu == 0)
                        $getUnRatings[$i]->menu = $ua->menu;

                    if ($getUnRatings[$i]->akses_jalan == 0)
                        $getUnRatings[$i]->akses_jalan = $ua->akses_jalan;

                    if ($getUnRatings[$i]->musholla == 0)
                        $getUnRatings[$i]->musholla = $ua->musholla;

                    if ($getUnRatings[$i]->overall == 0)
                        $getUnRatings[$i]->overall = $ua->overall;
                }

                $recommendations = $getUnRatings->sortBy([
                    ['overall', 'desc']
                ])->take(5);
            }
        }
        return view('main.main', compact('tempatKuliners', 'recommendations', 'jumlahTerRating'));
    }

    public function store(Request $request, $tempat_kuliner_id)
    {
        $checkRatingUser = Rating::whereUserId(Auth::user()->id)->whereTempatKulinerId($tempat_kuliner_id)->get();
        if (count($checkRatingUser) == 0) {

            for ($index = 1; $index <= 10; $index++) {
                if ($index == $tempat_kuliner_id) {
                    Rating::create([
                        'user_id' => Auth::user()->id,
                        'tempat_kuliner_id' => $tempat_kuliner_id,
                        'tempat_parkir' => $request->tempat_parkir,
                        'harga' => $request->harga,
                        'pegawai' => $request->pegawai,
                        'menu' => $request->menu,
                        'akses_jalan' => $request->akses_jalan,
                        'mushola' => $request->musholla,
                        'overall' => $request->overall,
                    ]);
                } else {
                    Rating::create([
                        'user_id' => Auth::user()->id,
                        'tempat_kuliner_id' => $index,
                        'tempat_parkir' => '0',
                        'harga' => '0',
                        'pegawai' => '0',
                        'menu' => '0',
                        'akses_jalan' => '0',
                        'mushola' => '0',
                        'overall' => '0',
                    ]);
                }
            }
            // Rating::create([
            //     'user_id' => Auth::user()->id,
            //     'tempat_kuliner_id' => $tempat_kuliner_id,
            //     'tempat_parkir' => $request->tempat_parkir,
            //     'harga' => $request->harga,
            //     'pegawai' => $request->pegawai,
            //     'menu' => $request->menu,
            //     'akses_jalan' => $request->akses_jalan,
            //     'mushola' => $request->musholla,
            //     'overall' => $request->overall,
            // ]);
        } else {
            Rating::whereUserId(Auth::user()->id)->whereTempatKulinerId($tempat_kuliner_id)->update([
                'user_id' => Auth::user()->id,
                'tempat_kuliner_id' => $tempat_kuliner_id,
                'tempat_parkir' => $request->tempat_parkir,
                'harga' => $request->harga,
                'pegawai' => $request->pegawai,
                'menu' => $request->menu,
                'akses_jalan' => $request->akses_jalan,
                'mushola' => $request->musholla,
                'overall' => $request->overall,
            ]);
        }

        return redirect()->back();
    }

    public function ratingView()
    {
        $rating = Rating::where([['user_id', auth()->user()->id], ['overall', '!=', 0]])->with('tempatKuliner')->get();
        $jumlahTerRating = count($rating);
        $tempatKuliners = TempatKuliner::with(['ratings' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])->get();
        return view('main.rating', compact('tempatKuliners', 'jumlahTerRating', 'rating'));
    }

    // public function tempatKuliner($id)
    // {
    //     $tempatKuliner = TempatKuliner::whereId($id)->get();

    //     return Inertia::render('tempatKuliner', [
    //         'tempatKuliner' => $tempatKuliner[0],
    //     ]);
    // }
}
