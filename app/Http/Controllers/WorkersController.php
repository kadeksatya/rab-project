<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Salary;
use App\Models\Tools;
use App\Models\WorkerDetail;
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

                    $action .= '<a href="' . route('workers.edit', $data->kode_hps) . '" class="btn btn-white btn-sm" data-placement="bottom" data-bs-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">Edit</a>';

                    $action .= '<button class="btn btn-danger ml-1 btn-sm delete-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" data-url="' . route('workers.destroy', $data->kode_hps) . '" data-id="' . $data->kode_hps . '">
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
            return view('admin.workers.index', [
                'data' => $data,
                'page_name' => 'Harga Satuan Pekerjaan'
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
        $dataMaterial = Material::all();
        $dataTools = Tools::all();
        $dataSalary = Salary::all();

        return view('admin.workers.form',[
            'material' => $dataMaterial,
            'tool' => $dataTools,
            'salary' => $dataSalary,
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
                'jenis_p' => ['required'],
                'nama_p' => ['required'],
            ]);


            $ids = Workers::create($forms);

            $details = $request->harga;

            foreach ($details as $index => $value) {
                WorkerDetail::create([
                    'kode_hps' => $ids->kode_hps,
                    'koefisien' => $request->koefisien[$index],
                    'kode_bm' => $request->kode_bm[$index],
                    'kode_alat' => $request->kode_alat[$index],
                    'kode_p' => $request->kode_p[$index],
                    'harga_satuan' => $request->harga_satuan[$index],
                    'satuan' => $request->satuan[$index],
                    'harga' => $request->harga[$index]
                ]);
            }

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
                'jenis_p' => ['required'],
                'nama_p' => ['required'],
            ]);

            Workers::where('kode_hps', $id)->update($forms);

            WorkerDetail::where('kode_hps', $id)->delete();

            $details = $request->harga;

            foreach ($details as $index => $value) {
                WorkerDetail::create([
                    'kode_hps' => $id,
                    'koefisien' => $request->koefisien[$index],
                    'kode_bm' => $request->kode_bm[$index],
                    'kode_alat' => $request->kode_alat[$index],
                    'kode_p' => $request->kode_p[$index],
                    'harga_satuan' => $request->harga_satuan[$index],
                    'satuan' => $request->satuan[$index],
                    'harga' => $request->harga[$index]
                ]);
            }


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
