<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class software_stars extends Model
{
    use HasFactory;

    protected $table = 'software_stars';
    protected $fillable = [
        'student_id',
        'software_name',
        'issuing_unit',
        'ranking_total',
        'approval_time',
        'materials',
        'created_at',
        'updated_at',
        'status',
        'rejection_reason'
    ];
    public $timestamps = false;
    protected $primaryKey = 'student_id';
    protected $guarded = [];

    public function student(){
        return $this->belongsTo(students::class,'student_id','id');
    }

}
