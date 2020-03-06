<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();







//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin', function () {
        return view('admin.admin_template');
    });
    // Route::get('/', function () {
    //     //return view('welcome');
    
    // });
    route::get('/','DashboardController@index')->name('/');
    route::get('dashboard','DashboardController@index')->name('dashboard');
    route::get('dashboard.export','DashboardController@export')->name('dashboard.export');
    route::get('export.printer','PrinterController@printerExportExcel')->name('export.printer');
    route::get('export.scanner','ScannerController@scannerExportExcel')->name('export.scanner');
    route::get('export.hmi','HmiController@hmiExportExcel')->name('export.hmi');
    route::get('export.nmp','NmpController@nmpExportExcel')->name('export.nmp');
    route::get('export.broken','DashboardController@brokenExport')->name('export.broken');
    //route::get('activity','DashboardController@activity')->name('activity');
    
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('department', 'DepartmentController');
    Route::resource('section', 'SectionController');
    Route::resource('printer', 'PrinterController');
    Route::resource('scanner', 'ScannerController');
    Route::resource('device', 'DeviceController');
    Route::resource('hmi', 'HmiController');
    Route::resource('nmp', 'NmpController');
   

    Route::get('users.datauser', 'UserController@getData')->name('users.datauser');
    Route::get('usersd/{id}', 'UserController@destroy')->name('users.destroyd');
    Route::get('userss/getRegion','UserController@getRegion');
    Route::get('users.showProfile.{id}','UserController@showProfile')->name('users.showProfile');
    Route::patch('users.updateProfile.{id}','UserController@updateProfile')->name('users.updateProfile');

    Route::get('rolesd/{id}','RoleController@destroy')->name('roles.destroyd');
    Route::get('roles.dataroles', 'RoleController@getData')->name('roles.dataroles');
    
    Route::get('department.datadepartment','DepartmentController@getData')->name('department.datadepartment');
    
    Route::get('section.datasection','SectionController@getData')->name('section.datasection');
    route::patch('device.updateTransfer','DeviceController@updateTransfer')->name('device.updateTransfer');

    Route::get('printer.broken','PrinterController@broken')->name('printer.broken');
    Route::get('scanner.broken','ScannerController@broken')->name('scanner.broken');
    Route::get('hmi.broken','HmiController@broken')->name('hmi.broken');
    Route::get('nmp.broken','NmpController@broken')->name('nmp.broken');

    Route::get('Bead','AreaController@getBead')->name('Bead');
    Route::get('Calendering','AreaController@getCalendering')->name('Calendering');
    Route::get('Cutting','AreaController@getCutting')->name('Cutting');
    Route::get('Extruding','AreaController@getExtruding')->name('Extruding');
    Route::get('Inspection','AreaController@getInspection')->name('Inspection');
    Route::get('Mixing','AreaController@getMixing')->name('Mixing');
    Route::get('Other M/C','AreaController@getOtherMC')->name('Other M/C');
    Route::get('Other Non-M/C','AreaController@getOtherNonMC')->name('Other Non-M/C');
    Route::get('BUFFING','AreaController@getBuffing')->name('BUFFING');
    Route::get('Building','AreaController@getBuilding')->name('Building');
    Route::get('Curing','AreaController@getCuring')->name('Curing');
    Route::get('NMP Room','AreaController@getNMPRoom')->name('NMP Room');
});
