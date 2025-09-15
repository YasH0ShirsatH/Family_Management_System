<?php

namespace App\Exports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class MembersExport implements FromCollection, WithMapping, WithHeadings, WithColumnFormatting
{
    public function collection()
    {
        return Member::where('status', '1')->get();
    }

    public function map($member): array
    {
        return [
            $member->id,
            $member->name,
            $member->birthdate ,
            $member->education,
            $member->marital_status,
            $member->marriage_date ,
            $member->photo_path,
            $member->status,
            $member->created_at ,
            $member->updated_at,
        ];
    }

    public function headings(): array
    {
        return [
            '#',
            'Name',
            'BirthDate',
            'Education',
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
