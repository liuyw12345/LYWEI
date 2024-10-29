<?php

namespace App\Http\Controllers;

use App\Exports\CompetitionStarExport;
use App\Exports\PaperStarExport;
use App\Exports\ResearchStarExport;
use App\Exports\SoftwareStarExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class WwjController extends Controller
{

    //导出竞赛之星
    public function exportCompetitionStar()
    {
        return Excel::download(new CompetitionStarExport, '竞赛之星.xlsx');
    }

    //导出双创之星
    public function exportCompanyStar()
    {
        return Excel::download(new CompetitionStarExport(), '双创之星.xlsx');
    }

    //导出科技之星
    public function exportPaperStar()
    {
        return Excel::download(new PaperStarExport, '科研之星-论文.xlsx');
    }

    public function exportSoftwareStar()
    {
        return Excel::download(new SoftwareStarExport,'科研之星—软著.xlsx');
    }

    public function exportResearchStar()
    {
        return Excel::download(new ResearchStarExport,'科研之星-科研.xlsx');
    }

    //管理员查看双创之星
    public function ViewCompanyStar(Request $request)
    {
        try {


            // 直接查询 admins 表获取管理员信息
            $adminId = $request->input('admin_id'); // 假设你通过请求传递 admin_id
            $admin = DB::table('admins')->where('id', $adminId)->first();  // 获取管理员的信息
//        $adminMajor = admins::with('major')->where('id', $adminId)->get();
            $adminMajor = $admin->major;
            // 检查管理员是否存在
            if (!$admin) {
                return response()->json([
                    'code' => 1,
                    'msg' => '管理员不存在',
                    'data' => null
                ]);
            }

            if (!$adminMajor) {
                return response()->json([
                    'code' => 1,
                    'msg'=>'管理员专业不存在',
                    'data' => null
                ]);
            }
//        // 确认管理员信息和 major 是否存在
//        if (!isset($admin->major)) {
//            return response()->json([
//                'code' => 1,
//                'msg' => '管理员专业信息不存在',
//                'data' => null
//            ]);
//        }

            // 根据管理员的专业查询公司星的申报信息
            $companyStars = DB::table('company_stars')
                ->leftJoin('students', 'company_stars.student_id', '=', 'students.id')
                ->where('students.major', '=', $adminMajor)  // 根据管理员的专业查询
                ->select(
                    'company_stars.*',
                    'students.name as student_name',
                    'students.major as student_major',
                    'students.email as student_email'
                )
                ->get([
                    'name',
                    'account',
                    'class',
                    'major',
                    'company_name',
                    'company_type',
                    'applicant_rank',
                    'registration_time',
                    'materials',
                    'status',
                    'reject_reason',
                ]);

            // 检查是否查询到数据
            if ($companyStars->isEmpty()) {
                return response()->json([
                    'code' => 1,
                    'msg' => '没有找到相关数据',
                    'data' => null
                ]);
            }

            return response()->json([
                'code' => 0,
                'msg' => '查询成功',
                'data' => $companyStars
            ]);
        }catch (\Exception $e){
            return response()->json(['code'=>500,'msg'=>$e->getMessage()]);
        }
    }

    //删除双创之星报名
    public function deleteCompanyStar(Request $request)
    {
        //从请求体中获取参数
        $id = $request->input('student_id');
        if (!$id){
            return response()->json([
                'code' => 1,
                'message'=>'为传递student_id参数'
            ]);
        }
        //检查是否存在报名信息
        $companyStar = DB::table('company_stars')->where('student_id',$id)->first();
        if (!$companyStar) {
            return response()->json([
                'code' => 1,
                'message'=>'未找到报名信息',
                'data' => null
            ]);
        }
        //删除
        try {
            DB::table('company_stars')->where('student_id',$id)->delete();
            return response()->json([
                'code' => 0,
                'message' => '删除成功',
                'data' => null
            ]);
        }catch (\Exception $e){
            return response()->json(['code'=>500,
                'msg'=>'删除失败'.$e->getMessage(),
                'data' => null
            ]);
        }
    }
}
