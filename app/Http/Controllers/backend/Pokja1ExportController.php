<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class Pokja1ExportController extends Controller
{
    public function exportToSheet(Request $request)
    {
        try {
            // URL Apps Script kamu
            $url = "https://script.google.com/macros/s/AKfycbzTkeEtrbv6b2_vdoetwHKMzY3CxBseQ47fVHAwlOpTyrRVBevwCpKIm7_B6hVOhmCf/exec";

            // Data dari form
            $data = [
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'bidang' => $request->bidang,
                'user' => Auth::user()->name ?? 'Guest',
                'source' => 'Laravel_Pokja1',
                'timestamp' => now()->toDateTimeString(),
                'pokja' => 'POKJA_1'
            ];

            // Kirim ke Apps Script
            $response = Http::withHeaders([
                'Content-Type' => 'text/plain'
            ])->post($url, json_encode($data));

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dikirim ke Google Sheets',
                'response' => $response->body()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}