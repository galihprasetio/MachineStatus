<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Machine;
use DB;

class AreaController extends Controller
{
    //
    public function getBead()
    {
        $bead = DB::Select('SELECT id,id,machine_number FROM machine WHERE area = "Bead" order by machine_number');
        return view('area.bead',compact('bead'));
    }
    public function getCalendering()
    {
        $calendering = DB::Select('SELECT id,machine_number FROM machine WHERE area = "CALENDERING" order by machine_number');
        return view('area.calendering',compact('calendering'));
    }
    public function getCutting()
    {
        $cutting = DB::Select('SELECT id,machine_number FROM machine WHERE area = "CUTTING" order by machine_number');
        return view('area.cutting',compact('cutting'));
    }
    
    public function getMixing()
    {
        $mixing = DB::Select('SELECT id,machine_number FROM machine WHERE area = "Mixing" order by machine_number');
        return view('area.mixing',compact('mixing'));
    }
    public function getExtruding()
    {
        $extruding = DB::Select('SELECT id,machine_number FROM machine WHERE area = "Extruding" order by machine_number');
        return view('area.extruding',compact('extruding'));
    }
    public function getInspection()
    {
        $inspection = DB::Select('SELECT id,machine_number FROM machine WHERE area = "Inspection" order by machine_number');
        return view('area.inspection',compact('inspection'));
    }
    public function getOtherMC()
    {
        $othermc = DB::Select('SELECT id,machine_number FROM machine WHERE area = "Other M/C" order by machine_number');
        return view('area.othermc',compact('othermc'));
    }
    public function getOtherNonMC()
    {
        $othernonmc = DB::Select('SELECT id,machine_number FROM machine WHERE area = "Other Non-M/C" order by machine_number');
        return view('area.othernonmc',compact('othernonmc'));
    }
    public function getBuffing()
    {
        $buffing = DB::Select('SELECT id,machine_number FROM machine WHERE area = "BUFFING" order by machine_number');
        return view('area.buffing',compact('buffing'));
    }
    public function getBuilding()
    {
        $building = DB::Select('SELECT id,machine_number FROM machine WHERE area = "Building" order by machine_number');
        return view('area.building',compact('building'));
    }
    public function getCuring()
    {
        $curing = DB::Select('SELECT id,machine_number FROM machine WHERE area = "Curing" order by machine_number');
        return view('area.curing',compact('curing'));
    }
    public function getNMPRoom()
    {
        $nmproom = DB::Select('SELECT id,machine_number FROM machine WHERE area = "NMP Room" order by machine_number');
        return view('area.nmproom',compact('nmproom'));
    }
    
}
