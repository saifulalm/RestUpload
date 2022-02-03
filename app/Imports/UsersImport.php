<?php


namespace App\Imports;


use App\Irs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Ixudra\Curl\Facades\Curl;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow

{

    /**
     * @param array $row
     *
     * @return Model|null
     */

    public function model(array $row)

    {


        $idtrx = $row['idtrx'];
        $tujuan = $row['tujuan'];
        $kodeproduk = $row['kode'];


        switch (Auth::user()->id) {

            case 1:
                $id = 'NI0406';
                $Username = "8DB49E";
                $Password = "6CF64E";
                $pin = 'DC29IF';

                break;

            case 2:
            case 3:

                //DEVELOPMENT
                $id = "SA0001";
                $Username = "C24162";
                $Password = "9DC814";
                $pin = "I8712E";
                break;


            default:

                $id = "";
                $Username = "";
                $Password = "";
                $pin = "";


        }

        $request = array('id' => $id, 'pin' => $pin, 'user' => $Username, 'pass' => $Password, 'kodeproduk' => $kodeproduk, 'tujuan' => $tujuan, 'idtrx' => $idtrx, 'counter' => 1);

        $response = Curl::to('http://112.78.139.26:2222/api/h2h')
            ->withHeaders(array('Accept: application/json', 'Content-Type: application/json'))
            ->withdata($request)
            ->asjson(true)
            ->get();


        $status = $response['rc'];

        switch ($status) {

            case 68:
                $status = "Pending";
                break;
            case 1:
            case 00:
                $status = "Sukses";
                break;

            default:
                $status = "Pending";


        }



        return new Irs([
            'userid' => Auth::user()->id,

            'idtrx' => $idtrx,

            'tujuan' => $tujuan,

            'kode' => $kodeproduk,

            'status' => $status,

            'response' => $response['msg'],

        ]);

    }

}
