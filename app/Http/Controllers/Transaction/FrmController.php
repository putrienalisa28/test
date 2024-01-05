<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction\FRM\FrmInputModel;
use App\Models\Master\FRM\CategoryModel;
use App\Models\Master\FRM\SubCategoryModel;
use App\Models\Master\FRM\Sys015aMachineModel;
use App\Models\Transaction\FRM\FrmSys014aHdr;
use App\Models\Transaction\FRM\FrmSys014aDtl;
use App\Models\Transaction\FRM\CekSys014aModel;
use App\Models\Transaction\FRM\FrmSys014aPerbaikanHrd;
use App\Models\Transaction\FRM\FrmSys014aPerbaikanDtl;
use App\Models\Transaction\FRM\FrmSys014aPerbaikanDtl2; 
use App\Models\Transaction\FRM\CekSys014aModelHdr; 
use App\Models\Transaction\FRM\SoalQaModel; 
use App\Models\Transaction\FRM\FrmSys014aVerifikasiModel;

use TCPDF;
use PDF;
class FrmController extends Controller
{
    public function index()
    {
        return view('pages/master/frm/index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function frminput()
    {
        $frminput   = FrmInputModel::whereIn('form_id', [2, 21, 22,34])->orderBy('form_id')->get();
        $header1    = FrmSys014aHdr::where('status_komplit', '0')->count();
        $header2    = CekSys014aModelHdr::where('status_komplit', '0')->count();
        $header4    = FrmSys014aVerifikasiModel::where('status', '1')->count();
        $header3    = CekSys014aModel::where('status_detail', '0')->count();


        $data = array(
            'forminput'    => $frminput,
            'header1'    => $header1
        );
        // echo json_encode($header1);
        // die;
        return view('pages/transaction/frm/index', $data);
    }

    public function create($id)
    {
        $form_input = FrmInputModel::find($id);
        // $peralatan    = Sys015aMachineModel::where('jenisform','2')->get();
        $formname = $form_input->form_link_view;

        // DEPARTMENT
        $url_ = 'http://192.168.12.68/Memo_API/TPM/getDept'; 

        $curl_ = curl_init($url_);
        curl_setopt($curl_, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response_ = curl_exec($curl_);
        curl_close($curl_);

        $department = json_decode($response_);

        // APP 1
        $url = 'http://192.168.12.68/Memo_API/TPM/getJabatan1TPM'; 

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $jabatan = json_decode($response);

        // APP 2
        $url2 = 'http://192.168.12.68/Memo_API/TPM/getJabatan2TPM'; 

        $curl2 = curl_init($url2);
        curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl2, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response2 = curl_exec($curl2);
        curl_close($curl2);

        $jabatan2 = json_decode($response2);

        //APP PENGAWAS
        $url3 = 'http://192.168.12.68/Memo_API/TPM/getJabatan3TPM'; 

        $curl3 = curl_init($url3);
        curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl3, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response3 = curl_exec($curl3);
        curl_close($curl3);

        $jabatan3 = json_decode($response3);

        $data = [
            'form_input' => $form_input->machine_id,
            'forminput'  => $form_input,
            // 'peralatan'  => $peralatan,
            'jabatan'    => $jabatan,
            'jabatan2'   => $jabatan2,
            'jabatan3'   => $jabatan3,
            'department' => $department
        ];
        
        return view('pages/transaction/frm/' . $formname, $data);
    }

    public function getDeptPayroll(Request $request)
    {
        $url = 'http://192.168.12.68/Memo_API/TPM/getDeptById/'. $request->input('dept_id');

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response);

        $response = response()->json($data);

        if (count($response->original) == 0) return $this->httpResponse(404, 'Item Not Found', false);

        return $this->httpResponse(200, 'Data From MySamIn', $response->original);
    }

    public function getMachineByMaster(Request $request){
        $data = Sys015aMachineModel::where('jenisform','2')
                                    ->where('area',$request->input('area'))
                                    ->where('nama_bagian',$request->input('nama_bagian'))
                                    ->get();

        $response = response()->json($data);

        if (count($response->original) == 0) return $this->httpResponse(404, 'Item Not Found', false);

        return $this->httpResponse(200, 'Data From MySamIn', $response->original);
    }

    public function getDataMaster(Request $request)
    {
        $data = Sys015aMachineModel::with('fm015category', 'fm015category.Form015asubcategory')
            ->where('machine_id', $request->input('id_peralatan'))
            ->get();

        $response = response()->json($data);

        if (count($response->original) == 0) return $this->httpResponse(404, 'Item Not Found', false);

        return $this->httpResponse(200, 'Data From MySamIn', $response->original);
    }

    public function getDataDetail(Request $request)
    {
        $data = FrmSys014aHdr::select(
            'tbl_frmsys014a_dtl.subcategory_id',
            'tbl_frmsys014a_dtl.frekuensi',
            'tbl_frmsys014a_dtl.plan',
            'tbl_frmsys014a_dtl.realisasi',
            'tbl_frmsys014a_dtl.s_condition',
            'tbl_frmsys014a_dtl.remaks',
            'tbl_frmsys014a_dtl.status',
            'tbl_frmsys014a_dtl.minggu_ke',
            'tbl_frmsys014a_hdr.headerid',
            'tbl_frmsys014a_hdr.kode',
            'tbl_frmsys014a_hdr.app1_by',
            'tbl_frmsys014a_hdr.app1_jabatan',
            'tbl_frmsys014a_hdr.app1_regno',
            'tbl_frmsys014a_hdr.app2_by',
            'tbl_frmsys014a_hdr.app2_jabatan',
            'tbl_frmsys014a_hdr.app2_regno'
        )
            ->join('tbl_frmsys014a_dtl', 'tbl_frmsys014a_dtl.headerid', '=', 'tbl_frmsys014a_hdr.headerid')
            ->where('tbl_frmsys014a_hdr.kode_periode', $request->input('kode_periode'))
            ->where('tbl_frmsys014a_hdr.department', $request->input('cari_dept'))
            ->where('tbl_frmsys014a_hdr.jenis_mesin', $request->input('id_mesin'))
            ->where('tbl_frmsys014a_hdr.status_komplit', '0')
            ->get();

        if (count($data) == 0) {
            return $this->httpResponse(404, 'Item Not Found', false);
        }

        return $this->httpResponse(200, 'Data From MySamIn', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo json_encode($request->all());
        // die;
        DB::beginTransaction();
        try {

            # Insert Header
            $insertHeader = FrmSys014aHdr::where([
                'jenis_mesin' => $request->id_peralatan,
                'department' => $request->department,
                'kode_periode' => $request->kode_periode,
                'status_komplit' => '0'
            ])->first();
            $cekHeader = FrmSys014aHdr::where([
                'jenis_mesin' => $request->id_peralatan,
                'department' => $request->department,
                'kode_periode' => $request->kode_periode,
                'status_komplit' => '1'
            ])->first();
                
            if ($insertHeader) {
                // Edit
                $headerId = $insertHeader->headerid;
                $insertHeader->app1_by = $request->app1_by;
                $insertHeader->app1_jabatan = $request->app1_jabatan;
                $insertHeader->app1_regno = $request->regno;
                $insertHeader->app2_by = $request->app2_by;
                $insertHeader->app2_jabatan = $request->app2_jabatan;
                $insertHeader->app2_regno = $request->regno2;
                $insertHeader->updated_by = $request->session()->get('username');
                $insertHeader->save();
            } else if ($cekHeader) {
                return $this->httpResponse(500, "Data sudah pernah diinput!", $cekHeader);
            } else {
                // Create
                $insertHeader = FrmSys014aHdr::create([
                    'nomor' => $request->nomor,
                    'jenis_mesin' => $request->id_peralatan,
                    'department' => $request->department,
                    'kode_periode' => $request->kode_periode,
                    'kode' => $request->kode,
                    'status_komplit' => '0',
                    'status_cek' => '0',
                    'status_verifikasi' => '0',
                    'created_by' => $request->session()->get('username'),
                    'app1_by' => $request->app1_by,
                    'app1_jabatan' => $request->app1_jabatan,
                    'app1_regno' => $request->regno,
                    'app2_by' => $request->app2_by,
                    'app2_jabatan' => $request->app2_jabatan,
                    'app2_regno' => $z->regno2,
                    'nama_bagian' => $request->namabagian,
                    'area' => $request->area
                ]);
                $headerId = $insertHeader->headerid;
            }

            # Insert Detail

            $data = [];

            foreach ($request->subcategory_id as $key => $sub) {
                if (isset($request->status[$sub]) && $request->status[$sub] != null) {
                    $status = $request->status[$sub];

                    foreach ($status as $index => $stat) {
                        $data[] = [
                            'headerid' => $headerId,
                            'subcategory_id' => $sub,
                            'frekuensi' => $request->frekuensi[$sub],
                            'plan' => $request->plan[$sub][$index],
                            'realisasi' => $request->realisasi[$sub][$index],
                            'status' => $stat,
                            's_condition' => $request->s_condition[$sub][$index],
                            'remaks' => $request->remaks[$sub][$index],
                            'minggu_ke' => $request->minggu_ke[$sub][$index]
                        ];
                    }
                }
            }

            // Hapus data yang sudah ada berdasarkan headerId
            FrmSys014aDtl::where('headerid', $headerId)->delete();

            // Insert data baru
            FrmSys014aDtl::insert($data);

            DB::commit();
            return $this->httpResponse(200, 'Save Data Successfully', true);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function approval()
    {
        $frminput = FrmInputModel::whereIn('form_id', [2, 21, 22])->orderBy('form_id')->get();
        $data = array(
            'forminput'    => $frminput,
        );
        return view('pages/transaction/frm/listApproval', $data);
    }

    public function monitoring()
    {
        $frminput    = FrmInputModel::all();
        $data = array(
            'forminput'    => $frminput,
        );
        return view('pages/transaction/frm/listMonitoring', $data);
    }

    public function content($id)
    {
        $frminput    = FrmInputModel::where('form_id',$id)->get();
        $count_hdr   = FrmSys014aHdr::where('status_komplit', '1')
                                    ->where('app1_status', null)
                                    ->count();
        $count_hdr2  = FrmSys014aHdr::where('status_komplit', '1')
                                    ->where('app1_status', '1')
                                    ->where('app2_status', null)
                                    ->count();
        $count       = CekSys014aModelHdr::where('status_komplit', '1')
                                            ->where('app1_status', null)
                                            ->count();
        $count2      = CekSys014aModelHdr::where('status_komplit', '1')
                                            ->where('app1_status', '1')
                                            ->where('app2_status', null)
                                            ->count();
        $count_ver   = FrmSys014aPerbaikanHrd::where('status_komplit', '1')
                                                ->where('app1_status', null)
                                                ->count();
    
        $count_ver2      = FrmSys014aPerbaikanHrd::where('status_komplit', '1')
                                                    ->where('app1_status', '1')
                                                    ->where('app2_status', null)
                                                    ->count();
        $count_ver3      = FrmSys014aPerbaikanHrd::where('status_komplit', '1')
                                                    ->where('app1_status', '1')
                                                    ->where('app2_status', '1')
                                                    ->where('app2_status', null)
                                                    ->count();
        if($id == 2){
            $list_jabatan = [
                'jabatan' => ['Kd/Wkd/Kb/WKb','ASST. MANAGER'],
                'total' => [$count_hdr,$count_hdr2]
            ];
        }else if($id == 21){
            $list_jabatan = [
                'jabatan' => ['Kd/Wkd/Kb/WKb', 'ASST. MANAGER'],
                'total' => [$count, $count2]
            ];
        }else{
            $list_jabatan = [
                'jabatan' => ['KS/WKS/PGS/MKN WPM','KS/WKS/PGS/AST.PGS WCC', 'KS/WKS/INP-QAD'],
                'total' => [$count_ver, $count_ver2,$count_ver3]
            ];
        }
       
    
        $data = [
            'list_jabatan' => $list_jabatan,
            'form'  => $frminput
        ];
        // echo json_encode($count_ver2);
        // die;
        return view('pages/transaction/frm/listApprovalPimpinan', $data);
    }

        public function list_approval($id)
    {
       if($id == 2){
        $header    = FrmSys014aHdr::whereRaw("status_komplit = '1' and status_cek = '1'  and status_verifikasi = '1' and (COALESCE(app1_status,'1') != '0' and COALESCE(app2_status,'1') != '0')")
        ->get();
            $data = array(
                'header'    => $header,
            );
        return view('pages/transaction/frm/appSys014a', $data);
       }else if($id == 21){
            $header    = CekSys014aModelHdr::whereRaw("status_komplit = '1' and (COALESCE(app1_status,'1') != '0' and COALESCE(app2_status,'1') != '0')")
            ->get();
            $data = array(
                'header'    => $header,
            );
            return view('pages/transaction/frm/appSys014aCek', $data);
       }else{
            $header    = FrmSys014aHdr::select('tbl_frmsys014a_hdr.*','tbl_frmsys014a_cek.*')
                        ->join('tbl_frmsys014a_cek_hdr', 'tbl_frmsys014a_cek_hdr.headerid', '=', 'tbl_frmsys014a_hdr.headerid')
                        ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                        ->get();
            $data = array(
                'header'    => $header,
            );
           
            return view('pages/transaction/frm/appSys014aVerifikasi', $data);
       }
        
    }

    public function list_monitoring()
    {
        $header    = FrmSys014aHdr::all();
        $header2   = FrmSys014aHdr::select('tbl_frmsys014a_hdr.*')
                                ->join('tbl_frmsys014a_cek_hdr', 'tbl_frmsys014a_cek_hdr.headerid', '=', 'tbl_frmsys014a_hdr.headerid')
                                ->get();
        $header3   = FrmSys014aHdr::select('tbl_frmsys014a_hdr.*','tbl_frmsys014a_cek.*')
                                ->join('tbl_frmsys014a_cek_hdr', 'tbl_frmsys014a_cek_hdr.headerid', '=', 'tbl_frmsys014a_hdr.headerid')
                                ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                                ->get();                        

        $data = array(
            'header'    => $header,
            'header2'   => $header2,
            'detail'    =>  FrmSys014aHdr::with('FormCeksys014a','FormCeksys014a.FormCeksys014aDetail')->get()
        );

        return view('pages/transaction/frm/monitoringSys014a', $data);
    }

    public function index2(){
        $header = FrmSys014aHdr::whereRaw("status_komplit = '0' and status_cek = '0'  and status_verifikasi = '0' and (COALESCE(app1_status,'1') != '0' and COALESCE(app2_status,'1') != '0')")
                                ->get();

        $data = array(
            'header'    => $header
        );

        return view('pages/transaction/frm/index2', $data);
    }

    public function index3()
    {
        $data = array(
            'header'    =>  FrmSys014aHdr::select(
                                'tbl_frmsys014a_hdr.*',
                                'tbl_frmsys014a_cek.nama_peralatan',
                                'tbl_frmsys014a_cek.kode',
                                'tbl_frmsys014a_cek.kerusakan',
                                'tbl_frmsys014a_cek.tindakan',
                                'tbl_frmsys014a_cek.tanggal',
                                'tbl_frmsys014a_cek.id',
                            )
                            ->join('tbl_frmsys014a_cek_hdr', 'tbl_frmsys014a_cek_hdr.headerid', '=', 'tbl_frmsys014a_hdr.headerid')
                            ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                            ->where('tbl_frmsys014a_cek.status_detail', '0')
                            ->whereRaw("tbl_frmsys014a_hdr.status_komplit = '0' and tbl_frmsys014a_hdr.status_cek = '1' and tbl_frmsys014a_hdr.status_verifikasi = '0' and (COALESCE(tbl_frmsys014a_hdr.app1_status,'1') != '0' and COALESCE(tbl_frmsys014a_hdr.app2_status,'1') != '0')")
                            ->get()
        );
        
        return view('pages/transaction/frm/index3', $data);
    }

    public function index4()
    {
        $data = array(
            'header'    =>  FrmSys014aHdr::select(
                                'tbl_frmsys014a_hdr.nomor',
                                'tbl_frmsys014a_hdr.nama_bagian',
                                'tbl_frmsys014a_perbaikan_hdr.*',
                                'tbl_frmsys014a_verifikasiqa.status'
                            )
                            ->join('tbl_frmsys014a_perbaikan_hdr', 'tbl_frmsys014a_perbaikan_hdr.headerid', '=', 'tbl_frmsys014a_hdr.headerid')
                            ->join('tbl_frmsys014a_verifikasiqa', 'tbl_frmsys014a_perbaikan_hdr.id', '=', 'tbl_frmsys014a_verifikasiqa.headerid')
                            ->where('tbl_frmsys014a_verifikasiqa.status', '1')
                            // ->whereRaw("tbl_frmsys014a_hdr.status_komplit = '0' and tbl_frmsys014a_hdr.status_cek = '1'  and tbl_frmsys014a_hdr.status_verifikasi = '1' and (COALESCE(tbl_frmsys014a_hdr.app1_status,'1') != '0' and COALESCE(tbl_frmsys014a_hdr.app2_status,'1') != '0')")
                            ->get()
        );
        //  echo json_encode($data['header']);
        // die;
        return view('pages/transaction/frm/index4', $data);
    }

    public function view($id)
    {
        $forminput    = FrmInputModel::all();
        $peralatan    = Sys015aMachineModel::all();
        $header    = FrmSys014aHdr::where('headerid', $id)->get();
        $data = array(
            'header'     => $header,
            'forminput'  => $forminput,
            'peralatan'  => $peralatan,
            'detail'     => CategoryModel::with('Form015asubcategory.FormSys014aDtl')
                ->whereHas('Form015asubcategory.FormSys014aDtl', function ($query) use ($id) {
                    $query->where('headerid', $id);
                })->get(),
            'status'      => FrmSys014aDtl::where('headerid', $id)->get()
        );

        return view('pages/transaction/frm/showSys014a', $data);
    }

    public function view2($id)
    {
        $forminput    = FrmInputModel::all();
        $peralatan    = Sys015aMachineModel::all();
        $header       = FrmSys014aHdr::where('headerid', $id)->get();
        $detail      = CekSys014aModelHdr::select('tbl_frmsys014a_cek.*','tbl_frmsys014a_cek_hdr.*')
                                ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                                ->where('tbl_frmsys014a_cek_hdr.headerid',$id)
                                ->get();   

        $data = array(
            'header'     => $header,
            'forminput'  => $forminput,
            'peralatan'  => $peralatan,
            'detail'     => $detail
        );

        //  echo json_encode($detail);
        // die;

        return view('pages/transaction/frm/showCekSys014a', $data);
    }

    public function view3($id)
    {
        $peralatan    = Sys015aMachineModel::all();
        $header       = FrmSys014aPerbaikanHrd::where('checkid', $id)->get();
        $detail       = FrmSys014aPerbaikanDtl::where('headerid', $header[0]->id)->get();
        $detail2      = FrmSys014aPerbaikanDtl2::where('headerid', $header[0]->id)->get();
        $soal         = FrmSys014aVerifikasiModel::select('tbl_frmsys014a_verifikasiqa.*', 'tbl_soal_qa.soal')
                                                ->join('tbl_soal_qa', 'tbl_soal_qa.id', '=', 'tbl_frmsys014a_verifikasiqa.soal')
                                                ->get();

        $data = array(
            'header'     => $header,
            'peralatan'  => $peralatan,
            'detail'     => $detail,
            'detail2' => $detail2,
            'soal' => $soal
        );

        return view('pages/transaction/frm/showVerifikasiSys014a', $data);
    }

    public function cekform($id)
    {
        $CekHeader = CekSys014aModelHdr::where([
            'headerid' => $id
        ])->first();
        
        if($CekHeader){
            $header = CekSys014aModelHdr::where([ 'headerid' => $id])->first();
            $idcek = $header->id;
            $detail       = CekSys014aModel::where('headerid', $idcek)->get();
             // APP 1
             $url = 'http://192.168.12.68/Memo_API/TPM/getJabatan1TPM'; 

             $curl = curl_init($url);
             curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($curl, CURLOPT_HTTPHEADER, [
                 'Content-Type: application/json',
             ]);
     
             $response = curl_exec($curl);
             curl_close($curl);
     
             $jabatan = json_decode($response);
     
             // APP 2
             $url2 = 'http://192.168.12.68/Memo_API/TPM/getJabatan2TPM'; 
     
             $curl2 = curl_init($url2);
             curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
             curl_setopt($curl2, CURLOPT_HTTPHEADER, [
                 'Content-Type: application/json',
             ]);
     
             $response2 = curl_exec($curl2);
             curl_close($curl2);
     
             $jabatan2 = json_decode($response2);
             
              // APP PENGAWAS
            $url3 = 'http://192.168.12.68/Memo_API/TPM/getJabatan3TPM'; 

            $curl3 = curl_init($url3);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl3, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);

            $response3 = curl_exec($curl3);
            curl_close($curl3);

            $jabatan3 = json_decode($response3);

            $data = array(
                'header' => $header,
                'detail' => $detail,
                'jabatan' => $jabatan,
                'jabatan2' => $jabatan2,
                'jabatan3' => $jabatan3
            );

            return view('pages/transaction/frm/EditcekSys014a', $data);
        }else{
            $forminput    = FrmInputModel::all();
            $header = FrmSys014aHdr::select(
                'tbl_frmsys014a_dtl.subcategory_id',
                'tbl_frmsys014a_dtl.frekuensi',
                'tbl_frmsys014a_dtl.plan',
                'tbl_frmsys014a_dtl.realisasi',
                'tbl_frmsys014a_dtl.s_condition',
                'tbl_frmsys014a_dtl.remaks',
                'tbl_frmsys014a_dtl.status',
                'tbl_frmsys014a_dtl.minggu_ke',
                'tbl_frmsys014a_hdr.kode',
                'tbl_frmsys014a_hdr.nomor',
                'tbl_mst_sys015a_category.category_name',
                'tbl_mst_sys015a_subcategory.subcategory_name',
                'tbl_frmsys014a_hdr.headerid',
            )
            ->join('tbl_frmsys014a_dtl', 'tbl_frmsys014a_dtl.headerid', '=', 'tbl_frmsys014a_hdr.headerid')
            ->join('tbl_mst_sys015a_subcategory', 'tbl_frmsys014a_dtl.subcategory_id', '=', 'tbl_mst_sys015a_subcategory.subcategory_id')
            ->join('tbl_mst_sys015a_category', 'tbl_mst_sys015a_subcategory.category_id', '=', 'tbl_mst_sys015a_category.category_id')
            ->where('tbl_frmsys014a_hdr.headerid', $id)
            ->where(function ($query) {
                $query->where('tbl_frmsys014a_dtl.status', 'TPM')
                    ->orWhere('tbl_frmsys014a_dtl.s_condition', 'f');
            })
            ->get();
        
            // APP 1
            $url = 'http://192.168.12.68/Memo_API/TPM/getJabatan1TPM'; 

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            $jabatan = json_decode($response);
    
            // APP 2
            $url2 = 'http://192.168.12.68/Memo_API/TPM/getJabatan2TPM'; 
    
            $curl2 = curl_init($url2);
            curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl2, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);
    
            $response2 = curl_exec($curl2);
            curl_close($curl2);
    
            $jabatan2 = json_decode($response2);

            // APP PENGAWAS
            $url3 = 'http://192.168.12.68/Memo_API/TPM/getJabatan3TPM'; 

            $curl3 = curl_init($url3);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl3, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);

            $response3 = curl_exec($curl3);
            curl_close($curl3);

            $jabatan3 = json_decode($response3);

            $data = array(
                'forminput'  => $forminput,
                'header' => $header,
                'jabatan' => $jabatan,
                'jabatan2' => $jabatan2,
                'jabatan3' => $jabatan3
            );
            
            return view('pages/transaction/frm/cekSys014a', $data);
        }
    }

    public function store_cek(Request $request)
    {
        
        try {
            // Header
            $insertHeader = CekSys014aModelHdr::where([
                'id' => $request->hdridcek,
                'status_komplit' => '0'
            ])->first();
        if ($insertHeader) {
            // Edit
            $insertHeader->id = $request->hdridcek;
            $insertHeader->no_ref = $request->no_ref;
            $insertHeader->app1_by = $request->app1_by;
            $insertHeader->app1_jabatan = $request->app1_jabatan;
            $insertHeader->app1_regno = $request->regno;
            $insertHeader->app2_by = $request->app2_by;
            $insertHeader->app2_jabatan = $request->app2_jabatan;
            $insertHeader->app2_regno = $request->regno2;
            $insertHeader->status_komplit = '0';
            $insertHeader->save();
        } else {
            // Create
            $insertHeader = CekSys014aModelHdr::create([
                'headerid' => $request->headerid,
                'no_ref' => $request->no_ref,
                'status_komplit' => '0',
                'created_by' => $request->session()->get('username'),
                'app1_by' => $request->app1_by,
                'app1_jabatan' => $request->app1_jabatan,
                'app1_regno' => $request->regno,
                'app2_by' => $request->app2_by,
                'app2_jabatan' => $request->app2_jabatan,
                'app2_regno' => $request->regno2
            ]);
            $headerId = $insertHeader->id;
        }

            // if ($request->hdridcek > 0) {
            //     $cekperbaikan = CekSys014aModelHdr::find($request->hdridcek);

            //     if (!$cekperbaikan) {
            //         return response()->json(['message' => 'Cek Perbaikan not found'], 404);
            //     }
            // } else {
            //     $cekperbaikan = new CekSys014aModelHdr;
            // }

            // $cekperbaikan->headerid = $request->headerid;
            // $cekperbaikan->no_ref = $request->no_ref;
            // $cekperbaikan->app1_by = $request->app1_by;
            // $cekperbaikan->app1_jabatan = $request->app1_jabatan;
            // $cekperbaikan->app1_regno = $request->regno;
            // $cekperbaikan->app2_by = $request->app2_by;
            // $cekperbaikan->app2_jabatan = $request->app2_jabatan;
            // $cekperbaikan->app2_regno = $request->regno2;
            // $cekperbaikan->status_komplit = '0';

            // $cekperbaikan->save();
            

            //Detail
            $nama_peralatan    = $request->input('nama_peralatan');
            $kode              = $request->input('kode');
            $kerusakan         = $request->input('kerusakan');
            $tindakan          = $request->input('tindakan');
            $tanggal           = $request->input('tanggal');
            $mulai             = $request->input('mulai');
            $selesai           = $request->input('selesai');
            $jam               = $request->input('jam');
            $keterangan        = $request->input('keterangan'); 
            $nama              = $request->input('nama');
            $paraf             = $request->input('paraf');

            $data = [];

            foreach ($nama_peralatan as $index => $dt) {
                $getdata = [
                    'headerid'       => $headerId,
                    'nama_peralatan' => $dt,
                    'kode'           => $kode[$index],
                    'kerusakan'      => $kerusakan[$index],
                    'tindakan'       => $tindakan[$index],
                    'tanggal'        => $tanggal[$index],
                    'mulai'          => $mulai[$index],
                    'selesai'        => $selesai[$index],
                    'jam'            => $jam[$index],
                    'keterangan'     => $keterangan[$index],
                    'nama'           => $nama[$index],
                    'paraf_by'       => $paraf[$index],
                    'status_detail'  => '0'
                ];

                $data[] = $getdata;
            }

            CekSys014aModel::insert($data);

            return $this->httpResponse(200, 'Save Data Successfully', true);
        } catch (\Exception $e) {
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function verifikasi($headerid, $id)
    {
        $CekHeader = FrmSys014aPerbaikanHrd::where([
            'checkid' => $id
        ])->first();
        
        if($CekHeader){
            $header     = FrmSys014aPerbaikanHrd::where([ 'checkid' => $id])->first();
            $idveri     = $header->id;
            $detail     = FrmSys014aPerbaikanDtl::where('headerid', $idveri)->get();
            $detail2    = FrmSys014aPerbaikanDtl2::where('headerid', $idveri)->get();
            $soal       = FrmSys014aVerifikasiModel::select('tbl_frmsys014a_verifikasiqa.*', 'tbl_soal_qa.soal')
                                                    ->join('tbl_soal_qa', 'tbl_soal_qa.id', '=', 'tbl_frmsys014a_verifikasiqa.soal')
                                                    ->get();

            // APP WPM
            $url3 = 'http://192.168.12.68/Memo_API/TPM/getJabatan3TPM'; 

            $curl3 = curl_init($url3);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl3, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);

            $response3 = curl_exec($curl3);
            curl_close($curl3);

            $jabatan3 = json_decode($response3);

            // APP WCC
            $url2 = 'http://192.168.12.68/Memo_API/TPM/getJabatanWCC'; 

            $curl2 = curl_init($url2);
            curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl2, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);
    
            $response2 = curl_exec($curl2);
            curl_close($curl2);
    
            $jabatanwcc = json_decode($response2);

            // APP WCC
            $url = 'http://192.168.12.68/Memo_API/TPM/getJabatanQAD'; 

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            $jabatanwqad = json_decode($response);

            $data = array(
                'header' => $header,
                'detail' => $detail,
                'detail2' => $detail2,
                'soal'  => $soal,
                'jabatan3' => $jabatan3 ,
                'jabatanwcc' => $jabatanwcc,
                'jabatanqad' => $jabatanwqad,
                'soal'   => $soal
            );
            // echo json_encode($data['header']);
            // die;
            return view('pages/transaction/frm/EditVerifikasiSys014a', $data);

        }else{
            $forminput    = FrmInputModel::all();
            $header       = FrmSys014aHdr::where('headerid', $headerid)->get();
            $headercek    = CekSys014aModelHdr::select('tbl_frmsys014a_cek.*')
                                                    ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                                                    ->get();
            $soal         = SoalQaModel::all();

            // APP WPM
            $url3 = 'http://192.168.12.68/Memo_API/TPM/getJabatan3TPM'; 

            $curl3 = curl_init($url3);
            curl_setopt($curl3, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl3, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);

            $response3 = curl_exec($curl3);
            curl_close($curl3);

            $jabatan3 = json_decode($response3);

            // APP WCC
            $url2 = 'http://192.168.12.68/Memo_API/TPM/getJabatanWCC'; 

            $curl2 = curl_init($url2);
            curl_setopt($curl2, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl2, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);
    
            $response2 = curl_exec($curl2);
            curl_close($curl2);
    
            $jabatanwcc = json_decode($response2);

            // APP WCC
            $url = 'http://192.168.12.68/Memo_API/TPM/getJabatanQAD'; 

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
            ]);
    
            $response = curl_exec($curl);
            curl_close($curl);
    
            $jabatanwqad = json_decode($response);

            $data = array(
                'forminput'  => $forminput,
                'header' => $header,
                'cek' => $headercek,
                'jabatan3' => $jabatan3,
                'jabatanwcc' => $jabatanwcc,
                'jabatanqad' => $jabatanwqad,
                'soal'   => $soal
            );
        //     echo json_encode($data['cek']);
        // die;
            return view('pages/transaction/frm/verifikasiSys014a', $data);
        }
    }

