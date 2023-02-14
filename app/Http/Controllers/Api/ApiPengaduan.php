<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PengaduanRes;
use App\Models\Pengaduan;
class ApiPengaduan extends Controller
{
    public function index()
    {
        $pengaduan = Pengaduan::get();
        $pengaduanCol = PengaduanRes::collection($pengaduan);
        return response()->json([
            'message' => 'laporan berhasil',
            'data'=> $pengaduanCol
        ]);

    }

    public function tambahLaporan()
    {
        // $tanggal_pegaduan = request() -> tanggal_pegaduan;
        $nik = auth('sanctum')->user()->nik;    
        $isi_laporan = request() -> isi_laporan;
        $status = request() -> status;
        $foto = request() -> foto;
        $path="foto";
        $filename = time().".png";
        $foto->move($path,$filename);

        $data = [
            // 'tanggal_pegaduan' => $tanggal_pegaduan,
            'nik' => $nik,
            'isi_laporan' => $isi_laporan,
            'status'=> $status,
            'foto' => $filename,
        ];
        Pengaduan::insert($data);
        // Pengaduan::insert($data);

        return response()->json([
            "message"=> "Data telah ditambahkan"
            
        ]);

    }
}
