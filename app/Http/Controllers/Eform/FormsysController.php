<?php

namespace App\Http\Controllers\Eform;

use App\Http\Controllers\Eform\GetDataController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Eform\Form015aModel;
use App\Models\Eform\FormDeptModel;
use App\Models\Eform\FormDeptMesin_Model;
use Carbon\Carbon;
use App\Models\Transaction\FRM\FrmInputModel;
use App\Models\Transaction\Eform\FormsysModel;
use App\Models\Transaction\Eform\FormsysdtlModel;
use App\Models\Transaction\Eform\Formsys_bilModel;
use App\Models\Transaction\Eform\Formsys_bildtlModel;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifModel;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifdtlModel;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifdtlQAModel;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifQaModel;




class FormsysController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function menu()
    {
        $frminput = FrmInputModel::whereIn('form_id', [1, 12, 13, 14])->orderBy('urut', 'ASC')->get();
        $data = array(
            'forminput' => $frminput,
        );


        return view('pages/transaction/Eform/menu', $data);
    }


    //----------------------------------------- Start Inputan Harian --------------------------------------------------------------------------------


    public function index()
    {

        $data['Dept'] = FormDeptModel::select('id_dept', 'department')->get();


        return view('pages/transaction/Eform/index', $data);
    }
    public function updateOptions(Request $request)
    {

        $url = "http://192.168.12.168:5070/apiklinik/TK/get_all_filter_by?" . http_build_query(['bagian_abbr' => $request->input('department')]);

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        $dataTk = json_decode($response);


        $peralatan = FormDeptMesin_Model::where("dept", $request->input('department'))
            ->where("jenisform", 1)
            ->with('Peralatan')
            ->get();



        return response()->json([
            'listTk' => $dataTk,
            'listPeralatan' => $peralatan
        ]);
    }




    public function store(Request $request)
    {


        // echo json_encode($request->all());
        // die;
        DB::beginTransaction();
        try {

            # Insert Header
            $insertHeader = FormsysModel::where([
                'mesin_id' => $request->mesinid,
                'dept' => $request->department
                // ,'nosurat' => $request->nosurat
            ])->whereMonth('month', dateFormater($request->month, 'm'))->whereYear('month', dateFormater($request->month, 'Y'))->first();

            // echo json_encode($insertHeader);
            // die;

            if ($insertHeader) {
                $headerId = $insertHeader->id;
                $insertHeader->updated_by = $request->session()->get('username');
                $insertHeader->acknowledged_date = $request->acknowledged_date;
                $insertHeader->acknowledged_by = $request->acknowledged_name;
                $insertHeader->acknowledged_id = $request->acknowledged_id;
                $insertHeader->jabatan = $request->jabatan;
                $insertHeader->save();
            } else {
                $nosurat = str_replace('NO : ', '', $request->nosurat);
                $insertHeader = FormsysModel::create([
                    'form_id' => $request->jenisform,
                    'mesin_id' => $request->mesinid,
                    'dept' => $request->department,
                    'month' => $request->month,
                    'code' => $request->kode,
                    'nosurat' => $nosurat,
                    'created_by' => $request->session()->get('username')
                ]);

                $headerId = $insertHeader->id;
            }

            # Insert Detail

            $data = [];



            foreach ($request->subcategory_id as $key => $sub) {
                if (isset($request->status[$sub]) && $request->status[$sub] != null) {
                    $status = $request->status[$sub];

                    foreach ($status as $index => $stat) {

                        $data[] = [
                            'hdr_id' => $headerId,
                            'sub_category_id' => $sub,
                            'status' => $status[$index],
                            'days' => $index,
                            'remarks' => $request->remaks[$key]
                        ];
                    }
                }
            }



            // Hapus data yang sudah ada berdasarkan headerId
            FormsysdtlModel::where('hdr_id', $headerId)->delete();

            // Insert data baru
            FormsysdtlModel::insert($data);


            DB::commit();
            return $this->httpResponse(200, 'Save Data Successfully', true);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }
    //----------------------------------------- End Inputan Harian --------------------------------------------------------------------------------------------


    //--------------------------------------------------Start bilingual ---------------------------------------------------------------------------------------

    public function perbaikaninfo()
    {

        $dtl = DB::table('tbl_trn_formsys_dtl as b')
            ->leftjoin('tbl_mst_sys015a_subcategory as c', 'b.sub_category_id', '=', 'c.subcategory_id')
            ->leftjoin('tbl_mst_sys015a_category as d', 'd.category_id', '=', 'c.category_id')
            ->leftjoin('tbl_mst_sys015a as e', 'e.machine_id', '=', 'd.machine_id')
            ->select('b.hdr_id', 'e.machine_name', 'd.category_name', 'c.subcategory_name', 'b.days')
            ->where('b.status', false)
            ->where('b.statusperbaikan', false)
            ->get();


        $ids = $dtl->pluck('hdr_id')->toArray();


        $dataperbaikan = Formsys_bilModel::with('bilingualDetail')->get();

        $data['bilingual'] = [
            'hdr' => FormsysModel::whereIn('id', $ids)->get(),
            'dtl-bilingual' => $dtl,
            'alldataperbaikan' => $dataperbaikan,

        ];

        // echo json_encode($data);
        // die;

        return view('pages/transaction/Eform/infobilingual', $data);
    }

    public function perbaikan($hdrId)

 
    {

        $databil = DB::table('tbl_trn_formsys_hdr as a')
            ->join('tbl_trn_formsys_dtl as b', 'a.id', '=', 'b.hdr_id')
            ->leftjoin('tbl_mst_sys015a_subcategory as c', 'b.sub_category_id', '=', 'c.subcategory_id')
            ->leftjoin('tbl_mst_sys015a_category as d', 'd.category_id', '=', 'c.category_id')
            ->leftjoin('tbl_mst_sys015a as e', 'e.machine_id', '=', 'd.machine_id')
            ->select('a.nosurat', 'a.dept', 'a.month', 'a.code', 'a.mesin_id', 'b.days', 'b.status', 'b.hdr_id', 'b.id', 'e.machine_name', 'd.category_name', 'c.subcategory_name')
            ->where('b.hdr_id', $hdrId)
            ->where('b.status', false)
            ->get();


        $data = [
            'hasil_bilingual' => $databil,
        ];

        // echo json_encode($data);
        // die;
        return view('pages/transaction/Eform/bilingual', $data);
    }





    public function storebill(Request $request)
    {


        // echo json_encode($request->all());
        // die;
        // DB::beginTransaction();
        try {

            $cekhdr = Formsys_bilModel::where('hdrsys', $request->hdrsys)->first();


            if ($cekhdr) {
                $headerId = $cekhdr->id;
                $cekhdr->updated_by = $request->session()->get('username');
                $cekhdr->acknowledged_date = $request->acknowledged;
                $cekhdr->updated_by         = $request->session()->get('username');
                $cekhdr->checked_by         = $request->nameofcheck;
                $cekhdr->checked_id         = $request->idofcheck;
                $cekhdr->checked_date        = $request->dateofcheck;
                $cekhdr->position_check        = $request->positionofcheck;
                $cekhdr->acknowledged_by        = $request->nameofacknowledged;
                $cekhdr->acknowledged_id        = $request->idofacknowledged;
                $cekhdr->acknowledged_date        = $request->dateofacknowledged;
                $cekhdr->position_acknowledged        = $request->positionfacknowledged;
                $cekhdr->save();
            } else {
                $cekhdr = Formsys_bilModel::create([
                    'hdrsys'  => $request->hdrsys,
                    'nosurat' => $request->nosurat,
                    'dept'    => $request->dept,
                    'mesinid'    => $request->mesinid,
                    'mesinname'    => $request->mesinname,
                    'created_by' => $request->session()->get('username')
                ]);

                $headerId = $cekhdr->id;

                $inputharian = DB::table('tbl_trn_formsys_dtl')->where('hdr_id', $request->hdrsys, 'status', false)->update([
                    'statusperbaikan' => true,
                ]);
            }




            $data = [];
            foreach ($request->dtlsys as $key => $value) {
                $data[] = [
                    'hdr_id' => $headerId,
                    'dtlsys' => $value,
                    'perawatan' => $request->perawatan[$key],
                    'kerusakan' => $request->jeniskerusakan[$key],
                    'code' => $request->code[$key],
                    'tindakan' => $request->tindakan[$key],
                    'tanggal_sys' => $request->tanggal[$key],
                    'mulai' => $request->mulai[$key],
                    'selesai' => $request->selesai[$key],
                    'totaljam' => $request->totaljam[$key],
                    'keterangan' => $request->keterangan[$key],
                    'nama' => $request->nama[$key],
                    'paraf' => $request->paraf[$key]

                ];
            }


            // echo json_encode($data);
            // die;

            // Hapus data yang sudah ada berdasarkan headerId
            Formsys_bildtlModel::where('hdr_id', $headerId)->delete();

            // Insert data baru
            Formsys_bildtlModel::insert($data);


            // //  Log::debug('Request data: ' . json_encode($request->all()));
            // // DB::commit();

            return $this->httpResponse(200, 'Save Data Successfully', true);
            // }
        } catch (\Exception $e) {
            // DB::rollback();

            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }

    public function perbaikanView($hdr)
    {

        $databil = DB::table('tbl_formsys_bil_hdr as a')
            ->join('tbl_formsys_bil_dtl as b', 'a.id', '=', 'b.hdr_id')
            ->select('*')
            ->where('b.hdr_id', $hdr)
            ->get();


        $data = [
            'hasil_bilingual' => $databil,
        ];


        // echo json_encode($data);
        // die;
        return view('pages/transaction/Eform/perbaikanView', $data);
    }

    //------------------------------------------------------------END Bilingual-----------------------------------------------------------------------------


    //--------------------------------------------------------Start Verifikasi--------------------------------------------------------------------------------
    public function infoverifikasi()
    {

        $dtl = Formsys_bilModel::with(['bilingualDetail' => function ($query) {
            $query->where('statusverifikasi', false);
        }])
            ->get();

        $dataperbaikan = Formsys_verifModel::with('verifikasiDetail')->get();
        $data = [
            'dataperbaikan' => $dtl,
            'dataverifikasi' => $dataperbaikan
        ];

        // echo json_encode($data);
        // die;
        return view('pages/transaction/Eform/infoverifikasi', $data);
    }
    public function verifikasi($dtlId)
    {


        $data = [
            'verifikasi' => Formsys_bilModel::with(['bilingualDetail' => function ($query) use ($dtlId) {
                $query->where('dtlsys', $dtlId);
            }])->get()
        ];

        // echo json_encode($data['verifikasi']);
        // die;

        return view('pages/transaction/Eform/verifikasi', $data);
    }

    public function verifikasistore(Request $request)
    {


        // echo json_encode($request->all());
        // die;
        // DB::beginTransaction();
        try {

            $cekbilingual = Formsys_verifModel::where('hdrsys', $request->hdrsys)
                ->where('dtlsys', $request->dtlsys)
                ->first();


            if ($cekbilingual) {
                $headerId = $cekbilingual->id;
                $cekbilingual->creater  = $request->namebuat;
                $cekbilingual->jabatan_creater = $request->jabatanbuat;
                $cekbilingual->creater_date = $request->datebuat;
                $cekbilingual->checked_by = $request->namecek;
                $cekbilingual->jabatan_checker = $request->jabatancek;
                $cekbilingual->creater_date = $request->datecek;
                $cekbilingual->verived_by         = $request->nameveriv;
                $cekbilingual->verived_date          = $request->dateveriv;
                $cekbilingual->jabatan_veriver          = $request->jabatanveriv;
                $cekbilingual->updated_by         = $request->session()->get('username');
                $cekbilingual->updated_at         = now()->format('Y-m-d H:i:s');
                $cekbilingual->save();
            } else {
                $cekbilingual = Formsys_verifModel::create([
                    'hdrsys'  => $request->hdrsys,
                    'dtlsys'  => $request->dtlsys,
                    'idbilingual' => $request->idbilingual,
                    'dept' => $request->bagian,
                    'tanggalverif'    => $request->tanggalverifikasi,
                    'namamesin' => $request->namamesin,
                    'area' => $request->area,
                    'jam' => $request->jam,
                    'totaljam' => $request->totaljam,
                    'jeniskerusakan' => $request->kerusakan,
                    'tindakan' => $request->tindakan,
                    'code' => $request->kode,
                    'shift' => $request->shift,
                    'created_by' => $request->session()->get('username')
                ]);

                $headerId = $cekbilingual->id;
                $daftarperawatan = DB::table('tbl_formsys_bil_dtl')->where('dtlsys', $request->dtlsys)->update([
                    'statusverifikasi' => true,
                ]);
            }

            // echo json_encode($headerId);
            // die;

            // $dataQa = [];
            // foreach ($request->poin as $key => $sub) {
            //     if (isset($request->status[$sub]) && $request->status[$sub] != null) {
            //         $status = $request->status[$sub];
            //         foreach ($status as $index => $stat) {

            //             $dataQa[] = [
            //                 'hdr_id' => $headerId,
            //                 'status' => $status[$index]
            //             ];
            //         }
            //     }
            // }



            // echo json_encode($dataQa);
            // die;
            // // Hapus data yang sudah ada berdasarkan headerId
            // Formsys_verifdtlQAModel::where('hdr_id', $headerId)->delete();

            // // Insert data baru
            // Formsys_verifdtlQAModel::insert($dataQa);





            $data = [];

            foreach ($request->namaperalantan as $key => $value) {
                $qty = $request->qty[$key] ?? [];
                $keterangan = $request->keterangan[$key] ?? [];

                foreach ($value as $index => $namaperalatan) {
                    $qtyValue = isset($qty[$index]) ? $qty[$index] : null;
                    $currentKeterangan = isset($keterangan[$index]) ? $keterangan[$index] : null;

                    $data[] = [
                        'hdr_id' => $headerId,
                        'tabelid' => $key,
                        'namaperalatan' => $namaperalatan,
                        'qty' => $qtyValue,
                        'keterangan' => $currentKeterangan
                    ];
                }
            }




            // echo json_encode($data);
            // die;


            // Hapus data yang sudah ada berdasarkan headerId
            Formsys_verifdtlModel::where('hdr_id', $headerId)->delete();

            // Insert data baru
            Formsys_verifdtlModel::insert($data);


            // //  Log::debug('Request data: ' . json_encode($request->all()));
            // // DB::commit();

            return $this->httpResponse(200, 'Save Data Successfully', true);
            // }
        } catch (\Exception $e) {
            // DB::rollback();

            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }


    public function verifikasiqa(Request $request)
    {

        $dtlId = $request->dtl;
        // $dtlId = base64_decode($request->dtl);
        $data = [
            'verifikasi' => Formsys_bilModel::with(['bilingualDetail' => function ($query) use ($dtlId) {
                $query->where('dtlsys', $dtlId);
            }])->get()
        ];

        // echo json_encode($data['verifikasi']);
        // die;

        return view('pages/transaction/Eform/verifikasiQa', $data);
    }


    public function verifikasiQaStore(Request $request)
    {


        // echo json_encode($request->all());
        // die;
        // DB::beginTransaction();
        try {

            // $cekbilingual = Formsys_verifQaModel::where('hdrsys', $request->hdrsys)
            //     ->where('dtlsys', $request->dtlsys)
            //     ->first();



            // if ($cekbilingual) {
            //     $headerId = $cekbilingual->id;
            //     $cekbilingual->checked_by = $request->session()->get('username');
            //     $cekbilingual->verived_by         = $request->session()->get('username');
            //     $cekbilingual->updated_by         = $request->session()->get('username');
            //     $cekbilingual->updated_at         = now()->format('Y-m-d H:i:s');
            //     $cekbilingual->save();
            // //} else {



            //     $headerId = $cekbilingual->id;
            //     $daftarperawatan = DB::table('tbl_formsys_bil_dtl')->where('dtlsys', $request->dtlsys)->update([
            //         'statusverifikasi' => true,
            //     ]);
            // }

            // echo json_encode($headerId);
            // die;

            $data = [];

            foreach ($request->namaperalantan as $param => $values) {
                foreach ($values as $index => $namaperalatan) {
                    $data[] = [
                        'namaperalantan' => $namaperalatan,
                        'kode' => $request->kode[$param][$index],
                        'ketidaksesuaian' => $request->ketidaksesuaian[$param][$index],
                        'tindakan' => $request->tindakan[$param][$index],
                        'mulai' => $request->mulai[$param][$index],
                        'selesai' => $request->selesai[$param][$index],
                        'statusverifikasi' => $request->statusverifikasi[$param][$index],
                        'paraf' => $request->paraf[$param][$index]
                    ];
                }
            }

            // Lakukan sesuatu dengan array $data...



            // echo json_encode($data);
            // die;








            // // Hapus data yang sudah ada berdasarkan headerId
            // Formsys_verifdtlModel::where('hdr_id', $headerId)->delete();

            // // Insert data baru
            Formsys_verifQaModel::insert($data);


            // //  Log::debug('Request data: ' . json_encode($request->all()));
            // // DB::commit();

            return $this->httpResponse(200, 'Save Data Successfully', true);
            // }
        } catch (\Exception $e) {
            // DB::rollback();

            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }


    //---------------------------------------------------------------------End Verifikasi------------------------------------------------------------------------


    //----------------------------------------------------------------START MONITORING-----------------------------------------------------------------------------

    public function monitoring()
    {
        // $idawalhdr = $inputharian->pluck('id')->toArray();
        // $perbaikan = Formsys_bilModel::where('hdrsys', $idawalhdr)->with('bilingualDetail')->get();
        $inputharian = FormsysModel::with('FormsysDetail')->get();

        $idtlawal = $inputharian->pluck('FormsysDetail.*.id')->flatten()->toArray();
        $perbaikan = Formsys_bilModel::with(['bilingualDetail' => function ($query) use ($idtlawal) {
            $query->whereIn('dtlsys', $idtlawal);
        }])->get();

        $idperbaikan = $perbaikan->pluck('bilingualDetail.*.dtlsys')->flatten()->toArray();
        $verifikasi = Formsys_verifModel::whereIn('dtlsys', $idperbaikan)->with('verifikasiDetail')->get();



        $master = Form015aModel::with('fm015category', 'fm015category.Form015asubcategory')->get();

        // echo json_encode($master);
        // die;
        // echo "<pre>";
        // echo print_r($master);
        // echo "<pre>";


        $data['all'] = [
            'master' => $master,
            'inputwal' => $inputharian,
            'dtl_perbaikan' => $perbaikan,
            'dtl_verifikasi' => $verifikasi
        ];


        return view('pages/transaction/Eform/monitoring/monitoring', $data);
    }



    //-----------------------------------------------------------------END MONITORING------------------------------------------------------------------------------




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





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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
