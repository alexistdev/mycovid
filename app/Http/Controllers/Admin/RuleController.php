<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use App\Models\Rule;
use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class RuleController extends Controller
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
            $rule = Rule::with('penyakit','gejala')
                ->orderBy('id','DESC')
                ->get();
            return Datatables::of($rule)
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
        return view('admin.rule',array(
            'judul' => "Dashboard Administrator | MyCovid V.1.0",
            'aktifTag' => "rule",
            'tagSubMenu' => "rule",
        ));
    }
}
