@extends('common.layouts')

@section('content')
    @include('common.validator')
        <!-- 自定义内容区域 -->
        <div class="panel panel-default">
            <div class="panel-heading">修改信息</div>
            <div class="panel-body">
                <form class="form-horizontal" method="post" action="">
                    @csrf
                    <div class="form-group"><label for="name" class="col-sm-2 control-label">书籍名称</label>
                        <div class="col-sm-5"><input type="text" name="Books[name]" {{-- 保持已填数据old
                                判断是否提交的数据，如果不是就从数据库调取--}} {{--
                                新建页面进入无传值所以没有数据就用old 而修改页面在usercontroller里的方法传值进来 --}}
                                value="{{  isset(old('Books')['name']) ? old('Books')['name'] : $books->name }}" class="form-control" id="name"
                                placeholder="请输入学生姓名"></div>
                        <div class="col-sm-5">
                            <p class="form-control-static text-danger">{{ $errors->first('Books.name') }}</p>
                        </div>
                    </div>
                    <div class="form-group"><label for="author" class="col-sm-2 control-label">书记作者</label>
                        <div class="col-sm-5"><input type="text" name="Books[author]"
                                value="{{ isset(old('Books')['name']) ? old('Books')['author'] : $books->author }}" class="form-control" id="author"
                                placeholder="请输入学生年龄"></div>
                        <div class="col-sm-5">
                            <p class="form-control-static text-danger">{{ $errors->first('Books.author') }}</p>
                        </div>
                    </div>
                    <div class="form-group"><label for="publisher" class="col-sm-2 control-label">出版社</label>
                        <div class="col-sm-5"><input type="text" name="Books[publisher]"
                                value="{{ isset(old('Books')['name']) ? old('Books')['publisher'] : $books->publisher }}" class="form-control" id="publisher"
                                placeholder="请输入学生年龄"></div>
                        <div class="col-sm-5">
                            <p class="form-control-static text-danger">{{ $errors->first('Books.publisher') }}</p>
                        </div>
                    </div>
                    <div class="form-group"><label for="status" class="col-sm-2 control-label">分类</label>
                        <div class="col-sm-5">
                            {{-- ??????????????????????????????????? --}}
                            <select name="Books[status]">
                            @foreach ($books->status() as $ind => $val)
                                <label class="radio-inline">
                                    <option type="radio" name="Books[status]"
                                        {{ isset($books->status) && $books->status == $ind ? "selected" : ""}}
                                        value="{{ $ind }}">{{ $val }}
                                    </option>
                                </label>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <p class="form-control-static text-danger">{{ $errors->first('Books.status') }}</p>
                        </div>
                    </div>
                    <div class="form-group"><label for="classification" class="col-sm-2 control-label">状态</label>
                        <div class="col-sm-5">
                            {{-- ??????????????????????????????????? --}}
                            <select name="Books[classification]">
                            @foreach ($books->classification() as $ind => $val)
                                <label class="radio-inline">
                                    <option type="radio" name="Books[classification]"
                                        {{ isset($books->classification) && $books->classification == $ind ? "selected" : ""}}
                                        value="{{ $ind }}">{{ $val }}
                                    </option>
                                </label>
                            @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="col-sm-5">
                            <p class="form-control-static text-danger">{{ $errors->first('Books.classification') }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </div>
                </form>
                </div>
        </div>

@stop
