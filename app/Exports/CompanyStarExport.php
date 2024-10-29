<?php

namespace App\Exports;

use App\Models\company_stars;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CompanyStarExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return company_stars::all();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            '学生ID',
            '公司名称',
            '公司类型',
            '申请人排名',
            '注册时间',
            '公司规模',
            '材料',
            '状态',
            '更新时间',
            '拒绝理由',
        ];
    }
}
