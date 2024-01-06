<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Master\ItemController;
use App\Http\Controllers\Master\MachineController;
use App\Http\Controllers\Master\SparepartController;
use App\Http\Controllers\Master\CategoryMachineController;
use App\Http\Controllers\Master\TagController;
use App\Http\Controllers\Master\SliderController;
use App\Http\Controllers\Master\FRM\MstFrmSys015aController;
use App\Http\Controllers\Transaction\PMController;
use App\Http\Controllers\Transaction\FrmController;
use App\Http\Controllers\Approval\APController;
use App\Http\Controllers\Eform\FormsysController;
use App\Http\Controllers\Eform\GetDataController;
use App\Http\Controllers\Eform\FormsysprintoutController;
use App\Http\Controllers\Eform\FormsystahunController;
use App\Http\Controllers\Master\DepartementController;
use App\Http\Controllers\Sewing\SewingController;

use App\Http\Controllers\Utility\SettingController;
use App\Http\Controllers\monitoring\tpm\TpmMonitoringController;
use App\Models\Eform\Form015aModel;
use App\Models\Master\MachineModel;
use App\Models\Master\SparepartModel;





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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/coa/create', [\App\Http\Controllers\Master\Coa::class, 'create'])->name('coa.create');

// Route::prefix('api')->group(function () {
//     Route::get('/coa/getAllByParam', [CoaController::class, 'getAllByParam'])->name('coa.index');
//     Route::post('/coa/store', [CoaController::class, 'store'])->name('coa.store');
// });

// Route::prefix('api')->group(function () {
//     Route::get('/master/item', [ItemController::class, 'index'])->name('item.index');
// });

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {
    Route::get('/item', [ItemController::class, 'index'])->name('item.index');
    Route::post('/item', [ItemController::class, 'store'])->name('item.store');
});

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {
    Route::get('/machine', [MachineController::class, 'index'])->name('machine.index');
    Route::post('/machine', [MachineController::class, 'store'])->name('machine.store');
    Route::get('/machine/delete', [MachineController::class, 'delete'])->name('machine.delete');
});

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {
    Route::get('/tag', [TagController::class, 'index'])->name('tag.index');
    Route::post('/tag', [TagController::class, 'store'])->name('tag.store');
});
Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () { 
    Route::get('/departement', [DepartementController::class, 'index'])->name('departement.index');
    Route::post('/departement/cari', [DepartementController::class, 'getDeptByPay'])->name('departement.getDeptByPay');
    Route::post('/departement', [DepartementController::class, 'store'])->name('departement.store');
    Route::post('/departement/delete', [DepartementController::class, 'delete'])->name('departement.delete');
});

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {
    Route::get('/sparepart', [SparepartController::class, 'index'])->name('sparepart.index');
    Route::post('/sparepart', [SparepartController::class, 'store'])->name('sparepart.store');
    Route::get('/sparepart/delete', [SparepartController::class, 'delete'])->name('sparepart.delete');
    Route::post('/sparepart/cari', [SparepartController::class, 'getItemMySamin'])->name('sparepart.getItemMySamin');
});

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {
    Route::get('/categorymachine', [CategoryMachineController::class, 'index'])->name('categorymachine.index');
    Route::post('/categorymachine', [CategoryMachineController::class, 'store'])->name('categorymachine.store');
    Route::get('/categorymachine/delete', [CategoryMachineController::class, 'delete'])->name('categorymachine.delete');
});

