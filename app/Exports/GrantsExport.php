<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Illuminate\Contracts\Support\Responsable;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class GrantsExport implements FromCollection, WithColumnFormatting, WithHeadings, WithMapping, Responsable
{
    use Exportable;

    private $fileName;
    private $grants;

    public function __construct($grants)
    {
        $this->fileName = 'Grants ' . now()->format('d-m-Y') . '.xlsx';
        $this->grants = $grants;
    }

    public function headings(): array
    {
        return [
            'Organization',
            'Applied amount',
            'Website',
            'Status',
            'Completed',
            'Decision date',
            'Submitted date',
            'Awarded date',
            'Spend by date',
            'Reporting deadline',
            'Awarded amount',
            'Received amount',
            'Spent amount'
        ];
    }

    public function collection()
    {
        return $this->grants;
    }

    public function map($grant): array
    {
        return [
            $grant->organization,
            $grant->applied_amount / 100,
            $grant->website,
            $grant->status,
            $grant->is_completed ? 'Yes' : 'No',
            Date::stringToExcel($grant->decision_date),
            Date::stringToExcel($grant->submitted_date),
            Date::stringToExcel($grant->awarded_date),
            Date::stringToExcel($grant->spend_by_date),
            Date::stringToExcel($grant->reporting_date),
            $grant->awards_sum_amount / 100,
            $grant->receivings_sum_amount / 100,
            $grant->spendings_sum_amount / 100
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => '"£"#,##0.00_-',
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'H' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'I' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'J' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'K' => '"£"#,##0.00_-',
            'L' => '"£"#,##0.00_-',
            'M' => '"£"#,##0.00_-'
        ];
    }
}