    public function store_verifikasi(Request $request)
    {
        
        try {
            $insertHeader = FrmSys014aPerbaikanHrd::where([
                'id' => $request->id,
                'status_komplit' => '0'
            ])->first();
        if ($insertHeader) {
            // Edit
            $insertHeader->checkid = $request->checkid;
            $insertHeader->nomor = $request->department; 
            $insertHeader->headerid = $request->headerid;
            $insertHeader->tanggal = $request->tanggal;
            $insertHeader->nama_peralatan = $request->nama_peralatan;
            $insertHeader->area = $request->area;
            $insertHeader->kode = $request->kode;
            $insertHeader->shift = $request->shift;
            $insertHeader->antara_jam = $request->antara_jam;
            $insertHeader->total_jam = $request->total_jam;
            $insertHeader->jenis_kerusakan = $request->kerusakan;
            $insertHeader->tindakan = $request->tindakan;
            $insertHeader->dikerjakan_by = $request->dikerjakan_oleh;
            $insertHeader->dikerjakan2_by = $request->dikerjakan_oleh2;
            $insertHeader->dikerjakan3_by = $request->dikerjakan_oleh3;
            $insertHeader->dikerjakan4_by = $request->dikerjakan_oleh4;
            $insertHeader->app1_by = $request->app1_by;
            $insertHeader->app1_jabatan = $request->app1_jabatan;
            $insertHeader->app1_regno = $request->regno;
            $insertHeader->app2_by = $request->app2_by;
            $insertHeader->app2_jabatan = $request->app2_jabatan;
            $insertHeader->app2_regno = $request->regno2;
            $insertHeader->app3_by = $request->app3_by;
            $insertHeader->app3_jabatan = $request->app3_jabatan;
            $insertHeader->app3_regno = $request->regno3;
            $insertHeader->status_komplit = '0';
            $insertHeader->save();
        } else {
            // Create
            $insertHeader = FrmSys014aPerbaikanHrd::create([
            'checkid'         => $request->checkid,
            'nomor'           => $request->department, 
            'headerid'        => $request->headerid,
            'tanggal'         => $request->tanggal,
            'nama_peralatan'  => $request->nama_peralatan,
            'area'            => $request->area,
            'kode'            => $request->kode,
            'shift'           => $request->shift,
            'antara_jam'      => $request->antara_jam,
            'total_jam'       => $request->total_jam,
            'jenis_kerusakan' => $request->kerusakan,
            'tindakan'        => $request->tindakan,
            'dikerjakan_by'   => $request->dikerjakan_oleh,
            'dikerjakan2_by'  => $request->dikerjakan_oleh2,
            'dikerjakan3_by'  => $request->dikerjakan_oleh3,
            'dikerjakan4_by'  => $request->dikerjakan_oleh4,
            'app1_by'         => $request->app1_by,
            'app1_jabatan'    => $request->app1_jabatan,
            'app1_regno'      => $request->regno,
            'app2_by'         => $request->app2_by,
            'app2_jabatan'    => $request->app2_jabatan,
            'app2_regno'      => $request->regno2,
            'app3_by'         => $request->app3_by,
            'app3_jabatan'    => $request->app3_jabatan,
            'app3_regno'      => $request->regno3,
            'status_komplit'  => '0'
            ]);
            $headerId = $insertHeader->id;
            $action = 'Save';
        }

        // $insertStatusQA = FrmSys014aVerifikasiModel::where([
        //     'headerid' => $request->headerId
        // ])->first();
        // if($insertStatusQA){
        //     $insertStatusQA->soal = $request->soal;
        //     $insertStatusQA->status = $request->status;
        //     $insertStatusQA->save();
        // }else{
        //     $insertHeader = FrmSys014aVerifikasiModel::create([
        //         'soal'         => $request->soal,
        //         'status'       => $request->status,
        //         'headerid'      => $headerId
        //     ]);
        // }
            // if ($request->id > 0) {
            //     $header = FrmSys014aPerbaikanHrd::find($request->id);

            //     if (!$header) {
            //         return response()->json(['message' => 'Cek Perbaikan not found'], 404);
            //     }
            // } else {
            //     $header = new FrmSys014aPerbaikanHrd;
            //     $verifikasi = new FrmSys014aVerifikasiModel;
            //     $action = "Save";
            // }

            // $header->checkid = $request->checkid;
            // $header->nomor = $request->department; 
            // $header->headerid = $request->headerid;
            // $header->tanggal = $request->tanggal;
            // $header->nama_peralatan = $request->nama_peralatan;
            // $header->area = $request->area;
            // $header->kode = $request->kode;
            // $header->shift = $request->shift;
            // $header->antara_jam = $request->antara_jam;
            // $header->total_jam = $request->total_jam;
            // $header->jenis_kerusakan = $request->kerusakan;
            // $header->tindakan = $request->tindakan;
            // $header->dikerjakan_by = $request->dikerjakan_oleh;
            // $header->dikerjakan2_by = $request->dikerjakan_oleh2;
            // $header->dikerjakan3_by = $request->dikerjakan_oleh3;
            // $header->dikerjakan4_by = $request->dikerjakan_oleh4;
            // $header->app1_by = $request->app1_by;
            // $header->app1_jabatan = $request->app1_jabatan;
            // $header->app1_regno = $request->regno;
            // $header->app2_by = $request->app2_by;
            // $header->app2_jabatan = $request->app2_jabatan;
            // $header->app2_regno = $request->regno2;
            // $header->app3_by = $request->app3_by;
            // $header->app3_jabatan = $request->app3_jabatan;
            // $header->app3_regno = $request->regno3;
            // $header->status_komplit = '0';
            // $header->save();

            // Verifikasi QA
            $soal = $request->soal;
            $status = $request->status;

            $verifikasi = [];

            foreach ($soal as $index => $sl) {
                $getverifikasi = [
                    'headerid'  => $headerId,
                    'soal'      => $sl,
                    'status'    => $status[$index]
                ];

                $verifikasi[] = $getverifikasi;
            }

            FrmSys014aVerifikasiModel::insert($verifikasi);

            //Detail 1
            $detail_id          = $request->input('detail_id');
            $sparepart_dibawa  = $request->input('sparepart_dibawa');
            $quantity_dibawa   = $request->input('quantity_dibawa');
            $sparepart_kembali = $request->input('sparepart_kembali');
            $quantity_kembali  = $request->input('quantity_kembali');
            $keterangan        = $request->input('keterangan');

            //Detail 2
            $detail_id2          = $request->input('detail_id2');
            $sparepart_pasang  = $request->input('sparepart_pasang');
            $quantity_pasang   = $request->input('quantity_pasang');
            $sparepart_rusak   = $request->input('sparepart_rusak');
            $quantity_rusak    = $request->input('quantity_rusak');
            $keterangan2       = $request->input('keterangan2');


            $data = [];

            foreach ($detail_id as $index => $dt) {
                $getdata = [
                    'headerid'       => $headerId,
                    'sparepart_dibawa' => $sparepart_dibawa[$index],
                    'quantity_dibawa'           => $quantity_dibawa[$index],
                    'sparepart_kembali'      => $sparepart_kembali[$index],
                    'quantity_kembali'       => $quantity_kembali[$index],
                    'keterangan'        => $keterangan[$index]
                ];

                $data[] = $getdata;
            }

            $simpandtl1 = FrmSys014aPerbaikanDtl::insert($data);

            $data2 = [];

            foreach ($detail_id2 as $index => $dt) {
                $getdata2 = [
                    'headerid'       => $headerId,
                    'sparepart_pasang' => $sparepart_pasang[$index],
                    'quantity_pasang'           => $quantity_pasang[$index],
                    'sparepart_rusak'      => $sparepart_rusak[$index],
                    'quantity_rusak'       => $quantity_rusak[$index],
                    'keterangan'        => $keterangan2[$index]
                ];

                $data2[] = $getdata2;
            }

            $simpandtl2 = FrmSys014aPerbaikanDtl2::insert($data2);

            if ($simpandtl2) {
                return $this->httpResponse(200, "$action Data Successfully", $simpandtl2);
            }
        } catch (\Throwable $e) {
            return $this->httpResponse(400, $e->getMessage(), false);
        }
    }

