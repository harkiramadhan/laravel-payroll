<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kredit;

class KreditController extends Controller
{
    public $successStatus = 200;
    
    public function index()
    {
        $data = [];
        $dataPegawai = json_decode(file_get_contents("http://kepegawaian.dqakses.id/api/pegawai_kompleks"));
        foreach($dataPegawai as $row){
            $count = Kredit::select(Kredit::raw("sum(replace(total, '.', '')) as jumlah"))
                    ->where('idpegawai', $row->idguru)
                    ->whereMonth('date', date('m'))
                    ->get()->first();

            $content = [
                'idguru' => $row->idguru,
                'nama' => $row->nama,
                'nama_lembaga' => $row->nama_lembaga,
                'total' => $count->jumlah,
            ];
            $data[] = $content;
        }
        return response()->json($data, $this->successStatus);
    }

    public function showAll(){
        $get = Kredit::select(Kredit::raw("sum(replace(total, '.', '')) as jumlah"))
                    ->whereMonth('date', date('m'))
                    ->get()->first();
        $data = [
            'total' => $get->jumlah,
            'bulan' => bulan(date('m'))
        ];
        return response()->json($data, $this->successStatus);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $this->validate($request, [
            'idpegawai' => 'required',
            'total' => 'required' 
        ]);

        $dataInsert = [
            'idpegawai' => $request['idpegawai'],
            'total' => $request['total'],
            'date' => date('Y-m-d')
        ];

        if(Kredit::create($dataInsert)){
            return response()->json(['success' => $dataInsert], $this->successStatus);
        }
    }

    public function show($id)
    {
        $get = Kredit::select(Kredit::raw("sum(replace(total, '.', '')) as jumlah"))
                    ->where('idpegawai', $id)
                    ->whereMonth('date', date('m'))
                    ->get()->first();

        $all = Kredit::where('idpegawai', $id)
                    ->whereMonth('date', date('m'))
                    ->orderBy('date', 'desc')
                    ->get()->all();

        foreach($all as $a){
            $kredits[] = [
                'total' => $a->total,
                'date' => longdate_indo($a->date)
            ];
        }
        $data = [
            'total' => $get->jumlah,
            'kredit' => $kredits,
            'bulan' => bulan(date('m'))
        ];
        return response()->json($data, $this->successStatus);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
