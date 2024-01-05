<?php

namespace App\Http\Controllers\Eform;

use PDF;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Eform\Form015aModel;
use Carbon\Carbon;
use App\Models\Transaction\Frm\FrmInputModel;
use App\Models\Transaction\Eform\FormsysModel;
use App\Models\Transaction\Eform\FormsysdtlModel;
use App\Models\Transaction\Eform\Formsys_bilModel;
use App\Models\Transaction\Eform\Formsys_bildtlModel;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifModel;
use App\Models\Transaction\Eform\verifikasi\Formsys_verifdtlModel;
use TCPDF;

class FormsysprintoutController extends Controller
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





    // public function printinput($id)
    // {


    //     $formsys = FormsysModel::where('id', $id)->with('FormsysDetail')->first();

    //     // Buat instance TCPDF
    //     $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');

    //     // Atur properti PDF
    //     $pdf->SetCreator('My Application');
    //     $pdf->SetTitle('Print Input');

    //     // Buat halaman PDF
    //     $pdf->AddPage();

    //     // Set font yang akan digunakan
    //     $pdf->SetFont('helvetica', '', 10);

    //     // Tampilkan logo dan judul perusahaan menggunakan Cell
    //     // $logo = public_path('img/logo-01042022.png');
    //     // $pdf->Image($logo, 10, 10, 30, 0, '', '', '', false, 300);
    //     $pdf->Cell(0, 10, 'PT RIAU SAKTI UNITED PLANTATIONS', 0, 1, 'C');


    //     // Tampilkan judul tabel menggunakan MultiCell
    //     $judul = 'DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/ PENGGANTIAN' . "\n" .
    //         '(MAINTENANCE CHECKLIST AND REPAIR/REPLACEMENT RECORD)';
    //     $pdf->MultiCell(0, 10, $judul, 0, 'C');

    //     // Tampilkan halaman menggunakan Cell
    //     $pdf->Cell(0, 10, 'HAL : 1 DARI 2', 0, 1, 'C');
    //     $pdf->Cell(0, 10, '(Pages) 1 of 2', 0, 1, 'C');

    //     // Tampilkan PDF di web
    //     $pdf->Output('document.pdf', 'I');
    // }


    public function printinput($id)
    {


        $formsys = FormsysModel::where('id', $id)->with('FormsysDetail')->first();

        // Buat instance TCPDF
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');

        // Atur properti PDF
        $pdf->SetCreator('My Application');
        $pdf->SetTitle('Print Input');

        // Buat halaman PDF
        $pdf->AddPage();

        // Set font yang akan digunakan
        $pdf->SetFont('helvetica', '', 10);

        // Tampilkan logo dan judul perusahaan menggunakan Cell
        // $logo = public_path('img/logo-01042022.png');
        // $pdf->Image($logo, 10, 10, 30, 0, '', '', '', false, 300);
        $pdf->Cell(0, 10, 'PT RIAU SAKTI UNITED PLANTATIONS', 0, 1, 'C');


        // Tampilkan judul tabel menggunakan MultiCell
        $judul = 'DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/ PENGGANTIAN' . "\n" .
            '(MAINTENANCE CHECKLIST AND REPAIR/REPLACEMENT RECORD)';
        $pdf->MultiCell(0, 10, $judul, 0, 'C');

        // Tampilkan halaman menggunakan Cell
        $pdf->Cell(0, 10, 'HAL : 1 DARI 2', 0, 1, 'C');
        $pdf->Cell(0, 10, '(Pages) 1 of 2', 0, 1, 'C');

        // Tampilkan PDF di web
        $pdf->Output('document.pdf', 'I');
    }










    // public function printinput(Request $request)
    // {
    //     $hdrId = $request->id;

    //     $formsys = FormsysModel::where('id', $hdrId)->with('FormsysDetail')->first();

    //     // Buat instance Dompdf
    //     $dompdf = new Dompdf();

    //     // Buat HTML yang akan dikonversi menjadi PDF
    //     $html = '
    //       <html>
    //       <body>
    //           <table style="border-collapse: collapse;" border="1">
    //               <tr style="text-align: center;">
    //                   <th rowspan="3"><img src="' . public_path('img/logo-01042022.png') . '"></th>
    //                   <th>PT RIAU SAKTI UNITED PLANTATIONS</th>
    //                   <th>' . $formsys->nosurat . '</th>
    //               </tr>
    //               <tr style="text-align: center;">
    //                   <th>
    //                       <span style="display: block;">DAFTAR CEK PERAWATAN DAN CATATAN PERBAIKAN/ PENGGANTIAN</span>
    //                       <span><em>(MAINTENANCE CHECKLIST AND REPAIR/REPLACEMENT RECORD)</em></span>
    //                   </th>
    //                   <th>
    //                       <span style="display: block;">HAL : 1 DARI 2</span>
    //                       <span><em>(Pages) 1 of 2</em></span>
    //                   </th>
    //               </tr>
    //           </table>
    //           <table style="border-collapse: collapse;" border="1">
    //               <tr>
    //                   <th> <span style="display: block;">Nama Peralatan/Mesin</span>
    //                       <span><em>(Name of Equipment/ Machine)</em></span>
    //                       ' . $formsys->mesin_id . '
    //                   </th>
    //                   <th> <span style="display: block;">Kode (Code) : ' . $formsys->code . '</th>
    //               </tr>
    //           </table>
    //           <table style="border-collapse: collapse;" border="1">
    //               <thead style="text-align:center;">
    //                   <tr>
    //                       <th rowspan="2" style="width: 50px;">No</th>
    //                       <th rowspan="2" style="width: 100px;"> <span style="display: block;">Bagian
    //                               yang
    //                               diperiksa </span>
    //                           <span><em>(Part to Check)</em></span>
    //                       </th>
    //                       <th class="tanggal">Tanggal (Date)</th>
    //                       <th> <span style="display: block;">KETERANGAN</span>
    //                           <span><em>(Remarks)</em></span>
    //                       </th>
    //                   </tr>
    //                   <tr>';

    //     foreach ($formsys->FormsysDetail as $x) {
    //         $html .= '<th class="tanggal">' . $x->days . '</th>';
    //     }

    //     $html .= '</tr>
    //           </thead>
    //           <tbody>
    //           </tbody>
    //       </table>
    //       </body>
    //       </html>';

    //     // Load HTML ke Dompdf
    //     $dompdf->loadHtml($html);

    //     // Set ukuran dan orientasi kertas
    //     $dompdf->setPaper('A4', 'landscape');

    //     // Render HTML menjadi PDF
    //     $dompdf->render();

    //     // Menghasilkan tampilan PDF di halaman web
    //     $output = $dompdf->output();
    //     return response($output, 200, [
    //         'Content-Type' => 'application/pdf',
    //         'Content-Disposition' => 'inline; filename="document.pdf"',
    //     ]);
    // }













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
