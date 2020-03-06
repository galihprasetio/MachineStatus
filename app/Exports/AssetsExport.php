<?php

namespace App\Exports;

use App\Assets;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;

class AssetsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        
        return collect(DB::Select('select asset_old, asset_new, status, serial_number, team, location, user, label, ad_join, drm, antivirus, hw, power, remarks 
        from assets where flag = "Patrol" and deleted_at IS null'));
    }
}
