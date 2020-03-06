<?php

namespace App\Exports;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DeviceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $device = collect(DB::Select('SELECT mac.machine_number, 
        MAX((case when dev.device_type = "Printer" then dev.model_type ELSE "" END )) AS Printer,
        MAX((case when dev.device_type = "Scanner" then dev.model_type ELSE "" END )) AS Scanner,
        MAX((case when dev.device_type = "HMI" then dev.model_type ELSE "" END )) AS HMI,
        MAX((case when dev.device_type = "NMP" then dev.model_type ELSE "" END )) AS NMP
        FROM device dev
        LEFT JOIN machine mac
        ON dev.id_machine = mac.id
        GROUP BY mac.machine_number ORDER BY mac.machine_number asc'));
        return $device;
    }
    public function headings(): array
    {
        return [
            'Machine Numbers',
            'Printer',
            'Scanner',
            'HMI',
            'NMP',

        // etc


        ];
    }
}
