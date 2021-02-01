<?php

namespace App\Exports;

use App\Models\MitraRs;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;


class mitra implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return MitraRs::all();
    }

    public function map($mitra): array
    {
        return [
            $mitra->mitra_name,
            $mitra->mitra_address,
            $mitra->mitra_phone,
            $mitra->mitra_type,
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Mitra',
            'Alamat',
            'No Telepehone',
            'Type'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getDelegate()->getHighestRow();
                $event->sheet->getStyle('A1:D1')->applyFromArray([
                    'font' => [
                        'bold' => true
                    ]
                ]);

                $event->sheet->getStyle('A1:D'.$highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '000000'],
                        ],
                    ],
         ]);
            },
        ];
    }
}
