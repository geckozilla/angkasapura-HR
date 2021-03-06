<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('users', 'usersAPIController');



































Route::resource('fungsis', 'fungsiAPIController');

Route::resource('jabatans', 'jabatanAPIController');

Route::resource('karyawans', 'karyawanAPIController');

Route::resource('klsjabatans', 'klsjabatanAPIController');

Route::resource('osdocs', 'osdocAPIController');

Route::resource('statuskars', 'statuskarAPIController');







Route::resource('tipekars', 'tipekarAPIController');

Route::resource('units', 'unitAPIController');

Route::resource('unitkerjas', 'unitkerjaAPIController');

Route::resource('roles', 'rolesAPIController');

Route::resource('karyawan_os', 'karyawan_osAPIController');

Route::resource('osperformances', 'OsperformanceAPIController');

Route::resource('fungsi_os', 'fungsi_osAPIController');

Route::resource('vendor_os', 'vendor_osAPIController');

Route::resource('jabatan_os', 'jabatan_osAPIController');

Route::resource('kategori_unit_kerjas', 'kategori_unit_kerjaAPIController');

Route::resource('log_karyawans', 'log_karyawanAPIController');