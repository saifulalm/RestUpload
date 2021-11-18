<?php

namespace App\Exports;

use App\Irs;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{

    public function collection()
    {
        return Irs::whereDate('created_at', Carbon::today())->get();
    }
}
