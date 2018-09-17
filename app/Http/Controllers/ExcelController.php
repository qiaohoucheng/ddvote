<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function export(){
        $cellData = [
            ['学号','姓名','成绩'],
            ['10001','AAAAA','99'],
            ['10002','BBBBB','92'],
            ['10003','CCCCC','95'],
            ['10004','DDDDD','89'],
            ['10005','EEEEE','96'],
        ];
        Excel::create('学生成绩',function($excel) use ($cellData){
            $excel->sheet('score', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

    //Excel文件导入功能
    public function import(Request $request){
        //获取excel导入的数据
        if(!$request->hasFile('file')){
            return redirect()->route('products.index')
                ->with('error','上传文件为空');
        }
        $file = $_FILES;
        $excel_file_path = $file['file']['tmp_name'];
        $res = [];
        Excel::load($excel_file_path, function($reader) use( &$res ) {
            $reader = $reader->getSheet(0);
            $res = $reader->toArray();
        });
        //校验excel导入的数据
        $judge = $res[0];
        if( $judge[0]!='姓名' || $judge[1]!='证书编号' || $judge[2]!='类别' || $judge[3]!='专业' || $judge[4]!='年级组别' || $judge[5]!='测评结果'){
            return redirect()->route('products.index')
                ->with('error','请按照模板格式上传');
        }
        //数据库注入数组
        unset($res[0]);
        $count = count($res);
        $product = [];
        $user = Auth::user();
        $time = date("Y-m-d H:i:s", time());

        for ($i=0,$j=1;$i<$count;$i++,$j++){
            $product[$i]['name'] = $res[$j][0];
            $product[$i]['identifynum'] = $res[$j][1];
            $product[$i]['identify'] = $res[$j][2]=='学生'?1:2 ;
            $product[$i]['major'] = $res[$j][3];
            $product[$i]['grade'] = $res[$j][4];
            $product[$i]['degree'] = $res[$j][5];
            $product[$i]['creator'] = $user->id;
            $product[$i]['created_at'] = $time;
            $product[$i]['updated_at'] = $time;
        }

        $postData['ini_id'] = Product::latest()->value('id');
        $postData['ini_id'] = $postData['ini_id'] + 1;

        Product::insert($product);

        $postData['final_id'] = Product::latest()->value('id');

        //记录日志
        $command = $this->module_name . '- 批量导入新数据';
        $this->logRecord($command,json_encode($postData),$request->ip());

        return redirect()->route('products.index')
            ->with('success',"数据批量导入成功");

    }
}
