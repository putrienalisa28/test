<?php

namespace App\Http\Controllers\Eform;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;
use App\Models\Eform\Form015aModel;

use App\Models\Eform\FormDeptModel;
use App\Models\Eform\FormDeptMesin_Model;
use App\Models\Transaction\FRM\FrmInputModel;
use App\Models\Transaction\Eform\tahunan\Formsystahunan;
use App\Models\Transaction\Eform\tahunan\Formsystahunandtl;
use App\Models\Transaction\Eform\tahunan\Formsys_perbaikanModel;
use App\Models\Transaction\Eform\tahunan\Formsys_perbaikandtlModel;
use App\Models\Transaction\Eform\tahunan\Formsys_veriftahunModel;
use App\Models\Transaction\Eform\tahunan\Formsys_verifdtltahunModel;

class FormsystahunController extends Controller
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
        $frminput = FrmInputModel::whereIn('form_id', [3, 31, 32, 33])->orderBy('urut', 'ASC')->get();
        $data = array(
            'forminput'    => $frminput,
        );

        return view('pages/transaction/Eformtahun/menu', $data);
    }
    public function index()
    {
        $data['Dept'] = FormDeptModel::select('id_dept', 'department')->get();

        return view('pages/transaction/Eformtahun/index', $data);
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
            ->where("jenisform", 3)
            ->with('Peralatan')
            ->get();

        return response()->json([
            'listTk' => $dataTk,
            'listPeralatan' => $peralatan
        ]);
    }

    //------------------------------------------------------------START INPUT--------------------------------------

    public function store(Request $request)
    {


        // echo json_encode($request->all());
        // die;
        DB::beginTransaction();
        try {
            # Insert Header
            $insertHeader = Formsystahunan::where([
                'mesin_id' => $request->mesinid,
                'dept' => $request->department
            ])->whereYear('tahun', dateFormater($request->tahun, 'Y'))->first();

            // echo json_encode($insertHeader);
            // die;

            if ($insertHeader) {
                $headerId = $insertHeader->id;
                $insertHeader->updated_by = $request->session()->get('username');
                $insertHeader->created_by = $request->session()->get('username');
                $insertHeader->save();
            } else {
                $nosurat = str_replace('NO : ', '', $request->nosurat);
                $insertHeader = Formsystahunan::create([
                    'mesin_id' => $request->mesinid,
                    'dept' => $request->department,
                    'tahun' => $request->tahun,
                    'code' => $request->code,
                    'nosurat' => $nosurat,
                    'created_by' => $request->session()->get('username')
                ]);

                $headerId = $insertHeader->id;
            }



            $data = [];
            foreach ($request->subcategory_id as $key => $sub) {
                if (isset($request->status[$sub]) && $request->status[$sub] != null) {
                    $status = $request->status[$sub];

                    foreach ($status as $index => $stat) {
                        $data[] = [
                            'hdr_id' =>   $headerId,
                            'subcategory_id' => $sub,
                            'frequency' => $request->frequency[$sub],
                            'plan' => $request->plan[$sub][$index],
                            'realisasi' => $request->realisasi[$sub][$index],
                            'status' => $stat,
                            'bulan' => $index,
                            'statustpm' => $request->statustpm[$sub][$index],
                            'nama' => $request->namaparaf[$sub][$index]
                        ];
                    }
                }
            }


            // echo json_encode($data);
            // die;
            // Hapus data yang sudah ada berdasarkan headerId
            Formsystahunandtl::where('hdr_id', $headerId)->delete();

            // Insert data baru
            Formsystahunandtl::insert($data);

            DB::commit();
            return $this->httpResponse(200, 'Save Data Successfully', true);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }
    //-----------------------------------------------END HARIAN---------------------------------------------------------------------------

    //----------------------start perbaikan-------------------------------------------------------------------------------------------------

    public function infoperbaikan()
    {

        $dtl = DB::table('tbl_formsys_tahun_dtl as b')
            ->leftjoin('tbl_mst_sys015a_subcategory as c', 'b.subcategory_id', '=', 'c.subcategory_id')
            ->leftjoin('tbl_mst_sys015a_category as d', 'd.category_id', '=', 'c.category_id')
            ->leftjoin('tbl_mst_sys015a as e', 'e.machine_id', '=', 'd.machine_id')
            ->select('b.hdr_id', 'b.bulan', 'e.machine_name', 'd.category_name', 'c.subcategory_name')
            ->where('b.statustpm', '!=', null)
            ->where('b.statusperbaikan', false)
            ->get();


        $ids = $dtl->pluck('hdr_id')->toArray();
        $data['perbaikan'] = [
            'hdr' => Formsystahunan::whereIn('id', $ids)->get(),
            'dtl-perbaikan' => $dtl

        ];



        return view('pages/transaction/Eformtahun/infoperbaikan', $data);
    }
    public function perbaikan($hdrId)
    {

        $dataperbaikan = DB::table('tbl_formsys_tahun_hdr as a')
            ->join('tbl_formsys_tahun_dtl as b', 'a.id', '=', 'b.hdr_id')
            ->leftjoin('tbl_mst_sys015a_subcategory as c', 'b.subcategory_id', '=', 'c.subcategory_id')
            ->leftjoin('tbl_mst_sys015a_category as d', 'd.category_id', '=', 'c.category_id')
            ->leftjoin('tbl_mst_sys015a as e', 'e.machine_id', '=', 'd.machine_id')
            ->select('a.nosurat', 'a.dept',  'a.code', 'a.mesin_id',  'b.hdr_id', 'b.id', 'e.machine_name', 'd.category_name', 'c.subcategory_name')
            ->where('b.hdr_id', $hdrId)
            ->where('b.statustpm', '!=', null)
            ->where('b.statusperbaikan', false)
            ->get();


        $data = [
            'hasil_perbaikan' => $dataperbaikan,
        ];

        // echo json_encode($data);
        // die;

        return view('pages/transaction/Eformtahun/perbaikan', $data);
    }

    public function storeperbaikan(Request $request)
    {


        // echo json_encode($request->all());
        // die;
        // DB::beginTransaction();
        try {

            $cekhdr = Formsys_perbaikanModel::where('hdrsys', $request->hdrsys)->first();


            if ($cekhdr) {
                $headerId = $cekhdr->id;
                $cekhdr->updated_by = $request->session()->get('username');
                $cekhdr->acknowledged_date = $request->acknowledged;
                $cekhdr->updated_by         = $request->session()->get('username');
                $cekhdr->checked_by         = $request->nameofcheck;
                $cekhdr->save();
            } else {
                $cekhdr = Formsys_perbaikanModel::create([
                    'hdrsys'  => $request->hdrsys,
                    'nosurat' => $request->nosurat,
                    'dept'    => $request->dept,
                    'created_by' => $request->session()->get('username')
                ]);

                $headerId = $cekhdr->id;

                $inputtahunan = DB::table('tbl_formsys_tahun_dtl')
                    ->where('hdr_id', $request->hdrsys)
                    ->whereNotNull('statustpm')
                    ->update([
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


            // Hapus data yang sudah ada berdasarkan headerId
            Formsys_perbaikandtlModel::where('hdr_id', $headerId)->delete();

            // Insert data baru
            Formsys_perbaikandtlModel::insert($data);


            // //  Log::debug('Request data: ' . json_encode($request->all()));
            // // DB::commit();

            return $this->httpResponse(200, 'Save Data Successfully', true);
            // }
        } catch (\Exception $e) {
            // DB::rollback();

            return $this->httpResponse(500, $e->getMessage(), false);
        }
    }
    //------------------------------------------------------------------------END PERBAIKAN------------------------------------

    //------------------------------------------------------------------------start verifikasi-----------------------------------------------------
    public function infoverifikasi()
    {

        $dtl = Formsys_perbaikanModel::with(['perbaikanDetail' => function ($query) {
            $query->where('statusverifikasi', false);
        }])
            ->get();


        $data = [
            'dtlverifikasi' => $dtl
        ];

        // echo json_encode($data);
        // die;
        return view('pages/transaction/Eformtahun/infoverifikasi', $data);
    }
    public function verifikasi($dtlId)
    {

        $data = [
            'verifikasi' => Formsys_perbaikanModel::with(['perbaikanDetail' => function ($query) use ($dtlId) {
                $query->where('dtlsys', $dtlId);
            }])->get()
        ];

        // echo json_encode($data['verifikasi']);
        // die;

        return view('pages/transaction/Eformtahun/verifikasitahun', $data);
    }

    public function verifikasistore(Request $request)
    {


        // echo json_encode($request->all());
        // die;
        // DB::beginTransaction();
        try {

            $cekbilingual = Formsys_veriftahunModel::where('hdrsys', $request->hdrsys)
                ->where('dtlsys', $request->dtlsys)
                ->first();



            if ($cekbilingual) {
                $headerId = $cekbilingual->id;
                $cekbilingual->checked_by = $request->session()->get('username');
                $cekbilingual->verived_by         = $request->session()->get('username');
                $cekbilingual->updated_by         = $request->session()->get('username');
                $cekbilingual->updated_at         = now()->format('Y-m-d H:i:s');
                $cekbilingual->save();
            } else {
                $cekbilingual = Formsys_veriftahunModel::create([
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
                $daftarperawatan = DB::table('tbl_formsys_perbaikan_dtl')->where('dtlsys', $request->dtlsys)->update([
                    'statusverifikasi' => true,
                ]);
            }

            // echo json_encode($headerId);
            // die;



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
            Formsys_verifdtltahunModel::where('hdr_id', $headerId)->delete();

            // Insert data baru
            Formsys_verifdtltahunModel::insert($data);


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

        // $dtlId = $request->dtl;
        // // $dtlId = base64_decode($request->dtl);
        // $data = [
        //     'verifikasi' => Formsys_bilModel::with(['bilingualDetail' => function ($query) use ($dtlId) {
        //         $query->where('dtlsys', $dtlId);
        //     }])->get()
        // ];

        // echo json_encode($data['verifikasi']);
        // die;

        return view('pages/transaction/Eformtahun/verifikasiQa');
    }


    //----------------------------------------------------------------START MONITORING-----------------------------------------------------------------------------

    public function monitoring()
    {

        $inputtahunan = Formsystahunan::with('Formsystahunandtl')->get();

        $idtlawal = $inputtahunan->pluck('Formsystahunandtl.*.id')->flatten()->toArray();
        $perbaikan = Formsys_perbaikanModel::with(['perbaikanDetail' => function ($query) use ($idtlawal) {
            $query->whereIn('dtlsys', $idtlawal);
        }])->get();

        $idperbaikan = $perbaikan->pluck('perbaikanDetail.*.dtlsys')->flatten()->toArray();
        $verifikasi = Formsys_veriftahunModel::whereIn('dtlsys', $idperbaikan)->with('verifikasiDetail')->get();



        $master = Form015aModel::with('fm015category', 'fm015category.Form015asubcategory')->get();


        // echo "<pre>";
        // echo print_r($master);
        // echo "<pre>";


        $data['all'] = [
            'master' => $master,
            'inputwal' => $inputtahunan,
            'dtl_perbaikan' => $perbaikan,
            'dtl_verifikasi' => $verifikasi
        ];

        // echo json_encode($data['all']['inputwal']);
        // die;


        return view('pages/transaction/Eformtahun/monitoringtahun', $data);
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
