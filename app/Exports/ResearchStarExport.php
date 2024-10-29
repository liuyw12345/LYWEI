<?php
namespace App\Exports;

use App\Models\research_stars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ResearchStarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return research_stars::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '学生ID',
            '项目名称',
            '项目级别',
            '申报人排名',
            '审批时间',
            '材料',
            '审批状态',
            '创建时间',
            '更新时间',
            '拒绝理由',
        ];
    }
}
