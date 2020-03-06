<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BrokenExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $broken = collect(DB::select('SELECT mac.area, mac.machine_number, dev.device_type AS device ,dev.model_type, dev.detail_type, dev.device_status, dev.remark
        ,dev.updated_at AS lates_update
         FROM 
        device dev
        LEFT JOIN machine mac
        ON dev.id_machine = mac.id
        WHERE dev.device_status = "Not Installed" OR dev.device_status = "Not OK"
        ORDER BY mac.area asc'));
        return $broken;
    }
    public function headings(): array
    {
        return [
            'Area',
            'Machine Number',
            'Device',
            'Model',
            'Type',
            'Status',
            'Remark',
            'Lates Update',

        // etc


        ];
    }
}