    public function komplit(Request $request){
        DB::beginTransaction();
        try {
            $cekHeaderStatus = FrmSys014aHdr::where([
                'status_cek' => '1',
                'status_verifikasi' => '1'
            ])->first();
            
            if($cekHeaderStatus){
                if ($request->headerid > 0) {
                    $header = FrmSys014aHdr::find($request->headerid);
                    $header->status_komplit = '1';
    
                    $header->save();
                }
            }else{
                return $this->httpResponse(500, "Karna Ada Temuan, Silahkan Isi Semua Form Perbaikan Pada Periode Ini!", $cekHeaderStatus);
            }

            DB::commit();
            return $this->httpResponse(200, 'Complete Data Successfully', true);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function komplit_cek(Request $request){
        DB::beginTransaction();
        try {
            if ($request->hdridcek > 0) {
                $header = CekSys014aModelHdr::find($request->hdridcek);
                $header->status_komplit = '1';

                $header->save();

                //Form I
                $sys014a = FrmSys014aHdr::find($request->headerid);
                $sys014a->status_cek = '1';

                $sys014a->save();
            }
            

            DB::commit();
            return $this->httpResponse(200, 'Complete Data Successfully', true);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function komplit_verifikasi(Request $request){
        DB::beginTransaction();
        try {
            if ($request->id > 0) {
                $header = FrmSys014aPerbaikanHrd::find($request->id);
                $header->status_komplit = '1';

                $header->save();
                
                 //Form II Detail
                 $sys014acek = CekSys014aModel::find($request->checkid);
                 $sys014acek->status_detail = '1';
 
                 $sys014acek->save();
                 

                 //Form I
                 $count = CekSys014aModelHdr::select('tbl_frmsys014a_cek.*')
                 ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                 ->where('tbl_frmsys014a_cek_hdr.headerid', $request->headerid)
                 ->where('tbl_frmsys014a_cek.status_detail', '1')
                 ->count();

                 $jumlah = CekSys014aModelHdr::select('tbl_frmsys014a_cek.*')
                 ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                 ->where('tbl_frmsys014a_cek_hdr.headerid', $request->headerid)
                 ->count();

                 if($count == $jumlah){
                     $sys014a = FrmSys014aHdr::find($request->headerid);
                     $sys014a->status_verifikasi = '1';
 
                     $sys014a->save();
                 }
            }
            

            DB::commit();
            return $this->httpResponse(200, 'Complete Data Successfully', true);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function verifikasiqa($headerid,$id){
        $header       = FrmSys014aHdr::where('headerid', $headerid)->get();
        $headerperbaikan    = FrmSys014aPerbaikanHrd::where('id', $id)->get();
        $data = array(
            'header' => $header,
            'headerperbaikan' => $headerperbaikan
        );
        // echo json_encode($data['headerperbaikan']);
        // die;
        return view('pages/transaction/frm/verifikasiSys014aQA', $data);
    }


    public function printData($id)
    {
        $forminput    = FrmInputModel::all();
        $peralatan    = Sys015aMachineModel::all();
        $header    = FrmSys014aHdr::where('headerid', $id)->get();
        $data = array(
            'header'     => $header,
            'forminput'  => $forminput,
            'peralatan'  => $peralatan,
            'detail'     => CategoryModel::with('Form015asubcategory.FormSys014aDtl')
                ->whereHas('Form015asubcategory.FormSys014aDtl', function ($query) use ($id) {
                    $query->where('headerid', $id);
                })->get(),
            'status'      => FrmSys014aDtl::where('headerid', $id)->get()
        );
  
            // echo json_encode($data['detail']);
            //     die;

            $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8');

            // Atur properti PDF
            $pdf->SetCreator('My Application');
            $pdf->SetTitle('Print Input');
        

            // Buat halaman PDF
            // $pdf->AddPage();

            // Set font yang akan digunakan
            ///////////////////////////////////////////////// SET HEADER//////////////////////////////////////////////////////
            $pdf->SetFont('Times','',11);
            $pdf->setLineWidth(0.3);
            $pdf->Cell(277,190,'',1,0,'C',0);
            $pdf->SetXY(28,$pdf->GetY()-4);
            $pdf->setFillColor(255,255,255);
            $pdf->SetXY(10,$pdf->GetY()+4);
            $pdf->Image('assets/img/logo.png', 14, 11, 14);
            $pdf->Cell(21, 23, '', 1, 0, 'C', 0);
            //SET PT
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(210, 5, ' PT RIAU SAKTI UNITED PLANTATIONS', 1, 0, 'C', 1);
            $pdf->SetFont('Times', '', 10);
            //SET NOMOR AND  HAL
            $pdf->Cell(12, 5, 'Nomor', 'TL', 0, 'L', 1);
            $pdf->Cell(3, 5, ':', 'T', 0, 'L', 1);
            $pdf->Cell(28, 5, $header[0]['nomor'], 'T', 1, 'L', 1);
            $pdf->SetX(241);
            $pdf->Cell(12, 5, 'Hal : ', 'L', 0, 'L', 1);
            // $this->Cell(67,15,"Halaman : ".$this->PageNo().' dari {nb}',1,0,'L');
            $pdf->Cell(3, 5, ':', 0, 0, 'L', 1);
            $pdf->Cell(28, 5, '1 dari 2', 0, 1, 'L', 1);
            $pdf->SetX(241);
            $pdf->Cell(46, 5, '(Pages)', 'LR', 0, 'L', 1);
            $pdf->SetXY(241,25);
            $pdf->Cell(46, 8, '', 'LRB', 0, 'L', 1);
            //JUDUL
            $pdf->SetXY(31, 16);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(210, 9, 'DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/ PENGGANTIAN','LR', 0, 'C', 1);
            //ITALIC
            $pdf->SetXY(31, 24); // 9 is the height of the previous cell
            $pdf->SetFont('Times', 'I', 12); 
            $pdf->Cell(210, 9, 'Maintenance Checklist And Monthly Repair/Replacement Record','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', '', 10);

            $pdf->SetXY(10,33);
            $pdf->Cell(57, 9, 'Nama Peralatan/Mesin','TL', 0, 'L', 1);
            $pdf->Cell(3, 9, ':', 'T', 0, 'L', 1);
            $pdf->Cell(35, 9, 'TCA/TBA', 'T', 1, 'L', 1);
            //ITALIC
            $pdf->SetXY(10,39);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(274, 8, '(Name of Equipment/Machine)','BL', 0, 'L', 1);
            $pdf->SetFont('Times', '', 10);
            $pdf->SetXY(220,33);
            $pdf->Cell(50, 7, 'Kode', 0, 'L', 1);
            $pdf->SetXY(235,33);
            $pdf->Cell(3, 7, ':', 0, 'L', 1);
            $pdf->SetXY(240,33);
            $pdf->Cell(47, 6, 'TT','TR', 0, 'L', 1);
            //ITALIC
            $pdf->SetXY(220,39);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(47,6, '(Code)', 0, 'L', 1);
            $pdf->SetFont('Times', '', 10);

            /////////////////////////////////////////SET DETAIL////////////////////////////////////////////////////
            $pdf->SetFont('Times', 'B', 12);
            $pdf->SetXY(10,47);
            $pdf->Cell(20,12, 'NO','BLTR', 0, 'L', 1);
            $pdf->SetXY(20,47);
            $pdf->Cell(80,6, 'NAMA PERALATAN','LTR', 0, 'C', 1);
            $pdf->SetXY(20,52);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(80,7, '(Equipment Name)','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', '', 10);

            $pdf->SetFont('Times', 'B', 12);
            $pdf->SetXY(100,47);
            $pdf->Cell(35,6, 'FREKUENSI','LTR', 0, 'C', 1);
            $pdf->SetXY(100,52);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(35,7, '(Frequency)','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', '', 10);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->SetXY(135,47);
            $pdf->Cell(30,12, 'P/R/S','BLTR', 0, 'C', 1);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(122,5, 'MINGGU KE-','LTR', 0, 'C', 1);
            $pdf->SetXY(165,53);
            $pdf->Cell(24.4,6, 'I',1, 0, 'C', 0);
            $pdf->Cell(24.4,6, 'II',1, 0, 'C', 0);
            $pdf->Cell(24.4,6, 'III',1, 0, 'C', 0);
            $pdf->Cell(24.4,6, 'IV',1, 0, 'C', 0);
            $pdf->Cell(24.4,6, 'V',1, 0, 'C', 0);

            
            $pdf->SetXY(10,59);
            $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $i = 1;
            foreach ($data['detail'] as $category) {
                $pdf->Cell(10, 10, $alphabet[$i - 1], 1, 0, 'L');
                $pdf->Cell(80, 10,$category->category_name, 1, 0, 'L');
                $pdf->Cell(35, 10,'', 1, 0, 'L');
                $pdf->Cell(30, 10,'', 1, 0, 'L');
                $pdf->Cell(24.4, 10,'', 1, 0, 'L');
                $pdf->Cell(24.4, 10,'', 1, 0, 'L');
                $pdf->Cell(24.4, 10,'', 1, 0, 'L');
                $pdf->Cell(24.4, 10,'', 1, 0, 'L');
                $pdf->Cell(24.4, 10,'', 1, 1, 'L');
                foreach ($category->Form015asubcategory as $key=>$subcategory) {
                
                    $pdf->Cell(10, 28,($key+1), 1, 0, 'C');
                    $pdf->SetFont('Times','B',11);
                    $pdf->Cell(80, 28,$subcategory->subcategory_name, 1, 0, 'L');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->SetFont('Times','',11);
                    $pdf->Cell(35, 28,$subcategory->FormSys014aDtl[0]->frekuensi, 1, 0, 'C');
                    
                    $pdf->SetX(165);
                    foreach ($subcategory->FormSys014aDtl as $detail) {
                        if ($detail->plan == 1) {
                            $pdf->SetFillColor(0, 0, 0); 
                        } else {
                            $pdf->SetFillColor(255, 255, 255); 
                        }                     
                        $pdf->Cell(24.4, 7, $detail->plan, 1, 0, 'C', true); 
                        $pdf->SetFillColor(255, 255, 255); 
                    }
                    
                    $pdf->SetX(135);
                    $pdf->Cell(30, 7, 'Plan', 1, 1, 'C');
                    $pdf->SetX(165);
                    foreach ($subcategory->FormSys014aDtl as $detail){
                    $pdf->Cell(24.4, 7, $detail->realisasi, 1, 0, 'C');
                    }
                    $pdf->SetX(135); 
                    $pdf->Cell(30, 7, 'Realisasi', 1, 1, 'C');
                    $pdf->SetX(165);
                    foreach ($subcategory->FormSys014aDtl as $detail){
                        $pdf->Cell(24.4, 7, $detail->status, 1, 0, 'C');
                        }
                    $pdf->SetX(135); 
                    $pdf->Cell(30, 7, 'Status', 1, 1, 'C');
                    $pdf->SetX(165);
                    foreach ($subcategory->FormSys014aDtl as $detail){
                        $pdf->Cell(24.4, 7, $detail->remaks, 1, 0, 'C');
                        }
                    $pdf->SetX(135); 
                    $pdf->Cell(30, 7, 'Nama & Paraf', 1, 1, 'C');
                    
                }
                // $pdf->ln(1);
                //////////////////////////////////////////////////////SET FOOTER//////////////////////////////////////////////         
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(60, 5, 'Keterangan :', 0, 1, 'L');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(60, 5, '(Remarks)', 0, 1, 'L');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->SetFont('Times','B', 11);
                    $pdf->Cell(5, 5, 'P :', 0, 0, 'L');
                    $pdf->SetFont('dejavusans', '', 12);
                    $pdf->Cell(5, 5, html_entity_decode('&#x25A0;'), 0, 0, 'L'); 
                    $pdf->SetFont('Times','B', 11);        
                    $pdf->Cell(60, 5, '- Plan / Rencana diisi tinta hitam/bold warna hitam tiap awal tahun', 0, 1, 'L');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->SetX(20); 
                    $pdf->Cell(60, 5, '(Plan is filled by black ink/black bold every beginning of year)', 0, 1, 'L');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->SetFont('Times','B', 11);
                    $pdf->Cell(10, 5, 'R :', 0, 0, 'L');
                    $pdf->SetFont('Times','B', 11);
                    $pdf->Cell(60, 5, '- Realization/realisasi diisi dengan tanggal setiap selesai pelaksanaan', 0, 1, 'L');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->SetX(20); 
                    $pdf->Cell(60, 5, '(Realization is filled by date after the implementation)', 0, 1, 'L');
                    $pdf->SetFont('Times', 'B', 11);
                    $pdf->Cell(10, 5, 'S :', 0, 0, 'L');    
                    $pdf->Cell(30, 5, '- Status         Ok = ', 0, 0, 'L'); 
                    $pdf->SetFont('dejavusans', '', 14);        
                    $pdf->Cell(5, 5, html_entity_decode('&#x2713;'), 0, 0, 'L');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->SetFont('Times','B', 11);
                    $pdf->Cell(15, 5, ', No Ok =', 0, 0, 'L'); 
                    $pdf->SetFont('dejavusans', '', 14);        
                    $pdf->Cell(5, 5, html_entity_decode('&#x2717;'), 0, 1, 'L');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->SetX(20); 
                    $pdf->Cell(60, 5, '(Status Ok/No Ok merujuk ke prosedur/panduan kerja masing-masing)', 0, 1, 'L');
                    $pdf->SetFont('Times', '', 11);

                    ////////////TTD////////////
                    $pdf->SetXY(141,70); 
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(73, 5, 'Dibuat Oleh ', 'LTR', 1, 'C');
                    $pdf->SetXY(214,70);                 
                    $pdf->Cell(73, 5, 'Disetujui Oleh', 'TR', 1, 'C');
                    $pdf->SetXY(141,75); 
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(73, 5, 'Created by', 'BLR', 1, 'C');
                    $pdf->SetXY(214,75);             
                    $pdf->Cell(73, 5, 'Approved by', 'RB', 1, 'C');
                    $pdf->SetXY(141,80);             
                    $pdf->Cell(73, 20, 'TTD', 1, 1, 'C');
                    $pdf->SetXY(214,80);             
                    $pdf->Cell(73, 20, 'TTD', 1, 1, 'C');

                    ///////TTD LEFT////////////////////
                    $pdf->SetXY(141,100);    
                    $pdf->SetFont('Times', '', 11);         
                    $pdf->Cell(10, 5, 'Nama', 'TBL', 0, 'l');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(18, 5, '(Name)', 'B', 0, 'l');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(3, 5, ':', 'B', 0, 'l');
                    $pdf->SetFont('Times', 'B', 11); 
                    $pdf->Cell(42, 5, 'Subekti Rahayu', 'BR', 1, 'l');

                    $pdf->SetXY(141,105);
                    $pdf->SetFont('Times', '', 11);         
                    $pdf->Cell(12, 5, 'Jabatan', 'BL', 0, 'l');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(16, 5, '(Position)', 'B', 0, 'l');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(3, 5, ':', 'B', 0, 'l');
                    $pdf->SetFont('Times', 'B', 11); 
                    $pdf->Cell(42, 5, 'Kd/Wkd/Kb/Wkb', 'BR', 1, 'l');

                    $pdf->SetXY(141,110);
                    $pdf->SetFont('Times', '', 11);         
                    $pdf->Cell(13, 5, 'Tanggal', 'BL', 0, 'l');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(15, 5, '(Date)', 'B', 0, 'l');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(3, 5, ':', 'B', 0, 'l');
                    $pdf->SetFont('Times', 'B', 11); 
                    $pdf->Cell(42, 5, 'Kd/Wkd/Kb/Wkb', 'BR', 0, 'l');
                    $pdf->SetFont('Times', '', 11); 
                    
                    ///////TTD RIGHT////////////////////
                    $pdf->SetXY(214,100);                               
                    $pdf->Cell(12, 5, 'Nama', 'TBL', 0, 'l');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(16, 5, '(Name)', 'B', 0, 'l');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(3, 5, ':', 'B', 0, 'l');
                    $pdf->Cell(42, 5, 'x', 'BR', 0, 'l');

                    $pdf->SetXY(214,105);
                    $pdf->SetFont('Times', '', 11);         
                    $pdf->Cell(12, 5, 'Jabatan', 'BL', 0, 'l');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(16, 5, '(Position)', 'B', 0, 'l');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(3, 5, ':', 'B', 0, 'l');
                    $pdf->SetFont('Times', 'B', 11); 
                    $pdf->Cell(42, 5, 'Kd/Wkd/Kb/Wkb', 'BR', 1, 'l');

                    $pdf->SetXY(214,110);
                    $pdf->SetFont('Times', '', 11);         
                    $pdf->Cell(13, 5, 'Tanggal', 'BL', 0, 'l');
                    $pdf->SetFont('Times', 'I', 11);
                    $pdf->Cell(15, 5, '(Date)', 'B', 0, 'l');
                    $pdf->SetFont('Times', '', 11);
                    $pdf->Cell(3, 5, ':', 'B', 0, 'l');
                    $pdf->SetFont('Times', 'B', 11); 
                    $pdf->Cell(42, 5, 'Kd/Wkd/Kb/Wkb', 'BR', 1, 'l'); 
                    
                    ///////NAMA FORMSYS/////
                    $pdf->SetXY(10,120);
                    $pdf->SetFont('Times', '', 11);         
                    $pdf->Cell(13, 5, 'Tanggal Efektif : 01 April 2022', 0, 1, 'l');
                    $pdf->SetFont('Times', 'I', 11);         
                    $pdf->Cell(13, 5, '(Effective Date : 01 April 2022)', 0, 0, 'l');

                    $pdf->SetXY(255,120);
                    $pdf->SetFont('Times', '', 11);         
                    $pdf->Cell(13, 5, 'FRM-SYS-014a-02', 0, 1, 'l');
                  
    }
    $pdf->Output('document.pdf', 'I');
    }

    public function printDatapdf($id){
        
       $forminput    = FrmInputModel::all();
        $peralatan    = Sys015aMachineModel::all();
        $header       = FrmSys014aHdr::where('headerid', $id)->get();
        $detail      = CekSys014aModelHdr::select('tbl_frmsys014a_cek.*','tbl_frmsys014a_cek_hdr.*')
                                ->join('tbl_frmsys014a_cek', 'tbl_frmsys014a_cek.headerid', '=', 'tbl_frmsys014a_cek_hdr.id')
                                ->where('tbl_frmsys014a_cek_hdr.headerid',$id)
                                ->get();   

        $data = array(
            'header'     => $header,
            'forminput'  => $forminput,
            'peralatan'  => $peralatan,
            'detail'     => $detail
        );
            // echo json_encode($detail);
            //     die;

            $pdf = new \TCPDF('L', 'mm', 'A4', true, 'UTF-8');

            // Atur properti PDF
            $pdf->SetCreator('My Application');
            $pdf->SetTitle('Print Input');

            ///SET HEADER/////////////////////
            $pdf->SetFont('Times','',11);
            $pdf->setLineWidth(0.3);
            $pdf->Cell(277,190,'',1,0,'C',0);
            $pdf->SetXY(28,$pdf->GetY()-4);
            $pdf->setFillColor(255,255,255);
            $pdf->SetXY(10,$pdf->GetY()+4);
            $pdf->Image('assets/img/logo.png', 14, 11, 14);
            $pdf->Cell(21, 23, '', 1, 0, 'C', 0);
            //SET PT
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(210, 5, ' PT RIAU SAKTI UNITED PLANTATIONS', 1, 0, 'C', 1);
            $pdf->SetFont('Times', '', 10);
            //SET NOMOR AND  HAL
            $pdf->Cell(12, 5, 'Nomor', 'TL', 0, 'L', 1);
            $pdf->Cell(3, 5, ':', 'T', 0, 'L', 1);
            $pdf->Cell(28, 5, $header[0]['nomor'], 'T', 1, 'L', 1);
            $pdf->SetX(241);
            $pdf->Cell(12, 5, 'Hal : ', 'L', 0, 'L', 1);
            // $this->Cell(67,15,"Halaman : ".$this->PageNo().' dari {nb}',1,0,'L');
            $pdf->Cell(3, 5, ':', 0, 0, 'L', 1);
            $pdf->Cell(28, 5, '1 dari 2', 0, 1, 'L', 1);
            $pdf->SetX(241);
            $pdf->Cell(46, 5, '(Pages)', 'LR', 0, 'L', 1);
            $pdf->SetXY(241,25);
            $pdf->Cell(46, 8, '', 'LRB', 0, 'L', 1);
            //JUDUL
            $pdf->SetXY(31, 16);
            $pdf->SetFont('Times', 'B', 14);
            $pdf->Cell(210, 9, 'DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/ PENGGANTIAN','LR', 0, 'C', 1);
            //ITALIC
            $pdf->SetXY(31, 24); // 9 is the height of the previous cell
            $pdf->SetFont('Times', 'I', 12); 
            $pdf->Cell(210, 9, 'Maintenance Checklist And Monthly Repair/Replacement Record','BLR', 0, 'C', 0);
            $pdf->SetFont('Times', '', 10);

            /////////////SETDETAIL////////////////////////////////
            $pdf->SetFont('Times', 'B', 11);
            $pdf->SetXY(10,33);
            $pdf->Cell(11,12, 'NO',1, 0, 'C', 0);
            $pdf->Cell(40,6, 'NAMA PERALATAN','TR', 0, 'C', 0);
            $pdf->Cell(15,6, 'KODE','TR', 0, 'C', 0);
            $pdf->Cell(25,6, 'JENIS','TR', 0, 'C', 0);
            $pdf->Cell(60,6, 'TINDAKAN YANG DILAKUKAN','TR', 0, 'C', 0);
            $pdf->Cell(20,6, 'TGL','TR', 0, 'C', 0);
            $pdf->Cell(12,6, 'JAM','T', 0, 'C', 0);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(19,6, '(Hour)','TR', 0, 'L', 0);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(15,6, 'TOTAL','TR', 0, 'C', 0);
            $pdf->Cell(28,6, 'KETERANGAN','TR', 0, 'C', 0);
            $pdf->Cell(17,6, 'NAMA','TR', 0, 'C', 0);
            $pdf->Cell(15,6, 'PARAF','TR', 0, 'C', 0);

            $pdf->SetXY(21,38);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(40,7, '(Equipment Name)','BLR', 0, 'C', 1);
            $pdf->Cell(15,7, '(Code)','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(25,7, 'KERUSAKAN','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(60,7, '(Action Conducted)','BLR', 0, 'C', 1);
            $pdf->Cell(20,7, '(Date)','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', '', 10);
            $pdf->SetFont('Times', 'B', 10);
            $pdf->Cell(14,7, 'MULAI',1, 0, 'C', 1);
            $pdf->Cell(17,7, 'SELESAI',1, 0, 'C', 1);
    
            $pdf->Cell(15,7, 'JAM','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', 'I', 10);
            $pdf->Cell(28,7, '(Remarks)','BLR', 0, 'C', 1);
            $pdf->Cell(17,7, '(Name)','BLR', 0, 'C', 1);
            $pdf->Cell(15,7, '(Initials)','BLR', 0, 'C', 1);
            $pdf->SetFont('Times', '', 10);
            ////////////////////////ISI DETAIL////////////////////////////////////
            $pdf->SetXY(10,45);         
            $i = 1;
            $pdf->SetXY(10,45);         
            $i = 1;
            foreach ($data['detail'] as $key=>$dt) {
                $startX = $pdf->GetX();
                $startY = $pdf->GetY();
            
                $pdf->MultiCell(11, 10,($key+1), 1, 'C', false);
                $pdf->SetXY($startX + 11, $startY);
            
                $pdf->MultiCell(40, 10, $dt->nama_peralatan, 1, 'L', false);
                $pdf->SetXY($startX + 51, $startY);
            
                $pdf->MultiCell(15, 10, $dt->kode, 1, 'C', false);
                $pdf->SetXY($startX + 66, $startY);
            
                $pdf->MultiCell(25, 10, $dt->kerusakan, 1, 'L', false);
                $pdf->SetXY($startX + 91, $startY);
            
                $pdf->MultiCell(60, 10, $dt->tindakan, 1, 'L', false);
                $pdf->SetXY($startX + 151, $startY);
            
                $pdf->MultiCell(20, 10, $dt->tanggal, 1, 'L', false);
                $pdf->SetXY($startX + 171, $startY);
            
                $pdf->MultiCell(14, 10,date('H:i', strtotime($dt->mulai)), 1, 'C', false);
                $pdf->SetXY($startX + 185, $startY);
            
                $pdf->MultiCell(17, 10, date('H:i', strtotime($dt->selesai)), 1, 'C', false);
                $pdf->SetXY($startX + 202, $startY);
            
                $pdf->MultiCell(15, 10, $dt->jam, 1, 'C', false);
                $pdf->SetXY($startX + 217, $startY);
            
                $pdf->MultiCell(28, 10, $dt->keterangan, 1, 'C', false);
                $pdf->SetXY($startX + 245, $startY);
            
                $pdf->MultiCell(17, 10, $dt->nama, 1, 'L', false);
                $pdf->SetXY($startX + 262, $startY);
            
                $pdf->MultiCell(15, 10, $dt->paraf_by, 1, 'L', false);
            
                // $pdf->SetXY(10, $startY + 10); // Move to next line, and reset X coordinate
            }
            
            
            $startX = $pdf->GetX();
            $startY = $pdf->GetY();
            $pdf->SetXY($startX,$startY+1);    
            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(15,7, 'Catatan :','L', 1, 'C', 1);
            $pdf->Cell(277,4, '-Form ini diisi setelah selesai pelaksanaan hal 1 dan ada ditemukan kerusakan pada alat/mesin dan atau ada penggantian','LR', 0, 'L', 1);      
            $pdf->SetXY($startX+5,$startY+15);    
            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(20,7, 'Dicek Oleh',0, 1, 'L', 1);
            $pdf->SetFont('Times', 'I', 11);
            $pdf->SetXY($startX+5,$startY+20); 
            $pdf->Cell(20,7, '(Checked by)',0, 1, 'L', 1);
            $pdf->SetFont('Times', '', 11);
            $pdf->SetXY($startX+29,$startY+27); 
            $pdf->Cell(65,15, 'TTD','B', 1, 'L', 1);

            $pdf->SetXY($startX+5,$startY+38); 
            $pdf->Cell(20,15, 'Nama',0, 0, 'L', 0);
            $pdf->Cell(3,15, ':',0, 0, 'L', 0);
            $pdf->Cell(40,15, 'PUTRI SAHARAH',0, 0, 'L', 0);
            $pdf->SetXY($startX+5,$startY+47); 
            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(15,7, '(Name)',0, 0, 'L', 0);
            $pdf->SetFont('Times', '', 11);

            $pdf->SetXY($startX+5,$startY+48); 
            $pdf->Cell(20,15, 'Jabatan',0, 0, 'L', 0);
            $pdf->Cell(3,15, ':',0, 0, 'L', 0);
            $pdf->Cell(40,15, 'Kd/Wkd/Kb/Wkb',0, 0, 'L', 0);
            $pdf->SetXY($startX+5,$startY+57); 
            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(15,7, '(Position)',0, 0, 'L', 0);
            $pdf->SetFont('Times', '', 11);

            $pdf->SetXY($startX+5,$startY+58); 
            $pdf->Cell(20,15, 'Tanggal',0, 0, 'L', 0);
            $pdf->Cell(3,15, ':',0, 0, 'L', 0);
            $pdf->Cell(40,15, '30 April 2023',0, 0, 'L', 0);
            $pdf->SetXY($startX+5,$startY+68); 
            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(15,7, '(Date)',0, 0, 'L', 0);
            $pdf->SetFont('Times', '', 11);

            $pdf->SetXY($startX+0.5,$startY+14); 
            $pdf->Cell(138,60, '','TRB', 1, 'L', 0);
            $pdf->SetXY($startX+139,$startY+14); 
            $pdf->Cell(138,60, '', 'TB', 'L', 0);
            
            $pdf->SetXY($startX+145,$startY+15);    
            $pdf->SetFont('Times', '', 11);
            $pdf->Cell(20,7, 'Diketeahuai Oleh',0, 1, 'L', 1);
            $pdf->SetFont('Times', 'I', 11);
            $pdf->SetXY($startX+145,$startY+20); 
            $pdf->Cell(20,7, '(Acknowledged by)',0, 1, 'L', 1);
            $pdf->SetFont('Times', '', 11);
            $pdf->SetXY($startX+168,$startY+27); 
            $pdf->Cell(65,15, 'TTD','B', 1, 'L', 1);

            $pdf->SetXY($startX+145,$startY+38); 
            $pdf->Cell(20,15, 'Nama',0, 0, 'L', 0);
            $pdf->Cell(3,15, ':',0, 0, 'L', 0);
            $pdf->Cell(40,15, 'PUTRI SAHARAH',0, 0, 'L', 0);
            $pdf->SetXY($startX+145,$startY+47); 
            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(15,7, '(Name)',0, 0, 'L', 0);
            $pdf->SetFont('Times', '', 11);

            $pdf->SetXY($startX+145,$startY+48); 
            $pdf->Cell(20,15, 'Jabatan',0, 0, 'L', 0);
            $pdf->Cell(3,15, ':',0, 0, 'L', 0);
            $pdf->Cell(40,15, 'Amgr',0, 0, 'L', 0);
            $pdf->SetXY($startX+145,$startY+57); 
            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(15,7, '(Position)',0, 0, 'L', 0);
            $pdf->SetFont('Times', '', 11);

            $pdf->SetXY($startX+145,$startY+58); 
            $pdf->Cell(20,15, 'Tanggal',0, 0, 'L', 0);
            $pdf->Cell(3,15, ':',0, 0, 'L', 0);
            $pdf->Cell(40,15, '30 April 2023',0, 0, 'L', 0);
            $pdf->SetXY($startX+145,$startY+68); 
            $pdf->SetFont('Times', 'I', 11);
            $pdf->Cell(15,7, '(Date)',0, 0, 'L', 0);
            $pdf->SetFont('Times', '', 11);
    
            $pdf->SetXY($startX+0.5,$startY+14); 
            $pdf->Cell(138,60, '','TR', 1, 'L', 0);
            $pdf->SetXY($startX+139,$startY+14); 
            $pdf->Cell(138,60, '', 'T', 'L', 0);

            $pdf->SetFont('Times', 'I', 11);
            $pdf->SetXY($startX+0.5,$startY+74); 
            $pdf->Cell(243,5, 'Tanggal Efektif : 01 April 2022',0, 0, 'L', 0);
            $pdf->Cell(20,5, '(FRM-SYS-014a-02)',0, 1, 'L', 1);
            $pdf->Cell(20,5, '(Effective Date : 01 April 2022)',0, 0, 'L', 0);

            if($pdf->GetY()>=400)
            {
                $pdf->AddPage();
            }
            
            
        $pdf->Output('document.pdf', 'I');
    }
   
}
