<!-- 成功提示框 -->
@if(Session::has('success'))
    <div class="am-alert am-alert-success" data-am-alert style="margin:10px">
        <button type="button" class="am-close">&times;</button>
        {{Session::get('success')}}
    </div>
@endif

<!-- 成功提示框 -->
@if(Session::has('error'))
    <div class="am-alert am-alert-danger" data-am-alert style="margin:10px">
        <button type="button" class="am-close">&times;</button>
        {{Session::get('error')}}
    </div>
@endif