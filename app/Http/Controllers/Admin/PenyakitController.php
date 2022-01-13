<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Penyakit;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PenyakitController extends Controller
{
    protected $users;
    protected $role;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->users=Auth::user();
            $this->role=User::with('role')->find($this->users->id)->role;
            return $next($request);
        });
    }

    /** route: admin.penyakit */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $penyakit = Penyakit::orderBy('id','DESC')
                ->get();
            return Datatables::of($penyakit)
                ->addIndexColumn()
                ->editColumn('created_at', function($data){
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s');
                    return $formatedDate;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="'.route('admin.editpenyakit',$row->id).'" class="edit btn btn-primary btn-sm m-1"><i class="fas fa-edit"></i> EDIT</a>';
                    $btn2 = $btn. '<a href="#" target="_blank" data-id="'.$row->id.'" class="hapus-Modal btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#modalHapus"><i class="fas fa-trash"></i> HAPUS</a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.penyakit',array(
            'judul' => "Dashboard Administrator | MyCovid V.1.0",
            'aktifTag' => "penyakit",
            'tagSubMenu' => "penyakit",
        ));
    }

    /** route: admin.addpenyakit */
    public function create()
    {
        return view('admin.formpenyakit',array(
            'judul' => "Master Data Penyakit Administrator | MyCovid V.1.0",
            'aktifTag' => "penyakit",
            'tagSubMenu' => "penyakit",
            'tag' => 'add',
        ));
    }

    /** route: admin.savepenyakit */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:penyakits|max:255',
        ]);

        $penyakit = new Penyakit();
        $penyakit->name = $request->name;
        $penyakit->save();
        notify()->success('Anda berhasil menambah data penyakit');
        return redirect(route('admin.penyakit'));
    }

    /** route:admin.editpenyakit */
    public function edit($id)
    {
        $penyakit = Penyakit::findOrFail($id);
        return view('admin.formpenyakit',array(
            'judul' => "Master Data Penyakit Administrator | MyCovid V.1.0",
            'aktifTag' => "penyakit",
            'tagSubMenu' => "penyakit",
            'tag' => 'edit',
            'idEdit' => $id,
            'name' => $penyakit->name,
        ));
    }

    /** route:admin.updatepenyakit */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required|max:255',
        ]);
        Penyakit::where('id',$request->id)->update([
            'name' => $request->name,
        ]);
        notify()->success('Anda berhasil mengupdate data penyakit');
        return redirect(route('admin.editpenyakit',$request->id));
    }

    /** route:admin.deletepenyakit */
    public function destroy(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
        ]);
        $penyakit = Penyakit::findOrFail($request->id);
        $penyakit->delete();
        notify()->success('Anda berhasil menghapus data penyakit!');
        return redirect(route('admin.penyakit'));
    }



}
