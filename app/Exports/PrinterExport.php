<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PrinterExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $printer = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('machine.area','machine.machine_number','device.model_type','device.device_status','device.remark')
        ->where('device.device_type','Printer')
        ->get();
        return $printer;
    }
    public function headings(): array
    {
        return [
            'Area',
            'Machine Number',
            'Model Type',
            'Device Status',
            'Remarks',
            // etc


        ];
    }

}
