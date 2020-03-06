<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\Machine;
use Illuminate\Support\Facades\Auth;
use App\DeviceHistory;
use Carbon\Carbon;
use App\Exports\PrinterExport;
use Maatwebsite\Excel\Facades\Excel;


class PrinterController extends Controller
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
        $printer = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.area','device.id_machine','machine.machine_number','device.model_type','device.device_status','device.remark','device.updated_by','device.updated_at')
        ->where('device.device_type','Printer')
        ->orWhere('device.device_type','NMP Room')
        ->get();
       
         return view('printer.index',compact('printer','machine'));
        
    
    }
    public function printerExportExcel()
    {
        return Excel::download(new PrinterExport,'printer.xlsx');
    }
    public function broken()
    {
        $printer = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.area','device.id_machine','machine.machine_number','device.model_type','device.device_status','device.remark','device.updated_by','device.updated_at')
        ->where('device.device_type','Printer')
        ->Where('device.device_status','<>','OK')
        ->orWhere('device.device_type','NMP Room')
        ->get();

        return view('printer.broken',compact('printer'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $machine = Machine::pluck('machine_number','id');
        //$device = DB::select('select machine_number,machine_number from machine');
        return view('printer.create',compact('machine'));

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
        $request->validate([
            'machine_number' => 'required',
            'device_status' => 'required',
        ]);
        Device::create([
            'id_machine' => $request->machine_number,
            'device_type' =>'Printer',
            'model_type' => $request->model_type,
            'device_status' => $request->device_status,
            'remark' => $request->remark,
            'updated_by' => Auth::user()->name,
        ]);
        return redirect()->route('printer.index')->with(['success' =>'Data has been saved']);
        
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
        //$printer = Device::find($id);
        $printer = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.machine_number','device.model_type','device.device_status','device.remark','device.updated_at')
        ->where('device.id',$id)->first();
        return view('printer.show',compact('printer'));
        
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
        //$printer = Device::find($id);
        $printer = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.machine_number','device.model_type','device.device_status','device.remark')
        ->where('device.id',$id)
        ->first();
        $machine = Machine::pluck('machine_number','id');
        $model_type = DB::select('SELECT a.model_type FROM (
            select model_type from detail_type where device_type="Printer" 
            group by model_type
            UNION all
            SELECT model_type FROM device WHERE device_type ="Printer" and (model_type IS NOT NULL )
            
             GROUP BY model_type) a GROUP BY a.model_type ORDER BY a.model_type desc');
        //$device = DB::select('select machine_number,machine_number from machine');
        return view('printer.edit',compact('printer','machine','model_type'));
        
        //dd($device);
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
        $printer = Device::find($id);
        $printer->model_type = $request->model_type;
        $printer->device_status = $request->device_status;
        $printer->remark = $request->remark;
        $printer->updated_by = Auth::user()->name;
        $printer->save();
        
        DB::table('device_history')->insert([
            'id_device' => $id,
            'id_machine' => $printer->id_machine,
            'action_by' => Auth::user()->name,
            'remark' => '[ Updated Status Device '.$request->device_status.' ] - '.$request->remark,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('printer.index')->with(['success' =>'Data has been updated']);
           
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
        $printer = Device::find($id);
        $printer->delete();
        return redirect()->route('printer.index')->with(['success' => 'Data has been deleted']);
    }
}
