@extends('layouts')

@section('header')
    fuck
    {{-- <p>{{$name}}</p> --}}
    <p>{{date('Y-m-d H:i:s', time())}}</p>


    @parent 

    <!-- {{-- @include('文件位置/文件名字') --}} -->

    @if($name == 'lala')
        我是啦啦
    @elseif($name == 'guagua')
        我是瓜瓜
    @else
        那我他妈是谁
    @endif

    {{-- @foreach($num as $student)
        <p>{{$student -> userName}}</p>
    @endforeach --}}


    {{-- 和foreach一样 但是可以检测是否为空数组 --}}
    {{-- @forelse($num as $student)
        <p>{{$student->userName}}</p>
    @empty
    <p> null</p>
    @endforelse --}}

    <a href="{{url('url')}}">url测试</a>
    {{-- action()不常用 --}}
    <a href="{{action('stuController@url')}}">action测试</a>
    <a href="{{route('urll')}}">route测试</a>

@stop