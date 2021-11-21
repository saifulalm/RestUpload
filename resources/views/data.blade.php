<meta http-equiv="refresh" content="20">
<table class='table table-bordered'>
    <thead>
    <tr>
        <th style="text-align: center;">No</th>
        <th style="text-align: center;">Tanggal</th>
        <th style="text-align: center;">ID Transaksi</th>
        <th style="text-align: center;">Tujuan</th>
        <th style="text-align: center;">Kode Transaksi</th>
        <th style="text-align: center;">Status</th>
        <th style="text-align: center;">Response</th>
        {{--                    Carbon::now()->toDateTimeString()--}}
    </tr>
    </thead>
    <tbody>
    @php $i=1 @endphp
    @foreach($trans as $s)
        <tr>
            <td style="text-align: center;">{{ $i++ }}</td>
            <th style="text-align: center;">{{$s->created_at}}</th>
            <td style="text-align: center;">{{$s->idtrx}}</td>
            <td style="text-align: center;">{{$s->tujuan}}</td>
            <td style="text-align: center;">{{$s->kode}}</td>

            @switch($s->status)
                @case("Pending")
                <td bgcolor="#fff016" style="text-align: center;">{{$s->status}}</td>
                @break
                @case("Gagal")
                <td bgcolor="#ff0814" style="text-align: center;">{{$s->status}}</td>
                @break
                @case("Sukses")
                <td bgcolor="#01ff00" style="text-align: center;">{{$s->status}}</td>
                @break
                @default
                <td bgcolor="#f5faff" style="text-align: center;">{{$s->status}}</td>
            @endswitch

            <td style="text-align: center;">{{$s->response}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
