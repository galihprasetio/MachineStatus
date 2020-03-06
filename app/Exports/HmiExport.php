<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
class HmiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $hmi = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('machine.area','machine.machine_number','device.model_type','device.device_status','device.monitor','device.device_status_monitor','device.remark')
        ->where('device.device_type','HMI')
        ->get();
        return $hmi;
    }
    public function headings(): array
    {
        return [
            'Area',
            'Machine Number',
            'Model Type',
            'Device Status',
            'Monitor',
            'Status Monitor',
            'Remarks',
            // etc
        ];
    }
}
