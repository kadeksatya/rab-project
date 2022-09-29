<?php

namespace App\Http\Controllers;

use App\Models\Workers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\DB;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {

            $data = Workers::orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $action = '';

                    $action .= '<a href="' . route('workers.edit', $data->id) . '" class="btn btn-white btn-sm" data-placement="bottom" data-bs-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">Edit</a>';

                    $action .= '<button class="btn btn-danger ml-1 btn-sm delete-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" data-url="' . route('workers.destroy', $data->id) . '" data-id="' . $data->id . '">
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
            $data = Workers::orderBy('created_at', 'desc');
            return view('outlet.workers.index', [
                'data' => $data,
                'page_name' => 'Workers List'
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
        return view('admin.workers.form',[
            'page_name' => 'Add Workers Data'
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
                'kode_bm' => ['required'],
                'kode_alat' => ['required'],
                'kode_p' => ['required'],
                'kode_uk' => ['required'],
                'koefisien' => ['required'],
                'jenis_p' => ['required'],
                'nama_p' => ['required'],
                'nama_bahan' => ['required'],
                'pekerja' => ['required'],
                'jenis_alat' => ['required'],
                'satuan_hps' => ['required'],
                'hargas_bahan' => ['required'],
                'hargas_uk' => ['required'],
                'biaya_sewa' => ['required'],
                'harga_satuan' => ['required'],
            ]);

            Workers::create($forms);

            DB::commit();

            return redirect()->route('workers.index')->with('message','Data berhasil disimpan !');


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
        $data = Workers::where('kode_hps',$id)->first();
        return view('admin.workers.form',[
            'page_name' => 'Edit Workers Data',
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
                'kode_bm' => ['required'],
                'kode_alat' => ['required'],
                'kode_p' => ['required'],
                'kode_uk' => ['required'],
                'koefisien' => ['required'],
                'jenis_p' => ['required'],
                'nama_p' => ['required'],
                'nama_bahan' => ['required'],
                'pekerja' => ['required'],
                'jenis_alat' => ['required'],
                'satuan_hps' => ['required'],
                'hargas_bahan' => ['required'],
                'hargas_uk' => ['required'],
                'biaya_sewa' => ['required'],
                'harga_satuan' => ['required'],
            ]);

            Workers::where('kode_hps', $id)->update($forms);

            DB::commit();

            return redirect()->route('workers.index')->with('message','Data berhasil diubah !');


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
        Workers::where('kode_hps', $id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
