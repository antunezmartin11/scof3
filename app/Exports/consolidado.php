<?php

namespace App\Exports;

use DB;
use App\Modelos\pago;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class consolidado implements FromView, WithColumnFormatting, ShouldAutoSize
{
    public function __construct($id, $fec1,$fec2){
        $this->id = $id;
        $this->fec1 = $fec1;
        $this->fec2 = $fec2;
    }
    
    public function view(): View
    {
        return view('vendor.adminlte.pages.imprimir.excel', [
            'pago' => DB::select('select p.fechaC, p.pagototal, ts.nombre_aseguradora, (ts.id-1) as codigoCompania, ts.producto from 
            pago p, 
            consulta c, 
            paciente pa, 
            compania_paciente cpa, 
            compania co, 
            tipo_seguro ts
            where c.id=p.consulta_id 
            and pa.id=c.paciente_id 
            and cpa.id_paciente=pa.id 
            and cpa.id_compania=co.id 
            and ts.id=co.tipo_seguro_id 
            and p.fechaC between :fec1 and :fec2 
            and ts.id=:tipoA order by p.fechaC asc',['fec1'=>$this->fec1,'fec2'=>$this->fec2,'tipoA'=>$this->id])
        ]);
    }
    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
