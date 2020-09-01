<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Student;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\VarDumper\VarDumper;

class StuController extends Controller{
    public function test1(){
        // return 'test1';
        //查看数据库表单
        // $students = DB::select('select * from t_student');
        // var_dump($students);

        //往t_student表单插入数据
        // $bool = DB::insert('insert into t_student(userName,password) values(?,?)', ['imooc', 123]);
        // var_dump($bool);

        //修改信息 根据userName来修改trueName
        // $num = DB::update('update t_student set trueName = ? where userName = ?', ['老旧','imooc']);

        //查询 id小于5的数据
        // $students = DB::select('select * from t_student where id < ?', [5]);
        // dd($students);
        
        //删除
        // $num = DB::delete('delete from t_student where userName = ?', ['imooc']);
        // var_dump($num);

    }


    // 查询构造器
    //新增数据
    public function tableInsert(){
        //新增数据
        //前面数据库连接已将设置前缀t_ 所以现在不需要加前缀
        // $boll = DB::table('student')->insert(
        //     ['userName' => 'jhon','trueName' => '老师']
        // );
        // var_dump($boll);

        //获得新建数据的id
        // $id = DB::table('student')->insertGetId(
        //     ['userName' => 'baba', 'trueName' => '爸爸']
        // );
        // var_dump($id);

        //增加多条信息
        // $many = DB::table('student')->insert([
        //     ['userName' => 'baba2', 'trueName' => '爸爸2'],
        //     ['userName' => 'baba3', 'trueName' => '爸爸3'],
        //     ['userName' => 'baba4', 'trueName' => '爸爸4'],
        //     ['userName' => 'baba5', 'trueName' => '爸爸5']
        // ]);
    }

    //更新数据
    public function tableUpdateDB(){
        
        //更新数据
        // $num = DB::table('student')
        // ->where('id', 9) //条件
        // ->update(['userName' => 'mama']);
        // var_dump($num);

        // //数据自增 默认自增1 这里增3 有赋值才增 空值还是空值
        // $num = DB::table('student')
        // ->where('id', 1) //条件为id为1的
        // ->increment('password', 3);
        // var_dump($num);

        //数据自减
        // $num = DB::table('student')->decrement('password', 3);
        // var_dump($num);

        // $num = DB::table('student')
        //     ->where('id', 9)
        //     ->decrement('password', 5, ['userName' => 'shit']); //自减的同时改名
        // var_dump($num);
    }
    
    //查询构造器删除数据
    public function tableDeleteDB(){
        //删除数据
        // $num = DB::table('student')
        // ->where('id', '>',5)
        // ->delete();
        // var_dump($num);

        //清空整个表
        // DB::table('student')->truncate();
    }

    //查询构造器查询数据
    public function tableSelectDB(){

        //获取表所有数据
        // $num = DB::table('student')->get();
        // dd($num);

        //first 获取第一条数据
        // $num = DB::table('student')->first();
        // dd($num);

        //desc倒序
        // $num = DB::table('student')
        // ->orderBy('id', 'desc') //倒序条件
        // ->first();
        // dd($num);

        //条件查询
        // $num = DB::table('student')
        // ->where('id', '>', 1)
        // ->get();
        // dd($num);

        //多条件查询 whereRaW
        // $num = DB::table('student')
        // ->whereRaw('id > ? and password = ?', [0, 123])
        // ->get();
        // dd($num);

        //pluck/list list可以指定下标 只查询条件内的某一数据
        // $num = DB::table('student')
        // ->whereRaw('id > ? and password = ?', [0, 123])
        // ->list('userName');
        // dd($num);

        //select 指定查找
        // $num = DB::table('student')
        // ->select('userName', 'id', 'trueName')
        // ->get();
        // dd($num);

        //chunk 可用于处理大数据 没次显示几条
        // DB::table('student')
        // ->orderBy('id')
        // ->chunk(2, function($num){
        //     foreach($num as $num2){
        //         var_dump($num2);
        //     }
        //     if(条件){
        //         return false;//跳出
        //     }
        // });
    }
    //->count() 返回记录 有多少条数据就多少记录1/2/3.。。。
    //->max('age')   返回age里的最大值
    //->min('age')   返回age里的最小值
    //->avg('age')   返回age里的平均值
    // ->sum('age')   返回age里的和


    public function tableSelectORM(){
        //all();查询所有学生
        // $num = Student::all();

        //主键在模型已设置
        //根据主键来找模型的对象
        // $num = Student::find(1);

        //findOrFail 没有数据就报错
        // $num = Student::findOrFail(123);

        //获取数据
        // $num = Student::get();
        //有条件的
        // $num = Student::where('id', '>', '1')
        //     ->get();

        //chunk 每次打印几个
        // Student::chunk(2, function($num){
        //     var_dump($num);
        // });
        // dd($num);
        // var_dump($num);
    }

