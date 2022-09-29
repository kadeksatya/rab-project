<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {

            $data = Material::orderBy('created_at', 'desc');

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $action = '';

                    $action .= '<a href="' . route('material.edit', $data->kode_bm) . '" class="btn btn-white btn-sm" data-placement="bottom" data-bs-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">Edit</a>';

                    $action .= '<button class="btn btn-danger ml-1 btn-sm delete-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" data-url="' . route('material.destroy', $data->kode_bm) . '" data-id="' . $data->kode_bm . '">
                                        Delete
                                    </button>';

                    return $action;
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('Y-m-d');
                })
                ->rawColumns(['action', 'created_at'])
                ->make(true);
        } else {
            $data = Material::orderBy('created_at', 'desc');
            return view('admin.material.index', [
                'data' => $data,
                'page_name' => 'Material List'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.material.form',[
            'page_name' => 'Add Material'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $forms = $request->validate([
                'jenis_bahan' => ['required'],
                'nama_bahan' => ['required'],
                'satuan_bm' => ['required'],
                'harga_sbahan' => ['required'],
            ]);

            Material::create($forms);

            DB::commit();

            return redirect()->route('material.index')->with('message','Data berhasil disimpan !');


        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Material::where('kode_bm',$id)->first();
        return view('admin.material.form',[
            'page_name' => 'Add Material',
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {

            $forms = $request->validate([
                'jenis_bahan' => ['required'],
                'nama_bahan' => ['required'],
                'satuan_bm' => ['required'],
                'harga_sbahan' => ['required'],
            ]);

            Material::where('kode_bm', $id)->update($forms);

            DB::commit();

            return redirect()->route('material.index')->with('message','Data berhasil diubah !');


        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        } catch (\Exception $th) {
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Material::where('kode_bm', $id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
