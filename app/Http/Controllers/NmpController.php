<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\Machine;
use Illuminate\Support\Facades\Auth;
use App\DeviceHistory;
use Carbon\Carbon;
use App\Exports\NmpExport;
use Maatwebsite\Excel\Facades\Excel;

class NmpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $machine = Machine::pluck('machine_number','id');
        //$printer = Device::where('device_type','Printer')->get();
        $nmp = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.area','device.id_machine','machine.machine_number','device.model_type','device.device_status','device.remark','device.updated_by','device.updated_at')
        ->where('device.device_type','NMP')
        ->orWhere('device.device_type','NMP Room')
        ->get();
        return view('nmp.index',compact('nmp','machine'));
    }
    public function nmpExportExcel()
    {
        return Excel::download(new NmpExport,'nmp.xlsx');
    }
    public function broken()
    {
        $nmp = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.area','device.id_machine','machine.machine_number','device.model_type','device.device_status','device.remark','device.updated_by','device.updated_at')
        ->where('device.device_type','NMP')
        ->where('device.device_status','<>','OK')
        ->orWhere('device.device_type','NMP Room')
        ->get();
        return view('nmp.broken',compact('nmp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $nmp = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.machine_number','device.model_type','device.device_status','device.remark')
        ->where('device.id',$id)
        ->first();
        $machine = Machine::pluck('machine_number','id');
        $model_type = DB::select('SELECT a.model_type FROM (
            select model_type from detail_type where device_type="NMP" 
            group by model_type
            UNION all
            SELECT model_type FROM device WHERE device_type ="NMP" and (model_type IS NOT NULL )
            
             GROUP BY model_type) a GROUP BY a.model_type ORDER BY a.model_type desc');
        //$device = DB::select('select machine_number,machine_number from machine');
        return view('nmp.edit',compact('nmp','machine','model_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'device_status' => 'required'
        ]);
        $nmp = Device::find($id);
        $nmp->model_type = $request->model_type;
        $nmp->device_status = $request->device_status;
        $nmp->remark = $request->remark;
        $nmp->updated_by = Auth::user()->name;
        $nmp->save();
                
        DB::table('device_history')->insert([
            'id_device' => $id,
            'id_machine' => $nmp->id_machine,
            'action_by' => Auth::user()->name,
            'remark' => '[ Updated Status Device '.$request->device_status.' ] - '.$request->remark,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('nmp.index')->with(['success' =>'Data has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
