<?php

namespace App\Http\Controllers\Admin;

use App\CF\Get_case;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CF\CertaintyFactor;

class DashboardController extends Controller
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

    public function index(Request $request)
    {
        return view('admin.dashboard',array(
            'judul' => "Dashboard Administrator | MyCovid V.1.0",
            'aktifTag' => "admin",
            'tagSubMenu' => "admin",
        ));
    }

    public function test()
    {
         $contoh_data = CertaintyFactor::TestData();
//        $case = new Get_case();
//        $getcase = $case->data($contoh_data);

        $contoh_input = CertaintyFactor::TestDataInput();
//        return $contoh_data;
       return $hasil = CertaintyFactor::ProsesHitung($contoh_data, $contoh_input);
//        header('Content-Type: application/json');
//        echo json_encode($hasil);
    }
}
