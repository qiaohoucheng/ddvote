<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\File;

class FileController extends Controller
{
    public function  uploadPicture(Request $request)
    {
        $file = $request->file('file');
        if($file){
            //2 判断文件是否上传过  true -> 5  false -> 3
            $file_model = File::firstOrNew(['md5'=>md5_file($file->getPathname())]);
            if(!$file_model->id){
                $filename = time().rand('100','999').'.'.$file->guessClientExtension();
                $object ='/pic/'.$filename;
                $content = file_get_contents($file->getPathname());
                $a = file_put_contents('.'.$object,$content);
                //4.上传到数据库
                if(isset($a) && $a == true){
                    $file_model->filename = $filename;
                    $file_model->originalname = $file->getClientOriginalName();
                    $file_model->type = $file->getClientMimeType();
                    $file_model->size = $file->getClientSize();
                    $file_model->suffix = $file->guessClientExtension();
                    $file_model->url = 'http://toupiao.dudong.com'. $object;
                    $file_model->created_at = time();
                    $file_model->save();
                }else{
                    return array('code'=>0,'message'=>'上传失败');
                }
            }
            return array('code'=>1,'message'=>'上传成功','data'=>array('pic_id' => $file_model->id,'url'=>$file_model->url));
            //5.返回图片信息
        }
        abort('404');
    }
}
