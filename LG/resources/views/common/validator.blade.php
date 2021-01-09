<!-- 所有错误提示 -->
{{-- 判断是否有错 --}}
@if(count($errors))
<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
</div>
@endif