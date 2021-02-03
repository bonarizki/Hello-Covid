<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\MitraRs;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MitraImport implements ToModel,WithStartRow
{
    use Importable;

    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        $data = [
            "mitra_name"     => $row[0],
            "mitra_address"    => $row[1], 
            "mitra_phone" => $row[2],
            "mitra_type" => $row[3],
            "created_by" => Auth::user()->name,
            "created_at" => Carbon::now(),
            "updated_by" => Auth::user()->name,
            "updated_at" => Carbon::now()
        ];
        return new MitraRs($data);
    }

    
}
