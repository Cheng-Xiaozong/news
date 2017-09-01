(function($) {
  'use strict';

  $(function() {
    var $fullText = $('.admin-fullText');
    $('#admin-fullscreen').on('click', function() {
      $.AMUI.fullscreen.toggle();
    });

    $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function() {
      $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
    });
  });
})(jQuery);


//菜单选项
$('.click-active li a').on('click',function(){
    var url = $(this).attr('data-href');
    $('iframe').attr('src',url);
    $('.click-active li a').removeClass('active');
    $(this).addClass('active');
});

//状态编辑
$('.button-action button').on('click',function(){
    var url =  $(this).attr('data-href');
    window.location.href=url;
})


//分页样式动态添加
$('.pagination').addClass('am-pagination');
$('.pagination .disabled').addClass('am-disabled');
$('.pagination .active').addClass('am-active');

//分类筛选
$('.article-type-select').on('change',function(){
    var value= $(this).val();
    var url =  $(this).attr('data-href')+ '/'+value;
    var indexUrl =  $(this).attr('data-index-href');
    if(value =='null'){
        window.location.href=indexUrl;
    }else {
        window.location.href=url;
    }
})

//分类筛选
$('.push-article-type-select').on('change',function(){
    var value= $(this).val();
    var url =  $(this).attr('data-href')+'/'+ value;
    var indexUrl =  $(this).attr('data-index-href');
    if(value =='null'){
        window.location.href=indexUrl;
    }else {
        window.location.href=url;
    }
})

//推送文章分类状态编辑
$('.button-push-article-type-status').on('click',function(){
    var pid =  $('.push-article-type-select').val();
    var url =  $(this).attr('data-href')+'/'+pid;
    window.location.href=url;
})

//推送文章分类编辑
$('.button-push-article-type-edit').on('click',function(){
    var url =  $(this).attr('data-href');
    window.location.href=url;
})

//推送文章分类删除
$('.button-push-article-type-delete').on('click',function(){
    var pid =  $('.push-article-type-select').val();
    var url =  $(this).attr('data-href');
    window.location.href=url+'/'+pid;
})



//搜索
$('.article-search').on('click',function(){
    var url =  $(this).attr('data-href');
    var content = $('.article-search-content').val();
    window.location.href=url+'/'+content;
})


//分类筛选
$('.add-push-article-type-select').on('change',function(){
   var path = $(this).find('option:selected').attr('data-path');
   $('.article-type-path').val(path);
})

//表单提交
$('.push-article-id').on('click',function(){
    $article_id=$(this).attr('data-id');
    $('.article-id').val($article_id);
})

//推送文章筛选
$('.select-push').on('change',function(){
    var app_id = $("[name='app-type']").val();
    var type_id = $("[name='article-type']").val();
    var url = $(this).attr('data-href')+"?";
    if(app_id=='null' && type_id=='null')
    {
        window.location.href=url;
    }

    if(app_id!='null')
    {
       url+='app_id='+app_id;
    }

    if(type_id!='null')
    {
        url+='&type_id='+type_id;
    }
    window.location.href=url;
})

