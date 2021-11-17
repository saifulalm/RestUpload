<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Irs;
use App\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $trx = Irs::whereDate('created_at', Carbon::today())->get();
        return view('Home', ['trans' => $trx]);

    }


    /**
     * @return Collection
     */


    /**
     * @return Collection
     */

    public function export()

    {

        return Excel::download(new UsersExport, 'list_transaksi.xlsx');

    }


    /**
     * @return Collection
     */

    public function import(Request $request)

    {

        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);


        $file = $request->file('file');


        $nama_file = rand() . $file->getClientOriginalName();


        $file->move('file_transaksi', $nama_file);


        Excel::import(new UsersImport, public_path('/file_transaksi/' . $nama_file));


        Session::flash('sukses', 'Transaksi sedang diproses, mohon ditunggu');


        return redirect('/home');

    }
}
