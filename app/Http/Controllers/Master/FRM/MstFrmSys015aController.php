<?php

namespace App\Http\Controllers\Master\FRM;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Master\FRM\CategoryModel;
use App\Models\Master\FRM\SubCategoryModel;
use App\Models\Master\FRM\Sys015aMachineModel;

class MstFrmSys015aController extends Controller
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
    public function index()
    {
        $data = array(
            'peralatan' => Sys015aMachineModel::with('fm015category', 'fm015category.Form015asubcategory')
                           ->orderBy('machine_id')->get()
        );


        return view('pages/master/FRM/index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->id_peralatan;
        $category = $request->id_category;
        $subcategory = $request->id_subcategory;
        try {
            if ($id > 0 && $category =='' &&  $subcategory =='') {
                // Find the machine by ID
                $Machine = Sys015aMachineModel::find($id);

                // Check if the machine exists
                if (!$Machine) {
                    return $this->httpResponse(404, 'Data Not Found', false);
                }
                $action = "Update";
            }else if($id > 0 && $category > 0 &&  $subcategory ==''){
                $Category = CategoryModel::find($category);

                // Check if the category exists
                if (!$Category) {
                    return $this->httpResponse(404, 'Data Not Found', false);
                }
                $action = "Update";
                $Category->machine_id = $id;
                $Category->category_name = $request->deskripsi;
            }else if($id > 0 && $category > 0 &&  $subcategory > 0){
                $SubCategory = SubCategoryModel::find($subcategory);

                // Check if the subcategory exists
                if (!$SubCategory) {
                    return $this->httpResponse(404, 'Data Not Found', false);
                }
                $action = "Update";
            } else {

                $Machine = new Sys015aMachineModel;
                $action = "Save";
            }

            if($id > 0 && $category > 0 &&  $subcategory ==''){
                $Category->machine_id = $id;
                $Category->category_name = $request->deskripsi;
                $Category->save();
    
                if ($Category->category_id) {
                    return $this->httpResponse(200, "$action Data Successfully", $Category);
                }
            }else if($id > 0 && $category > 0 &&  $subcategory > 0){
                $SubCategory->category_id = $category;
                $SubCategory->subcategory_name = $request->deskripsi;
                $SubCategory->save();
    
                if ($SubCategory->subcategory_id) {
                    return $this->httpResponse(200, "$action Data Successfully", $SubCategory);
                }
            }else{
                $Machine->machine_name = $request->deskripsi;
                $Machine->save();
    
                if ($Machine->machine_id) {
                    return $this->httpResponse(200, "$action Data Successfully", $Machine);
                }
            }

        } catch (\Throwable $e) {
            return $this->httpResponse(400, $e->getMessage(), false);
        }
    }
    
    public function store2(Request $request)
    {
        try {
            $Category = new CategoryModel;
            $action = "Save";

            $Category->machine_id = $request->id_peralatan2;
            $Category->category_name = $request->deskripsi2;
            $Category->save();

            if ($Category->category_id) {
                return $this->httpResponse(200, "$action Data Successfully", $Category);
            }
        } catch (\Throwable $e) {
            return $this->httpResponse(400, $e->getMessage(), false);
        }
    }

    public function store3(Request $request)
    {
        try {
            $SubCategory = new SubCategoryModel;
            $action = "Save";

            $SubCategory->category_id = $request->id_category3;
            $SubCategory->subcategory_name = $request->deskripsi3;
            $SubCategory->save();

            if ($SubCategory->subcategory_id) {
                return $this->httpResponse(200, "$action Data Successfully", $SubCategory);
            }
        } catch (\Throwable $e) {
            return $this->httpResponse(400, $e->getMessage(), false);
        }
    }
}
