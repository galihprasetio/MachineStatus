<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Assets;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class AssetsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Assets([
            'asset_old' => $row[0],
            'asset_new' => $row[1],
            'status' => $row[2],
            'serial_number' => $row[3],
            'team' => $row[4],
            'location' => $row[5],
            'flag' => 'Original',
            'created_by' => Auth::user()->name,            
            ]);
    }
}
