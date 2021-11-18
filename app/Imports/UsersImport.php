<?php


namespace App\Imports;


use App\Irs;
use Illuminate\Database\Eloquent\Model;
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


        $idtrx = "INV/NJP/" . rand(0000, 9999);
        $tujuan = $row['tujuan'];
        $kodeproduk = $row['kode'];
        $id = "SA0001";
        $Username = "090954";
        $Password = "6A8176";
        $pin = "123456";
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
            case 00:
                $status = "Sukses";
                break;
            case null:
                $status = "webreport";
                break;
            default:
                $status = "Gagal";


        }


        return new Irs([

            'idtrx' => $idtrx,

            'tujuan' => $tujuan,

            'kode' => $kodeproduk,

            'status' => $status,

            'response' => json_encode($response),

        ]);

    }

}
