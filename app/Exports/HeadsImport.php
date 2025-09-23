<?php

namespace App\Exports;

use App\Models\Head;
use App\Models\Member;
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
        $data = collect();

        $heads = Head::where('status', '1')->with('members')->get();

        foreach ($heads as $head) {
            // Add head row
            $data->push((object)[
                'type' => 'head',
                'head' => $head,
                'member' => null
            ]);

            // Add member rows
            foreach ($head->members as $member) {
                $data->push((object)[
                    'type' => 'member',
                    'head' => $head,
                    'member' => $member
                ]);
            }
        }

        return $data;
    }

    public function map($row): array
    {
        if ($row->type === 'head') {
            $head = $row->head;
            return [
                'HEAD',
                $head->id,
                $head->name,
                $head->surname,
                $head->birthdate,
                $head->mobile,
                $head->address,
                $head->state,
                $head->city,
                $head->pincode,
                $head->marital_status,
                $head->mariage_date,
                '', // member fields empty for head
                '',
                '',
                '',
                '',
                $head->created_at ? Date::dateTimeToExcel($head->created_at) : '',
                $head->updated_at ? Date::dateTimeToExcel($head->updated_at) : '',
            ];
        } else {
            $member = $row->member;
            $head = $row->head;
            return [
                'MEMBER',
                $head->id,
                $head->name . ' (Head)',
                $head->surname,
                '', // head specific fields empty for member
                '',
                '',
                '',
                '',
                '',
                '',
                '',
                $member->name,
                $member->birthdate,
                $member->marital_status,
                $member->mariage_date,
                $member->created_at ? Date::dateTimeToExcel($member->created_at) : '',
                $member->updated_at ? Date::dateTimeToExcel($member->updated_at) : '',
            ];
        }
    }

    public function headings(): array
    {
        return [
            'Type',
            'Head ID',
            'Head Name',
            'Head Surname',
            'Head BirthDate',
            'Head Mobile',
            'Head Address',
            'Head State',
            'Head City',
            'Head Pincode',
            'Head Marital Status',
            'Head Marriage Date',
            'Member Name',
            'Member Surname',
            'Member BirthDate',
            'Member Marital Status',
            'Member Marriage Date',
            'Created At',
            'Updated At',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Head BirthDate
            'L' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Head Marriage Date
            'O' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Member BirthDate
            'Q' => NumberFormat::FORMAT_DATE_YYYYMMDD, // Member Marriage Date
            'R' => NumberFormat::FORMAT_DATE_YYYYMMDD . ' H:i:s', // Created At
            'S' => NumberFormat::FORMAT_DATE_YYYYMMDD . ' H:i:s', // Updated At
        ];
    }
}
