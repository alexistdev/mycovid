<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class GejalaController extends Controller
{
    protected $users;
    protected $role;
    protected $kode;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users=Auth::user();
            $this->role=User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    /** route: admin.gejala */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $gejala = Gejala::orderBy('id','DESC')
                ->get();
            return Datatables::of($gejala)
                ->addIndexColumn()
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.editgejala',$row->id).'" class="edit btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i> EDIT</a>';
                    $btn2 = $btn. '<a href="#" target="_blank" data-id="'.$row->id.'" class="hapus-Modal btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus"><i class="fas fa-trash"></i> HAPUS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.gejala',array(
            'judul' => "Dashboard Administrator | MyCovid V.1.0",
            'aktifTag' => "gejala",
            'tagSubMenu' => "gejala",
        ));
    }

    /** route: admin.addgejala */
    public function create()
    {
        return view('admin.formgejala',array(
            'judul' => "Master Data Gejala Administrator | MyCovid V.1.0",
            'aktifTag' => "gejala",
            'tagSubMenu' => "gejala",
            'tag' => 'add',
        ));
    }

    /** route: admin.savegejala */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:gejalas|max:255',
        ]);

        $dataGejala = Gejala::first();
        if($dataGejala->count() != 0){
            $dataKode = Gejala::max('kode');
            $kode =   (int) filter_var($dataKode, FILTER_SANITIZE_NUMBER_INT);
            $gejala = new Gejala();
            $gejala->kode = 'G0' . ($kode + 1);
            $gejala->name = $request->name;
            $gejala->save();
        } else {
            $gejala = new Gejala();
            $gejala->kode = 'G01';
            $gejala->name = $request->name;
            $gejala->save();
        }
        notify()->success('Anda berhasil menambah data gejala');
        return redirect(route('admin.gejala'));
    }

    /** route:admin.editgejala */
    public function edit($id)
    {
        $gejala = Gejala::findOrFail($id);
        return view('admin.formgejala',array(
            'judul' => "Master Data Gejala Administrator | MyCovid V.1.0",
            'aktifTag' => "gejala",
            'tagSubMenu' => "gejala",
            'tag' => 'edit',
            'idEdit' => $id,
            'name' => $gejala->name,
        ));
    }

    /** route:admin.updategejala */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|max:255',
        ]);
        Gejala::where('id',$request->id)->update([
            'name' => $request->name,
        ]);
        notify()->success('Anda berhasil mengupdate data gejala');
        return redirect(route('admin.editgejala',$request->id));
    }

    /** route:admin.deletegejala */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $gejala = Gejala::findOrFail($request->id);
        $gejala->delete();
        notify()->success('Anda berhasil menghapus data gejala!');
        return redirect(route('admin.gejala'));
    }
}
