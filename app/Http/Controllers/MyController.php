<?php



namespace App\Http\Controllers;


use App\Irs;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MyController extends  Controller
{


    public function callback(): JsonResponse
    {

    if (isset($_GET['serverid'], $_GET['clientid'], $_GET['statuscode'], $_GET['kp'], $_GET['msg'], $_GET['msisdn']) === false) {

        return response()->json([
            'status' => '200',
            'msg' => 'OK',
            'date'=> Carbon::now()->toDateTimeString()
        ], 200);

    } else {
        $serverid = $_GET['serverid'];
        $clientid = $_GET['clientid'];
        $msg = $_GET['msg'];
        $rc = $_GET['statuscode'];
        $msisdn = $_GET['msisdn'];
        $kp = $_GET['kp'];

        $data=array('callback'=>TRUE,'idtrx'=>$clientid,'serverid'=>$serverid, 'tujuan'=>$msisdn,'kode'=>$kp,'rc'=>$rc,'msg'=>$msg);
        switch ($rc) {

            case 2:
                $rc = "Gagal";
                break;
            case 1:
                $rc = "Sukses";
                break;
            case null:
                $rc = "webreport";
                break;
            default:
                $rc = "Pending";


        }

        $match = ['idtrx' => $clientid];
        Irs::updateorcreate($match, ['tujuan' => $msisdn, 'kode' => $kp,'status'=>$rc,'response'=>$msg]);



        return response()->json([
            'status' => '200',
            'msg' => 'Success Save',
            'created'=> Carbon::now()->toDateTimeString()
        ], 200);


}


}}
