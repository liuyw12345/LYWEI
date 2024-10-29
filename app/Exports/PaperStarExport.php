<?php

namespace App\Exports;

use App\Models\paper_stars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaperStarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return paper_stars::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '学生ID',
            '期刊名称',
            '论文类别',
            '申报人排名',
            '出版时间',
            '申报材料',
            '审批状态',
            '创建时间',
            '更新时间',
            '拒绝理由',
        ];
    }
}
