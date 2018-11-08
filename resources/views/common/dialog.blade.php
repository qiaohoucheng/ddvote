<div id="new-look" class="pop" style="display: none;">
    <ul class="dd-list" id="dd-idlist">
        <li class="dd-upload">
            <div class="layui-upload-drag" id="test10">
                <i class="layui-icon"></i>
                <p>点击上传，或将文件拖拽到此处</p>
            </div>
        </li>
        <li style="clear: both;float:none;margin: 0;padding: 0;width: 100%;height: 0;"></li>
    </ul>
</div>
<script type="text/javascript">
    $(function(){
        $(document).on('click','.dd-item',function(){
            if($(this).hasClass("active")){
                $(this).removeClass("active");
            }else{
                $(this).addClass("active");
            }
            $(this).parent().siblings().find('.dd-item').removeClass("active");
        })
    })
</script>