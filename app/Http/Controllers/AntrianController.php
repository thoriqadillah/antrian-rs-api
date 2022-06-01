<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Antrian;
use App\Models\Poli;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Mockery\Undefined;
use Illuminate\Support\Facades\Validator;

class AntrianController extends Controller
{
    public function insertAntrian(Request $request)
    {
        // Check if user or not
        $this->middleware('auth:api');

        //set validation
        $validator = Validator::make($request->all(), [
            'poli_id'   => 'required',
            'nama' => 'required',
            'tanggal' => 'required',
        ]);
                
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        try {
            $antrian = new Antrian;
            $antrian->poli_id = $request->poli_id;
            $antrian->user_id = Auth::id();
            $antrian->nama = $request->nama;
            $tanggal = explode("-", $request->tanggal);
            $tempTanggal = $tanggal[2] . '-' . $tanggal[1] . '-' . $tanggal[0];
            $antrian->tanggal = $tempTanggal;
            $tempNomor = Antrian::select('nomor')
                ->where('tanggal', $tempTanggal)
                ->where('poli_id', $request->poli_id)
                ->orderBy('nomor', 'desc')
                ->first();
            if (empty($tempNomor)) {
                $antrian->nomor = 1;
            } else {
                $antrian->nomor = $tempNomor['nomor'] + 1;
            }
            $antrian->save();
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Insert',
                'data'    => $antrian
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 409);
        }

    }
}
