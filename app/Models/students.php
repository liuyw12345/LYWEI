<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    use HasFactory;

    // 定义可以批量赋值的字段
    protected $fillable = [
        'account',
        'password',
        'major',
        'class',
        'name',
        'email',
        'company_star_certificate_address',
        'competition_star_certificate_address',
        'research_star_certificate_address',
        'software_stars_certificate_address',
        'paper_stars_certificate_address',
        'created_at',
        'updated_at',
    ];
    protected $table = "students";
    public $timestamps = true;
    protected $primaryKey = "id";
    protected $guarded = [];

    // 隐藏密码字段
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        //getKey() 方法用于获取模型的主键值
        return $this->getKey();
    }

    //返回一个包含自定义声明的关联数组。
    public function getJWTCustomClaims()
    {
        return ['role' => 'students'];
    }
    public static function LywcreateUser($userdata)
    {
        try {
            $data = Students::insert([
                'account' => $userdata['account'],
                'password' => $userdata['password'],
                'major' => $userdata['major'],
                'class' => $userdata['class'],
                'email' => $userdata['email'],
                'name' => $userdata['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return $data;

        } catch (Exception $e) {
            return 'error'.$e->getMessage();
        }
    }
}
