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

//搜索
$('.article-search').on('click',function(){
    var url =  $(this).attr('data-href');
    var content = $('.article-search-content').val();
    window.location.href=url+'/'+content;
})