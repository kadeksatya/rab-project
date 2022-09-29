<?php

namespace App\Http\Controllers;

use App\Models\Rabs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Datatables;

class RabsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {

            $data = Rabs::orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $action = '';

                    $action .= '<a href="' . route('rabs.edit', $data->id) . '" class="btn btn-white btn-sm" data-placement="bottom" data-bs-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">Edit</a>';

                    $action .= '<button class="btn btn-danger ml-1 btn-sm delete-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" data-url="' . route('rabs.destroy', $data->id) . '" data-id="' . $data->id . '">
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
            $data = Rabs::orderBy('created_at', 'desc');
            return view('outlet.rabs.index', [
                'data' => $data,
                'page_name' => 'RAB List'
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
        return view('admin.rabs.form',[
            'page_name' => 'Add RAB Data'
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
                'kode_hps' => ['required'],
                'kode_p' => ['required'],
                'nama_proyek' => ['required'],
                'tanggal_p' => ['required'],
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


            Rabs::create($forms);

            DB::commit();

            return redirect()->route('rabs.index')->with('message','Data berhasil disimpan !');


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
        $data = Rabs::where('kode_rab',$id)->first();
        return view('admin.rabs.form',[
            'page_name' => 'Edit RAB Data',
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
                'kode_hps' => ['required'],
                'kode_p' => ['required'],
                'nama_proyek' => ['required'],
                'tanggal_p' => ['required'],
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

            Rabs::where('kode_rab', $id)->update($forms);

            DB::commit();

            return redirect()->route('rabs.index')->with('message','Data berhasil diubah !');


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
        Rabs::where('kode_rab', $id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
