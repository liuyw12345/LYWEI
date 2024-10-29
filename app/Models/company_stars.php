<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class company_stars
{
    use HasFactory;

    protected $table = 'company_stars';
    protected $fillable = [
        'student_id',
        'project_name',
        'project_level',
        'ranking_total',
        'approval_time',
        'materials',
        'status',
        'created_at',
        'updated_at',
        'rejection_reason'
    ];

    public $timestamps = true;
    protected $primaryKey = "student_id";
    protected $guarded = [];

    //定义与students表的关系
    public function students()
    {
        return $this->belongsTo(students::class, 'student_id', 'id');
    }
}
