<?php



namespace App\Http\Controllers;


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




}


}}
