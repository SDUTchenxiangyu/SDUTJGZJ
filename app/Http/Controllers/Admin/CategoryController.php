<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Model\Category;
use App\Http\Requests;
use Validator;

class CategoryController extends CommonController
{
    //get.admin/category  全部分类列表
    public function index()
    {
        $data = (new Category())->tree();
        return view('admin.category.index')->with('data',$data);
    }
    public function changeOrder(Request $request)
    {
        $input = $request->input();
        $cate = Category::find($input['cate_id']);
        $cate->cate_orded = $input['cate_order'];
        $re = $cate->update();
        if($re)
        {
            $date = [
                'status'=>0,
                'msg'=>'分类排序更新成功',
            ];
        }
        else
        {
            $date = [
                'status'=>1,
                'msg'=>'分类排序更新失败',
            ];
        }
        return $date;
    }
    //post.admin/category  添加分类提交
    public function store(Request $request)
    {

        $input = $request->except('_token');
        $rules = [
                'cate_name'=>'required',
            ];
            $message = [
                'cate_name.required'=>'分类名称不能为空！',                                             
            ];
            $validator = Validator::make($input,$rules,$message);
            if($validator->passes())
            {
                $re = Category::create($input);
                if($re)
                {
                    return redirect('admin/category');
                }
                else
                {
                    return back()->with('errors','数据填充失败！');
                }
            }
            else
            {
                return back()->withErrors($validator);
            }
    }
    //get.admin/category/create   添加分类
    public function create()
    {
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('data'));
    }
    //get.admin/category/{category}  显示单个分类信息
    public function show()
    {

    }
    //delete.admin/category/{category}  删除单个分类
    public function destroy($cate_id)
    {
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);
        if($re)
        {
            $data = [
                'status' =>0,
                'msg' => '分类删除成功！',
            ];
        }
        else
        {
            $data = [
                'status' =>1,
                'msg' => '分类删除失败！',
            ];
        }
        return $data;
    }
    //put.admin/category/{category}  更新分类
    public function update(Request $request,$cate_id)
    {
        $input = $request->except('_token','_method');
        $re = Category::where('cate_id',$cate_id)->update($input);
        if($re)
        {
            return redirect('admin/category');
        }
        else
        {
            return back()->with('errors','分类更新失败！');
        }
    }
    //get.admin/category/{category}/edit   编辑分类
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $data = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','data'));
    }
}
