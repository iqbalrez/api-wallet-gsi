<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function download($id):StreamedResponse|JsonResponse {
        $filePath = "reports/{$id}.xlsx";

        if(!Storage::disk('public')->exists($filePath)) { 
           return response()->json([
                'status'  => 404,
                'error'   => true,
                'message' => 'Laporan belum siap atau sedang dalam antrean proses. Silakan coba lagi dalam beberapa saat.',
            ], 404);
        }

        return Storage::disk('public')->download($filePath, "report-{$id}.xlsx");
    }
}
