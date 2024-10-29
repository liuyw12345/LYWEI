<?php

namespace App\Exports;

use App\Models\competition_stars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompetitionStarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return competition_stars::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '学生ID',
            '比赛名称',
            '报名时间',
            '材料',
            '状态',
            '创建时间',
            '更新时间',
            '拒绝理由',
        ];
    }
}
