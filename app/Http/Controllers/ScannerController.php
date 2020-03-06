<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\Machine;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Exports\ScannerExport;
use Maatwebsite\Excel\Facades\Excel;

class ScannerController extends Controller
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
        //$Scanner = Device::where('device_type','Scanner')->get();
        $scanner = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.area','device.id_machine','machine.machine_number','device.model_type','device.detail_type','device.device_status','device.remark','device.updated_by','device.updated_at')
        ->where('device.device_type','Scanner')
        ->orWhere('device.device_type','NMP Room')
        ->get();
        return view('scanner.index',compact('scanner','machine'));
    }
    public function scannerExportExcel()
    {
        return Excel::download(new ScannerExport,'scanner.xlsx');
    }
    public function broken()
    {
        $scanner = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.area','device.id_machine','machine.machine_number','device.model_type','device.device_status','device.remark','device.updated_by','device.updated_at')
        ->where('device.device_type','Scanner')
        ->where('device.device_status','<>','OK')
        ->orWhere('device.device_type','NMP Room')
        ->get();
        return view('scanner.broken',compact('scanner'));
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
        return view('scanner.create',compact('machine'));

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
            'device_type' =>'Scanner',
            'model_type' => $request->model_type,
            'device_status' => $request->device_status,
            'remark' => $request->remark,
            'updated_by' => Auth::user()->name,
        ]);
        return redirect()->route('scanner.index')->with(['success' =>'Data has been saved']);
       
       
        // DB::beginTransaction();
        // try {
        //     //code...
           
        //     DB::commit();
        // } catch (\Throwable $th) {
        //     throw $th;
        //     DB::rollback();
        // }
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
        //$Scanner = Device::find($id);
        $scanner = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.machine_number','device.model_type','device.device_status','device.remark','device.updated_at')
        ->where('device.id',$id)->first();
        return view('scanner.show',compact('scanner'));
        
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
        //$scanner = Device::find($id);
        $scanner = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','machine.machine_number','device.model_type','device.detail_type','device.device_status','device.remark')
        ->where('device.id',$id)
        ->first();
        $type = DB::table('detail_type')->get();
        $machine = Machine::pluck('machine_number','id');
        //$device = DB::select('select machine_number,machine_number from machine');
        return view('scanner.edit',compact('scanner','machine','type'));
        
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
        $scanner = Device::find($id);
        //$scanner->id_machine = $request->machine_number;
        $scanner->model_type = $request->model_type;
        $scanner->device_status = $request->device_status;
        $scanner->detail_type = $request->detail_type;
        $scanner->remark = $request->remark;
        $scanner->updated_by = Auth::user()->name;
        $scanner->save();
        DB::table('device_history')->insert([
            'id_device' => $id,
            'id_machine' => $scanner->id_machine,
            'action_by' => Auth::user()->name,
            'remark' => '[ Updated Status Device '.$request->device_status.' ] - '.$request->remark,
            'created_at' => Carbon::now()
        ]);
        return redirect()->route('scanner.index')->with(['success' =>'Data has been updated']);
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
        $scanner = Device::find($id);
        $scanner->delete();
        return redirect()->route('scanner.index')->with(['success' => 'Data has been deleted']);
    }
}
