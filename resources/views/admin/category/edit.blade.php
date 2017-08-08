@extends('layouts.admin')
@section('content')
<!--导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 修改文章分类
</div>
<!--导航 结束-->

<!--结果集标题与导航组件 开始-->
<div class="result_wrap">
    <div class="result_title">
        <h3>添加文章</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
            <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
        </div>
    </div>
</div>
<!--结果集标题与导航组件 结束-->

<div class="result_wrap">
    <form action="{{url('admin/category/'.$field->cate_id)}}" method="post">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="put">
        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>父级分类：</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==顶级分类==</option>
                        @foreach($data as $d)
                            
                        <option value="{{$d->cate_id}}" 
                            @if($d->cate_id == $field->cate_pid) selected="selected" @endif
                        >{{$d->cate_name}}</option>
                        @endforeach                        
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>分类名称：</th>
                <td>
                    <input type="text" name="cate_name" value="{{ $field->cate_name }}">
                    <span><i class="fa fa-exclamation-circle yellow"></i>分类名称必须填写</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>分类标题：</th>
                <td>
                    <input type="text" class="lg" name="cate_title" value="{{ $field->cate_title }}">
                </td>
            </tr>
            <tr>
                <th>关键词：</th>
                <td>
                    <textarea name="cate_keyword" >{{ $field->cate_keyword }}</textarea>
                </td>
            </tr>
            <tr>
                <th>描述：</th>
                <td>
                    <textarea name="cate_descrption">{{ $field->cate_descrption }}</textarea>
                </td>
            </tr>
            <tr>
                <th>顺序：</th>
                <td>
                    <input type="text" class="sm" name="cate_orded" value="{{ $field->cate_orded }}">
                </td>
            </tr>
            

            <tr>
                <th></th>
                <td>
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

@endsection
