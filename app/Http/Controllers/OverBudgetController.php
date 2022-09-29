<?php

namespace App\Http\Controllers;

use App\Models\OverBudget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\DB;

class OverBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {

            $data = OverBudget::orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $action = '';

                    $action .= '<a href="' . route('overbudget.edit', $data->id) . '" class="btn btn-white btn-sm" data-placement="bottom" data-bs-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">Edit</a>';

                    $action .= '<button class="btn btn-danger ml-1 btn-sm delete-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" data-url="' . route('overbudget.destroy', $data->id) . '" data-id="' . $data->id . '">
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
            $data = Overbudget::orderBy('created_at', 'desc');
            return view('outlet.overbudget.index', [
                'data' => $data,
                'page_name' => 'Overbudget List'
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
        return view('admin.overbudget.form',[
            'page_name' => 'Add Overbudget Data'
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
                'kode_rab' => ['required'],
                'kode_hps' => ['required'],
                'kode_p' => ['required'],
                'nama_proyek' => ['required'],
                'tanggal_ovb' => ['required'],
                'volume' => ['required'],
                'jenis_p' => ['required'],
                'nama_p' => ['required'],
                'satuan_rab' => ['required'],
                'harga_satuan' => ['required'],
                'jumlah_harga' => ['required'],
                'biaya_jasak' => ['required'],
                'real_cost' => ['required'],
                'jml_dibulatkan' => ['required'],
            ]);


            OverBudget::create($forms);

            DB::commit();

            return redirect()->route('overbudget.index')->with('message','Data berhasil disimpan !');


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
    public function show()
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
        $data = OverBudget::where('kode_ovb',$id)->first();
        return view('admin.overBudget.form',[
            'page_name' => 'Edit OverBudget Data',
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
                'kode_rab' => ['required'],
                'kode_hps' => ['required'],
                'kode_p' => ['required'],
                'nama_proyek' => ['required'],
                'tanggal_ovb' => ['required'],
                'volume' => ['required'],
                'jenis_p' => ['required'],
                'nama_p' => ['required'],
                'satuan_rab' => ['required'],
                'harga_satuan' => ['required'],
                'jumlah_harga' => ['required'],
                'biaya_jasak' => ['required'],
                'real_cost' => ['required'],
                'jml_dibulatkan' => ['required'],
            ]);

            OverBudget::where('kode_ovb', $id)->update($forms);

            DB::commit();

            return redirect()->route('overbudget.index')->with('message','Data berhasil diubah !');


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
        OverBudget::where('kode_ovb', $id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
