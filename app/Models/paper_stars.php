<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class paper_stars extends Model
{
    use HasFactory;

    protected $table = 'paper_stars';
    protected $fillable = [
        'student_id',
        'journal_name',
        'paper_title',
        'ranking_total',
        'publication_time',
        'materials',
        'created_at',
        'updated_at',
        'rejection_reason'
    ];

    public $timestamps = false;
    protected $primaryKey = 'student_id';
    protected $guarded = [];
    public function student(){
        return $this->belongsTo(students::class,'student_id','id');
    }
}
