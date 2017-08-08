<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'sdut_category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;
    protected $guarded=[];
    public function tree()
    {
        $categorys = Category::orderBy('cate_orded','asc')->get();
        return $this->getTree($categorys,'cate_name','cate_id','cate_pid');
    }
    public function getTree($data,$field_name,$field_id,$field_pid,$pid=0)
    {
        $arr = array();
        foreach($data as $k=>$v)
        {
            if($v->$field_pid==0)
            {
                $arr[]=$data[$k];
                foreach($data as $m=>$n)
                {
                    if($n->$field_pid == $v->$field_id)
                    {
                        $data[$m][$field_name] = '├─'.$data[$m][$field_name];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }
}
