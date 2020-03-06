<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Device;
use App\Machine;
use App\DeviceHistory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DeviceController extends Controller
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
        $device = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        ->select('device.id','device.id_machine','machine.machine_number','device.device_type','device.model_type','device.detail_type','device.device_status','device.remark','device.updated_by','device.updated_at')
        ->where('machine.area','NMP Room')->get();
        return view('nmproom.index',compact('device','machine'));
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
        $model_type = DB::select('SELECT a.model_type,a.device_type FROM (
            select model_type,device_type from detail_type group by model_type,device_type
            UNION all
            SELECT model_type,device_type FROM device WHERE model_type IS NOT NULL or device_type IS NOT NULL
             GROUP BY model_type,device_type) a GROUP BY a.model_type,a.device_type ORDER BY a.model_type desc');
        $detail_type = DB::select('SELECT a.model_type,a.detail_type FROM (
            select model_type,detail_type from detail_type group by model_type,detail_type
            UNION
            SELECT model_type,detail_type FROM device where model_type is not null or detail_type is not null GROUP BY model_type,detail_type) a
            GROUP BY a.model_type, a.detail_type ORDER BY a.detail_type desc');
        return view('nmproom.create',compact('machine','model_type','detail_type'));
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
            
            'device_status' => 'required',
            'device_type' => 'required',
        ]);
        Device::create([
            'id_machine' => 234,
            'device_type' =>$request->device_type,
            'model_type' => $request->model_type,
            'detail_type' => $request->detail_type,
            'device_status' => $request->device_status,
            'remark' => $request->remark,
            'updated_by' => Auth::user()->name,
        ]);
        return redirect()->route('device.index')->with(['success' =>'Data has been saved']);
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
        $machine = Machine::find($id);
        // $device = DB::table('device')->join('machine','device.id_machine','=','machine.id')
        // ->select('device.device_type','device.model_type','device.detail_type','device.device_status','device.remark')
        // ->where('machine.id',$id)->get();
        $device = DB::select('SELECT device_type, model_type, detail_type, remark, device_status
        FROM device 
        WHERE id_machine = '.$id.'
        UNION all
        SELECT device_type,"" AS model_type, "" AS detail_type, "" AS remark,"Not Installed" AS device_status  FROM (
        SELECT device_type
        FROM device 
        WHERE 
        device_type not IN (SELECT DISTINCT(device_type) FROM device WHERE id_machine = '.$id.')) a
        GROUP BY a.device_type');
        $historyDevice = DB::table('device_history')->join('device','device_history.id_device','=','device.id')
        ->select('device.device_type','device_history.action_by','device_history.remark','device_history.created_at')
        ->where('device_history.id_machine',$id)->orderby('device_history.created_at','desc')->get();
        return view('nmproom.machine',compact('machine','device','historyDevice'));
        
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
        $device = Device::find($id);
        $machine = Machine::pluck('machine_number','id');
        $model_type = DB::select('SELECT a.model_type,a.device_type FROM (
            select model_type,device_type from detail_type group by model_type,device_type
            UNION all
            SELECT model_type,device_type FROM device WHERE model_type IS NOT NULL or device_type IS NOT NULL
             GROUP BY model_type,device_type) a GROUP BY a.model_type,a.device_type ORDER BY a.model_type desc');
        $detail_type = DB::select('SELECT a.model_type,a.detail_type FROM (
            select model_type,detail_type from detail_type group by model_type,detail_type
            UNION
            SELECT model_type,detail_type FROM device where model_type is not null or detail_type is not null GROUP BY model_type,detail_type) a
            GROUP BY a.model_type, a.detail_type ORDER BY a.detail_type desc');
        return view('nmproom.edit',compact('device','machine','model_type','detail_type'));
    
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
        DB::table('device')->where('id',$id)
        ->update([
            'device_type' => $request->device_type,
            'model_type' => $request->model_type,
            'detail_type' => $request->detail_type,
            'device_status' => $request->device_status,
            'remark' => $request->remark
        ]);
        return redirect()->route('device.index')->with(['success' => 'Data has been updated']);
    }

    public function updateTransfer(Request $request)
    {
        $id_machine = DB::table('device')->where('id',$request->id)->first();
        $machine_number_before = DB::table('machine')->where('id',$id_machine->id_machine)->first();
        $machine_number_after = DB::table('machine')->where('id',$request->machine_number)->first();
        $machine_number = DB::table('machine')->select('machine_number')->where('id',$id_machine->id_machine)->first();

        if ($request->machine_number == 234) {
            # code...
            DB::table('device')->where('id',$request->id)
            ->update([
            'id_machine' => $request->machine_number,
            'remark' =>$request->remark,
            'device_status' => 'Not Installed',
            'updated_by' => Auth::user()->name,
            'updated_at' => Carbon::now()
        ]);
        }else{
            DB::table('device')->where('id',$request->id)
            ->update([
            'id_machine' => $request->machine_number,
            'device_status' => 'OK',
            'remark' =>$request->remark,
            'updated_by' => Auth::user()->name,
            'updated_at' => Carbon::now()
        ]);
        }
        
        DB::table('device_history')->insert([
            'id_device' => $request->id,
            'id_machine' => $id_machine->id_machine,
            'action_by' => Auth::user()->name,
            'remark' => '[ '.$machine_number_before->machine_number.' Moving to '.$machine_number_after->machine_number.' ] - '.$request->remark,
            'created_at' => Carbon::now()
        ]);
        DB::table('device_history')->insert([
            'id_device' => $request->id,
            'id_machine' => $request->machine_number,
            'action_by' => Auth::user()->name,
            'remark' => '[ '.$machine_number_before->machine_number.' Moving to '.$machine_number_after->machine_number.' ] - '.$request->remark,
            'created_at' => Carbon::now()
        ]);
        return response()->json(['success' => 'Data has been transfered']);
        
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
