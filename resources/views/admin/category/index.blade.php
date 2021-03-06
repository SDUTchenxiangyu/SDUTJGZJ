@extends('layouts.admin')
@section('content')
<!--导航 开始-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo; 分类管理
</div>
<!--导航 结束-->

<!--搜索结果页面 列表 开始-->
<form action="#" method="post">
    <div class="result_wrap">
        <!--快捷导航 开始-->
        <div class="result_title">
            <h3>分类列表</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/category/create')}}"><i class="fa fa-plus"></i>添加分类</a>
                <a href="{{url('admin/category')}}"><i class="fa fa-recycle"></i>全部分类</a>
            </div>
        </div>
        <!--快捷导航 结束-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class ="tc" width="5%">顺序</th>
                    <th class="tc" width="5%">ID</th>
                    <th class="tc" width="10%">分类名称</th>
                    <th class="tc">标题</th> 
                    <th class="tc">查看次数</th> 
                    <!-- <th>链接地址</th> -->
                    <!-- <th>发布时间</th> -->
                    <th>操作</th>
                </tr>
                @foreach($data as $v) 
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$v->cate_id}})" value="{{$v->cate_orded}}">
                    </td>
                    <td class="tc">{{$v->cate_id}}</td>
                    <td ><a href="#">{{$v->cate_name}}</a></td>                    
                    <td style = 'width: 25%'>
                        {{$v->cate_title}}
                    </td>
                    <td class="tc">{{$v->cate_view}}</td>                                        
                    <td>
                        <a href="{{url('admin/category/'.$v->cate_id.'/edit')}}">修改</a>
                        <a href="javascript:;" onclick="delArt({{$v->cate_id}})">删除</a>
                    </td>
                </tr>
                @endforeach  
            </table>

            <div class="page_list">
                  
            </div>
        </div>
    </div>
</form>
<!--搜索结果页面 列表 结束-->

<style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
</style>

<script>
    //删除分类
    function delArt(cate_id) {
        layer.confirm('您确定要删除这篇文章吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/category/')}}/"+cate_id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
                if(data.status==0){
                    location.href = location.href;
                    layer.msg(data.msg, {icon: 6});
                }else{
                    layer.msg(data.msg, {icon: 5});
                }
            });
//            layer.msg('的确很重要', {icon: 1});
        }, function(){

        });
    }
</script>
<script>
    function changeOrder(obj,cate_id)
    {
        var cate_order = $(obj).val();
        $.post('{{url('admin/cate/changeorder')}}',{'_token':'{{csrf_token()}}','cate_id':cate_id,'cate_order':cate_order},function(data){
            if(data.status==0)
            {
                layer.msg(data.msg, {icon: 6});
            }
            else
            {
                layer.msg(data.msg, {icon: 5});
            }
        });
    }
</script>

@endsection