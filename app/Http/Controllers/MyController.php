<?php



namespace App\Http\Controllers;


use App\Irs;

class MyController extends  Controller
{


    public function callback()
{

    if (isset($_GET['serverid'], $_GET['clientid'], $_GET['statuscode'], $_GET['kp'], $_GET['msg'], $_GET['msisdn']) === false) {

        return response()->json([
            'status' => '200',
            'msg' => 'OK',
            'created'=> 'saiful'
        ], 200);

    } else {
        $serverid = $_GET['serverid'];
        $clientid = $_GET['clientid'];
        $msg = $_GET['msg'];
        $rc = $_GET['statuscode'];
        $msisdn = $_GET['msisdn'];
        $kp = $_GET['kp'];

        $data=array('idtrx'=>$clientid,'serverid'=>$serverid, 'tujuan'=>$msisdn,'kode'=>$kp,'rc'=>$rc,'msg'=>$msg);


        $match = ['idtrx' => $clientid];
        Irs::updateorcreate($match, ['tujuan' => $msisdn, 'kode' => $kp,'response'=>json_encode($data)]);



        return response()->json([
            'status' => '200',
            'msg' => 'Success Save',
            'created'=> 'saiful'
        ], 200);


}


}}