Route::group(['prefix' => 'master', 'middleware' => 'auth'], function () {
    Route::get('/slider', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/slider', [SliderController::class, 'store'])->name('slider.store');
});

// Transaction
Route::group(['prefix' => 'pm', 'middleware' => 'auth'], function () {
    Route::get('/uht', [PMController::class, 'uht'])->name('pm.index');
    Route::post('/pm', [PMController::class, 'store'])->name('pm.store');
    Route::get('/rencana_tpm', [PMController::class, 'rencanaTpm'])->name('rencanatpm.index');
    Route::post('/pm/confirmStatusSparepart', [PMController::class, 'confirmStatusSparepart'])->name('rencanatpm.confirmStatusSparepart');
    Route::post('/pm/saveHeader', [PMController::class, 'saveHdr'])->name('pmHeader.store');
    Route::post('/pm/saveTPM', [PMController::class, 'saveTPM'])->name('tpm.store');
    Route::get('/uht/{id}', [PMController::class, 'maintenance'])->name('pm.maintenance');
    Route::post('/getByParam', [PMController::class, 'getByParam'])->name('pmgetByParam.post');
    Route::post('/getIntervalDetailById', [PMController::class, 'getIntervalDetail'])->name('getIntervalDetail.post');
    Route::post('/getIntervalDetail', [PMController::class, 'saveIntervalDetail'])->name('intervalDetail.post');
});

Route::group(['prefix' => 'frm', 'middleware' => 'auth'], function () {
    Route::get('/frminput', [FrmController::class, 'frminput'])->name('frm.index');
    Route::get('/frminput2/{id}', [FrmController::class, 'index2'])->name('frm.index2');
    Route::get('/frminput3/{id}', [FrmController::class, 'index3'])->name('frm.index3');
    Route::get('/frminput4/{id}', [FrmController::class, 'index4'])->name('frm.index4');
    Route::get('/frminput/{id}', [FrmController::class, 'create'])->name('frm.create');
    Route::post('/frminput/ambil', [FrmController::class, 'getDataMaster'])->name('frm.getDataMaster');
    Route::post('/frminput', [FrmController::class, 'store'])->name('frm.store');
    Route::get('/approve/{id}', [FrmController::class, 'list_approval'])->name('frm.list_approval');
    Route::get('/monitor', [FrmController::class, 'list_monitoring'])->name('frm.list_monitoring');
    Route::get('/view/{headerid}', [FrmController::class, 'view'])->name('frm.view');
    Route::get('/view2/{headerid}', [FrmController::class, 'view2'])->name('frm.view2');
    Route::get('/view3/{headerid}', [FrmController::class, 'view3'])->name('frm.view3');
    Route::get('/cek/{headerid}', [FrmController::class, 'cekform'])->name('frm.cekform'); 
    Route::post('/frmsys014', [FrmController::class, 'store_cek'])->name('frm.store_cek');
    Route::post('/edit/frmsys014', [FrmController::class, 'getDataDetail'])->name('frm.getDataDetail'); 
    Route::get('/verifikasi/{headerid}/{id}', [FrmController::class, 'verifikasi'])->name('frm.verifikasi');
    Route::post('/simpan', [FrmController::class, 'store_verifikasi'])->name('frm.store_verifikasi');
    Route::post('/complete', [FrmController::class, 'komplit'])->name('frm.komplit');
    Route::post('/completecek', [FrmController::class, 'komplit_cek'])->name('frm.komplit_cek'); 
    Route::post('/completeveri', [FrmController::class, 'komplit_verifikasi'])->name('frm.komplit_verifikasi');
    Route::get('/verifikasiqa/{headerid}/{id}', [FrmController::class, 'verifikasiqa'])->name('frm.verifikasiqa');
    Route::post('/ambil/dept', [FrmController::class, 'getDeptPayroll'])->name('frm.getDeptPayroll'); 
    Route::post('/tarik/machine', [FrmController::class, 'getMachineByMaster'])->name('frm.getMachineByMaster');
    Route::get('/content/{id}', [FrmController::class, 'content'])->name('frm.content'); 
    Route::get('/tcpdf/{headerid}', [FrmController::class, 'printData'])->name('frm.printData'); 
    Route::get('/tcpdf2/{headerid}', [FrmController::class, 'printDatapdf'])->name('frm.printDatapdf');
});
// End Transaction

// Approval
Route::group(['prefix' => 'approval', 'middleware' => 'auth'], function () {
    Route::get('/ap', [APController::class, 'index'])->name('approval.index');
    Route::post('/ap', [APController::class, 'store'])->name('approval.store');
    Route::get('/frmsys', [FrmController::class, 'approval'])->name('approval.index');
});
// End Approval

//Eform Harian 
Route::group(['prefix' => 'eform', 'middleware' => 'auth'], function () {
    Route::get('/menu', [FormsysController::class, 'menu'])->name('menu.index');

    Route::get('/formsys/{id}', [FormsysController::class, 'index'])->name('formsys015.index');
    Route::post('/getdepttomesin', [FormsysController::class, 'updateOptions'])->name('getdepttomesin.index');
    Route::post('/formsys', [FormsysController::class, 'store'])->name('formsys.store');

    Route::get('/perbaikaninfo/{id}', [FormsysController::class, 'perbaikaninfo'])->name('perbaikaninfo015.index');
    Route::get('/perbaikan/{id}', [FormsysController::class, 'perbaikan'])->name('perbaikanharian.index');
    Route::get('/perbaikanview/{id}', [FormsysController::class, 'perbaikanview'])->name('perbaikanview.index');
    Route::post('/bilingual', [FormsysController::class, 'storebill'])->name('bilingual.storebill');
    Route::get('/infoverifikasi/{id}', [FormsysController::class, 'infoverifikasi'])->name('verifinfo015.index');
    Route::get('/verifikasi/{id}', [FormsysController::class, 'verifikasi'])->name('verifikasi015.index');
    Route::post('/verifikasi', [FormsysController::class, 'verifikasistore'])->name('verifikasistore.store');

    Route::get('/verifikasiqa/{id}', [FormsysController::class, 'verifikasiqa'])->name('verivikasiqa.index');
    Route::post('/verifikasiqastore', [FormsysController::class, 'verifikasiQaStore'])->name('verivikasiqastore.store');
    //Eform monitoring 
    Route::get('/monitoring', [FormsysController::class, 'monitoring'])->name('monitoring.index');
});
// End EFORM Harian 

// GET DATA EFORM
Route::group(['prefix' => 'getdata', 'middleware' => 'auth'], function () {
    Route::get('/getmaster', [GetDataController::class, 'getmaster'])->name('getmasterEform.index');
    Route::get('/getmastertahun', [GetDataController::class, 'getmastertahunan'])->name('getmasterEformtahunan.index');
    Route::post('/ceklisharian', [GetDataController::class, 'ceklisharian'])->name('ceklisharian.index');
    Route::post('/ceklistahunan', [GetDataController::class, 'ceklistahunan'])->name('ceklistahunan.index');
});

//Eform printout
Route::group(['prefix' => 'eformprint', 'middleware' => 'auth'], function () {
    Route::get('/formsysinput/{id}', [FormsysprintoutController::class, 'printinput'])->name('printinput.index');
});

// EFORM Tahunan
Route::group(['prefix' => 'eform', 'middleware' => 'auth'], function () {
    Route::get('/menutahunan', [FormsystahunController::class, 'menu'])->name('menutahunan.index');
    Route::post('/getdepttomesintahun', [FormsystahunController::class, 'updateOptions'])->name('getdepttomesintahun.index');
    Route::get('/formsystahun/{id}', [FormsystahunController::class, 'index'])->name('formsystahun.index');
    Route::post('/formsystahunan', [FormsystahunController::class, 'store'])->name('formsystahun.store');
    Route::get('/infoperbaikan/{id}', [FormsystahunController::class, 'infoperbaikan'])->name('perbaikaninfo013.index');
    Route::get('/perbaikantahun/{id}', [FormsystahunController::class, 'perbaikan'])->name('perbaikan.index');
    Route::post('/storeperbaikan', [FormsystahunController::class, 'storeperbaikan'])->name('perbaikan.store');
    Route::get('/infoverifikasitahun/{id}', [FormsystahunController::class, 'infoverifikasi'])->name('infoveriftahun.index');
    Route::get('/verifikasitahun/{id}', [FormsystahunController::class, 'verifikasi'])->name('verifikasitahun.index');
    Route::post('/verifikasitahunstore', [FormsystahunController::class, 'verifikasistore'])->name('verifikasitahunstore.store');
    Route::get('/verifikasiqatahun/{id}', [FormsystahunController::class, 'verifikasiqa'])->name('verivikasiTahunqa.index');
    //Eform monitoring tahunan 
    Route::get('/monitoringtahun', [FormsystahunController::class, 'monitoring'])->name('monitoringtahun.index');
});
// End EFORM

// Utility
Route::group(['prefix' => 'utl', 'middleware' => 'auth'], function () {
    Route::get('/manage-user', [SettingController::class, 'manageUser'])->name('user.index');
    Route::post('/manage-user', [SettingController::class, 'userSave'])->name('user.store');
    // Route::post('/pm', [PMController::class, 'store'])->name('pm.store');
    // Route::get('/uht/{id}', [PMController::class, 'maintenance'])->name('pm.maintenance');
});
// End Utility
// Monitoring
Route::group(['prefix' => 'monitoring', 'middleware' => 'auth'], function () {
    Route::get('/frmsys', [FrmController::class, 'monitoring'])->name('monitoring.index');
});
Route::group(['prefix' => 'monitoring', 'middleware' => 'auth'], function () {
    Route::get('/pm', [TpmMonitoringController::class, 'index'])->name('item.index');
    Route::post('/pm/getTpmByParam', [TpmMonitoringController::class, 'getTpmByParam'])->name('getTpmByParam.post');
});


// Tamplate
Route::group(['prefix' => 'tamplate', 'middleware' => 'auth'], function () {
    Route::get('/frmsy015a', [MstFrmSys015aController::class, 'index'])->name('frmsy015a.index');
    Route::post('/frmsy015a', [MstFrmSys015aController::class, 'store'])->name('frmsy015a.store');
    Route::post('/frmsy015a/store2', [MstFrmSys015aController::class, 'store2'])->name('frmsy015a.store2');
    Route::post('/frmsy015a/store3', [MstFrmSys015aController::class, 'store3'])->name('frmsy015a.store3');
});

// Sewing
Route::get('sewing/output', [SewingController::class, 'output'])->name('sewing.output');
Route::post('/sewing/style', [SewingController::class, 'getlygSewingOutput'])->name('sewing.getlygSewingOutput');
Route::post('/sewing/edit', [SewingController::class, 'editDataTransaction'])->name('sewing.edit');
//End Tamplate

// Authentication Routes...
Route::get('login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'App\Http\Controllers\Auth\LoginController@login')->name('login.post');
Route::get('logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
Route::get('onelogin/{username}/{password}', 'App\Http\Controllers\Auth\LoginController@onelogin')->name('one.login');

// Registration Routes...
Route::get('register', 'App\Http\Controllers\Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'App\Http\Controllers\Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');

Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/templateFormSys', function ($param = []) {
    $data = Form015aModel::with('fm015category', 'fm015category.Form015asubcategory')->get();
    return response()->json($data, 200);
})->name('templateFormSys.get');

Route::get('/templateFormSystrans', function ($param = []) {
    $data = Form015aModel::with('fm015category', 'fm015category.Form015asubcategory')->get();
    return response()->json($data, 200);
})->name('templateFormSystrans.get');

// ajax request


Route::get('/getAllMachine/{id?}', function ($id = null) {
    $query = MachineModel::with('sparepartDtl', 'sparepartDtl.sparepart');

    if ($id !== null) {
        $query->where('machine_id', $id);
    }

    $data = $query->get();


    return response()->json($data, 200);
})->name('getAllMachine.get');

Route::get('/sparepartByMachine/{id}', function ($id) {
    $data = SparepartModel::where('machine_id', $id)->get();
    return response()->json($data, 200);
})->name('sparepartByMachine.get');
