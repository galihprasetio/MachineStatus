<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exports\DeviceExport;
use App\Exports\BrokenExport;
use Maatwebsite\Excel\Facades\Excel;


class DashboardController extends Controller
{
    //
    public function index(Request $request)
    {
        // if(request()->ajax())
        // {
        //     if(!empty($request->from_date))
        //     {
        //         // $data = DB::select('SELECT his.created_at,his.action_by,his.remark AS activity,mac.area,mac.machine_number,dev.device_type,dev.model_type
        //         // FROM device_history his
        //         // LEFT JOIN device dev
        //         // ON his.id_device = dev.id
        //         // LEFT JOIN machine mac
        //         // on his.id_machine = mac.id
        //         // WHERE date(his.created_at) BETWEEN .array($request->from_date). AND .array($request->to_date). order by his.created_at desc ');
        //         $data = DB::table('device_history')
        //         ->join('device','device_history.id_device','=','device.id')
        //         ->join('machine','device_history.id_machine','=','machine.id')
        //         ->select('device_history.created_at','device_history.action_by','device_history.remark','machine.area','machine.machine_number','device.device_type','device.model_type')
        //         ->whereBetween('device_history.created_at',array($request->from_date, $request->to_date))
        //         ->orderby('device_history.created_at','desc')
        //         ->get();
        //     }else
        //     {
        //         // $data = DB::select('SELECT his.created_at,his.action_by,his.remark AS activity,mac.area,mac.machine_number,dev.device_type,dev.model_type
        //         // FROM device_history his
        //         // LEFT JOIN device dev
        //         // ON his.id_device = dev.id
        //         // LEFT JOIN machine mac
        //         // on his.id_machine = mac.id
        //         // WHERE date(his.created_at) BETWEEN date(now()) AND date(now()) order by his.created_at desc ');
        //         $data = DB::table('device_history')
        //         ->join('device','device_history.id_device','=','device.id')
        //         ->join('machine','device_history.id_machine','=','machine.id')
        //         ->select('device_history.created_at','device_history.action_by','device_history.remark','machine.area','machine.machine_number','device.device_type','device.model_type')
        //         ->orderby('device_history.created_at','desc')
        //         ->get();
        //     }
        //     return datatables()->of($data)->make(true);
        // }

        $printer = collect(DB::select('SELECT b.totalDevice AS totalDevice ,b.totalBroken AS totalBroken,100 - ((b.totalBroken / b.totalDevice) * 100)AS percenTage FROM (
        SELECT SUM(a.TotalDevice)AS totalDevice, SUM(a.TotalBroken)AS totalBroken  FROM (SELECT COUNT(*) as TotalDevice, 0 AS TotalBroken FROM device 
        WHERE device_type = "Printer" 
        UNION
        SELECT 0 TotalDevice, COUNT(*)AS TotalBroken FROM device
        WHERE device_type = "Printer" and (device_status = "Not OK" OR device_status = "Not Installed") ) AS a) b'))->first();
       $scanner = collect(DB::select('SELECT b.totalDevice AS totalDevice ,b.totalBroken AS totalBroken,100 - ((b.totalBroken / b.totalDevice) * 100)AS percenTage FROM (
        SELECT SUM(a.TotalDevice)AS totalDevice, SUM(a.TotalBroken)AS totalBroken  FROM (SELECT COUNT(*) as TotalDevice, 0 AS TotalBroken FROM device 
        WHERE device_type = "Scanner" 
        UNION
        SELECT 0 TotalDevice, COUNT(*)AS TotalBroken FROM device
        WHERE device_type = "Scanner" and (device_status = "Not OK" OR device_status = "Not Installed") ) AS a) b'))->first();
       $hmi = collect(DB::select('SELECT b.totalDevice AS totalDevice ,b.totalBroken AS totalBroken,100 - ((b.totalBroken / b.totalDevice) * 100)AS percenTage FROM (
        SELECT SUM(a.TotalDevice)AS totalDevice, SUM(a.TotalBroken)AS totalBroken  FROM (SELECT COUNT(*) as TotalDevice, 0 AS TotalBroken FROM device 
        WHERE device_type = "HMI" 
        UNION
        SELECT 0 TotalDevice, COUNT(*)AS TotalBroken FROM device
        WHERE device_type = "HMI" and (device_status = "Not OK" OR device_status = "Not Installed")) AS a) b'))->first();
        $nmp = collect(DB::select('SELECT b.totalDevice AS totalDevice ,b.totalBroken AS totalBroken,100 - ((b.totalBroken / b.totalDevice) * 100)AS percenTage FROM (
        SELECT SUM(a.TotalDevice)AS totalDevice, SUM(a.TotalBroken)AS totalBroken  FROM (SELECT COUNT(*) as TotalDevice, 0 AS TotalBroken FROM device 
        WHERE device_type = "NMP" 
        UNION
        SELECT 0 TotalDevice, COUNT(*)AS TotalBroken FROM device
        WHERE device_type = "NMP" and (device_status = "Not OK" OR device_status = "Not Installed") ) AS a) b'))->first();
        
        $area = DB::Select('select distinct(area),count(area)as total from machine group by area');

        $activity = DB::select('SELECT machine.machine_number,device.device_type, history.action_by, history.remark, history.created_at 
        FROM device_history history 
        LEFT JOIN device device 
        ON history.id_device = device.id 
        LEFT JOIN machine machine 
        ON history.id_machine = machine.id
        WHERE DATE(history.created_at) = DATE(NOW())
        GROUP BY machine.machine_number,device.device_type,history.action_by,history.remark,history.created_at ORDER BY history.created_at desc');
        
        $model_type = DB::select('SELECT device_type, if(model_type IS NULL, "Unidentified",model_type)AS model_type, COUNT(*) AS total FROM device 
        WHERE 
        device_status = "OK"
        GROUP BY device_type,model_type
        ');
        
        return view('admin.dashboard',compact('area','printer','scanner','hmi','nmp','activity','model_type'));
        
    }
    // public function activity(Request $request)
    // {
    //     if(request()->ajax())
    //     {
    //         if(!empty($request->from_date))
    //         {
    //             $data = DB::select('SELECT his.created_at,his.action_by,his.remark AS activity,mac.area,mac.machine_number,dev.device_type,dev.model_type
    //             FROM device_history his
    //             LEFT JOIN device dev
    //             ON his.id_device = dev.id
    //             LEFT JOIN machine mac
    //             on his.id_machine = mac.id
    //             WHERE date(his.created_at) BETWEEN .array($request->from_date). AND .array($request->to_date). order by his.created_at desc ');
    //         }else
    //         {
    //             $data = DB::select('SELECT his.created_at,his.action_by,his.remark AS activity,mac.area,mac.machine_number,dev.device_type,dev.model_type
    //             FROM device_history his
    //             LEFT JOIN device dev
    //             ON his.id_device = dev.id
    //             LEFT JOIN machine mac
    //             on his.id_machine = mac.id
    //             WHERE date(his.created_at) BETWEEN date(now()) AND date(now()) order by his.created_at desc ');
    //         }
    //         return datatables()->of($data)->make(true);
    //     }
    //     return view('admin.dashboard');
    // }
    public function export()
    {
        return Excel::download(new DeviceExport,'device.xlsx');
    }
    public function brokenExport()
    {
        return Excel::download(new BrokenExport, 'broken.xlsx');
    }
}
