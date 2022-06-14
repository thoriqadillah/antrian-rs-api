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
    public function getAntrian(Request $request) {
        $jumlahPolis = Poli::count();
        for($i = 1; $i <= $jumlahPolis; $i++)
        {
            $nomor[] = Antrian::select('nomor')
            ->where('tanggal', Carbon::now()->format('Y-m-d'))
            ->where('status', 0)
            ->where('poli_id', $i)
            ->orderBy('nomor', 'asc')
            ->first();
            if(!$nomor) {
                $nomor[] = Antrian::select('nomor')
                ->where('tanggal', Carbon::now()->format('Y-m-d'))
                ->where('status', 1)
                ->where('poli_id', $i)
                ->orderBy('nomor', 'desc')
                ->first();
            }
        }
        $data['polis'] = Poli::select('nama_poli')->get();
        $data['nomor'] = $nomor;

        return response()->json([
            'success' => true,
            'message' => 'Berhasil Get Data',
            'data'    => $data
        ], 200);
    }

    public function getAntrianUser(Request $request) {
        // Check if user or not
        $this->middleware('auth:api');

        $antrian_user = Antrian::where([
            ['user_id', '=', Auth::id()],
            ['status', '=', 0],
            ['tanggal', Carbon::now()->format('Y-m-d')]
        ])->first();
        
        $arr = ['A', 'B', 'C'];
        $data = [];
        if($antrian_user)
        {
            $data['nomor'] = $antrian_user->nomor;
            $data['loket'] = $arr[$antrian_user->poli_id - 1];
        }
        return response()->json([
            'success' => true,
            'message' => 'Berhasil Get Data User',
            'data'    => $data
        ], 200);
    }

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
            ], 201);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 409);
        }

    }

    public function updateAntrian(Request $request) {
        try {
            // Check if user or not
            $this->middleware('auth:api');

            $date = Carbon::now()->toDateTimeString();
            $now = substr($date, 0, 10);

            $loket = Antrian::select()
                ->where('tanggal', $now)
                ->where('status', 0)
                ->where('poli_id', $request->poli_id)
                ->first();

            $loket->status = 1;
            $loket->save();

            $nomor = Antrian::select('nomor')
            ->where('tanggal', $now)
            ->where('status', 0)
            ->where('poli_id', $request->poli_id)
            ->first();

            return response()->json([
                'success' => true,
                'message' => 'Data Berubah',
                'data' => $nomor->nomor,
            ], 200);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Antrian Habis',
            ], 409);
        }
    }

    public function deleteAntrian(Request $request) {
        // Check if user or not
        $this->middleware('auth:api');

        $antrian_user = Antrian::where([
            ['user_id', '=', Auth::id()],
            ['status', '=', 0],
            ['tanggal', Carbon::now()->format('Y-m-d')]
        ])->first()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data User Dihapus',
        ], 200);
    }
}
