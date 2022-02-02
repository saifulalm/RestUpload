<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UsersImport;
use App\Irs;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
    public function index(): Renderable
    {

        $trx = Irs::where('userid','=',Auth::user()->id)
                    ->where('created_at', Carbon::today())
                    ->get();

        return view('home', ['trans' => $trx]);

    }


    /**
     * @return Collection
     */


    /**
     * @return BinaryFileResponse
     */

    public function export(): BinaryFileResponse

    {

        return Excel::download(new UsersExport, 'list_transaksi.xlsx');

    }


    /**
     * @return Application|RedirectResponse|Redirector
     */

    public function import(Request $request)

    {

        // validasi


        $file = $request->file('file');


        $nama_file = rand() . $file->getClientOriginalName();


        $file->move('file_transaksi', $nama_file);


        Excel::import(new UsersImport, public_path('/file_transaksi/' . $nama_file));


        Session::flash('sukses', 'Transaksi sedang diproses, mohon ditunggu');


        return redirect('/home');

    }
}
