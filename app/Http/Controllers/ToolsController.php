<?php

namespace App\Http\Controllers;

use App\Models\Tools;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\DB;

class ToolsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->type == 'datatable') {

            $data = Tools::orderBy('created_at', 'desc')->get();

            return Datatables::of($data)
                ->addColumn('action', function ($data) {
                    $action = '';

                    $action .= '<a href="' . route('tool.edit', $data->kode_alat) . '" class="btn btn-white btn-sm" data-placement="bottom" data-bs-toggle="tooltip" data-placement="bottom" title="Edit" data-original-title="Edit">Edit</a>';

                    $action .= '<button class="btn btn-danger ml-1 btn-sm delete-item" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Delete" data-url="' . route('tool.destroy', $data->kode_alat) . '" data-id="' . $data->kode_alat . '">
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
            $data = Tools::orderBy('created_at', 'desc');
            return view('admin.tool.index', [
                'data' => $data,
                'page_name' => 'Tools List'
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
        return view('admin.tool.form',[
            'page_name' => 'Add Tools'
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
                'jenis_alat' => ['required'],
                'kapasitas' => ['required'],
                'biaya_sewa' => ['required'],
            ]);

            Tools::create($forms);

            DB::commit();

            return redirect()->route('tool.index')->with('message','Data berhasil disimpan !');


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
        $data = Tools::where('kode_alat',$id)->first();
        return view('admin.tool.form',[
            'page_name' => 'Add Tools',
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
                'jenis_alat' => ['required'],
                'kapasitas' => ['required'],
                'biaya_sewa' => ['required'],
            ]);

            Tools::where('kode_alat', $id)->update($forms);

            DB::commit();

            return redirect()->route('tool.index')->with('message','Data berhasil diubah !');


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
        Tools::where('kode_alat', $id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
