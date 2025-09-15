<?php

namespace App\Exports;

use App\Models\Head;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class HeadsImport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    public function collection()
    {
        return Head::where('status', '1')->get();
    }

    public function map($head): array
    {
        return [
            $head->id,
            $head->name,
            $head->surname,
            $head->birthdate ,
            $head->mobile,
            $head->address,
            $head->state,
            $head->city,
            $head->pincode,
            $head->marital_status,
            $head->marriage_date ? Date::dateTimeToExcel($head->marriage_date) : '',
            $head->photo_path,
            $head->status,
            $head->created_at ? Date::dateTimeToExcel($head->created_at) : '',
            $head->updated_at ? Date::dateTimeToExcel($head->updated_at) : '',
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'Surname',
            'BirthDate',
            'Mobile',
            'Address',
            'State',
            'City',
            'Pincode',
            'Marital_status',
            'Marraige_date',
            'Photo Path',
            'Status',
            'Created_At',
            'Updated_At',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'K' => NumberFormat::FORMAT_DATE_YYYYMMDD,
            'N' => NumberFormat::FORMAT_DATE_YYYYMMDD . ' H:i:s',
            'O' => NumberFormat::FORMAT_DATE_YYYYMMDD . ' H:i:s',
        ];
    }
}
