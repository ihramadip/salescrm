<?php

namespace App\Exports;

use App\Models\Revenue;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RevenueReportExport implements FromQuery, WithHeadings, WithMapping
{
    protected $startDate;
    protected $endDate;

    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Revenue::query()->with('deal.company')
            ->whereBetween('revenue_date', [$this->startDate, $this->endDate])
            ->orderBy('revenue_date', 'asc');
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Date',
            'Deal Title',
            'Company',
            'Amount',
        ];
    }

    /**
     * @param mixed $revenue
     * @return array
     */
    public function map($revenue): array
    {
        return [
            $revenue->revenue_date,
            $revenue->deal->title ?? 'N/A',
            $revenue->deal->company->name ?? 'N/A',
            $revenue->amount,
        ];
    }
}