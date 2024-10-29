<?php

namespace App\Exports;

use App\Models\software_stars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SoftwareStarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return software_stars::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '学生ID',
            '软著名称',
            '发证单位',
            '总排名',
            '审批时间',
            '审批材料',
            '更新时间',
            '状态',
            '拒绝理由',
        ];
    }
}
