<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class ScannerExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $scanner = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('machine.area','machine.machine_number','device.model_type','device.detail_type','device.device_status','device.remark')
        ->where('device.device_type','Scanner')
        ->get();
        return $scanner;
    }
    public function headings(): array
    {
        return [
            'Area',
            'Machine Number',
            'Model Type',
            'Detail Type',
            'Device Status',
            'Remarks',
            // etc


        ];
    }
}