    //新增数据
    public function tableInsertORM(){

        // 新增数据
        // $num = new student();
        // 为属性插入值
        // $num->userName = 'lgu123sdo';
        // $num->password = 123;
        // 保存到数据库
        // $bool= $num->save();
        //需要设置或关闭时间戳

        //显示时间错误
        // $num = Student::find(17);
        // // dd($num);
        // echo date('Y-m-d H:i:s', $num->create_at);
        

        //create新增 不能批量赋值 已在model设置
        // $num = student::create(
        //     ['userName' => 'baby', 'password' => 123, 'trueName' => '大佬']
        // );

        //firstOrCreate 查询有就覆盖 没有就新增
        // $num = Student::firstOrCreate(
        //     ['userName' => 'baby']
        // );
        // dd($num);

        //firstOrNew() 查找 没有就新建但不保存 需要save（）保存
        // $num = Student::firstOrNew(
        //     ['userName' => 'baby']
        // );
        // $num2 = $num->save();


        // dd($num);
        // var_dump($num2);
    }

    //更新数据
    public function tableUpdateORM(){

        //指定更新
        // $num = Student::find(18);
        // $num->userName = 'fuck';
        // $num2 = $num->save();
        
        //条件更新
        // $num = Student::where('id','>',5)->update(
        //     ['password'=>123]
        // );
        // var_dump($num);
    }

    public function tabledeleteORM(){

        //删除 不存在会报错
        // $num = Student::find(15);
        // $num2 = $num->delete();


        //通过主键删除destroy(  ,  )可以多个[ , ] 可以范围删除
        // $num2 = Student::destroy(17);

        //条件删除
        // $num = Student::where('id','>', 15)->delete();

        // var_dump($num);
    }


    //渲染一下
    public function section1(){

        $name = 'lala';
        $num = Student::get();
        // $num = [];


        
        return view('student/section1',[
            'name' => $name,
            'num' =>$num
            //可用此方法调用数据库数据出来
    
        ]);
    }

    public function url(){

        return 'keyi';
    }

    //获得地址栏后面的参数
    public function request1(Request $request){
        //在地址栏取值 地址栏后缀加 request1?name=yusdad 打印出yusdad 
        //没有name就输出 默认值:未知
        // echo $request->input('name','未知');

        //has() 判断有无此参数
        // if($request->has('name')){
        //     echo $request->input('name');
        // }else{
        //     echo '无此参数';
        // }

        //获得所有参数
        // $num = $request->all();
        // dd($num);

        //判断请求类型
        // echo $request->method();
        //判断是否是某类型 GET POST ajax()
        // if($request->isMethod('POST')){
        //     echo 'yes';
        // }else{
        //     echo 'no';
        // }
        
        //判断是否在student目录下 路由
        // $num = $request->is('student/*');
        // var_dump($num);

        //获取当前URL
        // echo $request->url();       
    }



    //往session里面存数据
    //key相当于一个下标 最终取到value
    public function session1(Request $request){
        //HTTP request session() put 一下数据
        // $request->session()->put('key1','value1');

        //Sesion（）
        // session()->put('key2', 'velue2');

        //Session:: 需要中间件
        // Session::put('key3', 'velue3');
        //以数组的形式存
        // Session::put(['key3'=>'velue3']);
        
        //将数组存进session
        // Session::push('student', 'ssdsd');
        // Session::push('student', 'asdweq');

        //只能查看一次 暂存
        // Session::flash('lala', 'huhu');
    }
    //获取session里的数据
    //指向下标 获得值value1
    public function session2(Request $request){
        //HTTP
        // echo $request->session()->get('key1');

        //session()
        // echo session()->get('key2');

        //Session:: asdd默认值
        // echo Session::get('key3', 'asdd');

        //取得数组
        // $num = Session::get('student','hahaio');
        //pull  取完删除 
        // $num = Session::pull('student','hahaio');

        //取得所有的值
        // $num = Session::all();

        //判断值是否在 在就获取全部值
        // if(Session::has('key12')){
        //     $num = Session::all();
        //     dd($num);
        // }else{
        //     echo '查无此字';
        // }

        //删除
        // Session::forget('key1');
        //删除所有
        // Session::flush();
    }


    //response
    public function response(){
        // json
        // $num = [
        //     'errCode'=>0,
        //     'sdfas'=>12,
        //     'sdsad'=>'asdqq',
        // ];
        //将数组转换为一个json字符串
        // return response()->json($num);

        //重定向 到session2
        return redirect('response2');
        //快闪with
        // return redirect('response2')->with('msg', 'lalalal');
        //快闪action()
        // return redirect()->action('stuController@response2')->with('msg', 'lalalal');
        //快闪route()别名
        // return redirect()->route('session2')->with('msg', 'lalalal');
        
        //返回上一级
        // return redirect()->back();
        echo '123';
    }
    public function response2(){
        //获取response传来的msg
        return Session::get('msg', '已经无了');
        return redirect()->back();
    }

    //宣传
    public function activity0(){
        return '宣传';
    }
    public function activity1(){
        return '活动1';
    }
}