<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\KetersediaanHarian;
use Throwable;

class KetersediaanHarianController extends Controller
{
    use ApiResponse;

    public function index()
    {
        try {
            $ketersediaan_harian = KetersediaanHarian::select(
                'komoditas_id',
                'tanggal',
                'ketersediaan_harian',
                'kebutuhan_harian',
                'neraca_harian',
                'user_id',
            )->get();

            return $this->success($ketersediaan_harian, 'Ketersediaan Harian fetched successfully');
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'komoditas_id' => 'required|exists:komoditas,id',

            'items' => 'required|array|min:1',

            'items.*.ketersediaan_harian'=> 'required|integer|min:0',
            'items.*.kebutuhan_harian'=> 'required|integer|min:0',
            'items.*.neraca_harian'=> 'required|integer',
            'items.*.tanggal' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($request, $validated) {
                foreach ($validated['items'] as $item) {
                    KetersediaanHarian::updateOrCreate(
                    [
                        'komoditas_id'=> $validated['komoditas_id'],
                        'tanggal' => $item['tanggal'],
                    ],
                    [                        
                        'user_id'=> $request->user()->id,

                        'ketersediaan_harian' => $item['ketersediaan_harian'],
                        'kebutuhan_harian' => $item['kebutuhan_harian'],
                        'neraca_harian' => $item['neraca_harian'],
                    ]);
                }
            });

            return $this->success(null, 'Ketersediaan Harian created sucessfully', 201);
        } catch (Throwable $e) {
            return $this->error($e->getMessage());
        }
    }
}
