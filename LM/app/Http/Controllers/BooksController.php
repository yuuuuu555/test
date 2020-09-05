<?php


namespace App\Http\Controllers;

use App\Books;
use Illuminate\Http\Request;

class Bookscontroller extends Controller
{

    // 主页
    public function index()
    {
        //分页
        $bookss = Books::paginate(10);
        $booksss = new Books();
        return view('books/index', [
            'bookss' => $bookss,
            'booksss' => $booksss,
        ]);
    }
    public function create(Request $request)
    {
        $books  = new Books();

        //判断模式是post
        if ($request->isMethod('POST')) {
            //验证信息

            $validator = \Validator::make(
                $request->input(),
                [
                        //限制条件
                        'Books.name' => 'required|min:2|max:20',
                        // 'Books.status' => 'required|integer',
                        'Books.classification' => 'required|integer',
                        'Books.author' => 'required|min:2|max:20',
                        'Books.publisher' => 'required|min:2|max:20',
                    ],
                [
                        //翻译
                        'required' => ':attribute 为必填项',
                        'min' => ':attribute 最少为2个字符',
                        'max' => ':attribute 超出字符限制',
                        'integer' => ':attribute 必须是整数'
                    ],
                [
                        //翻译
                        'Books.name' => '书籍名称',
                        'Books.status' => '书籍分类',
                        'Books.classification' => '书籍状态',
                        'Books.author' => '书籍作者',
                        'Books.publisher' => '出版社',
                    ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }


            //用$request指向在页面获取到的Users并赋值给$date
            $date = $request->input('Books');
            //创建的同时判断是否创建成功
            if (Books::create($date)) {
                //闪存
                return redirect('booksIndex')->with('success', '添加成功！');
            } else {
                return redirect()->back();
            }
        }
        // dd($books);
        return view('books/create', [
            'books' =>$books,
        ]);
    }

    //获取传来的数据 Request
    public function save(Request $request)
    {
        // 存到$date中
        $date = $request->input('Users');
        //获取一个模型
        $books = new Books();
        // 给模型赋值
        // 用$date里对应的值赋给$users模型里对应
        $books->name = $date['name'];
        $books->author = $date['author'];
        $books->publisher = $date['publisher'];
        $books->position = $date['position'];
        $books->classfication = $date['classfication'];
        $books->status = $date['status'];

        // var_dump($date);

        if ($books->save()) {
            return redirect('booksIndex');
        } else {
            return redirect()->back();
        }
    }
    
    // 修改
    // requeste获取post请求 页面要有methon=post
    public function update(Request $request, $id)
    {
        $books = Books::find($id);

        if ($request->isMethod('POST')) {
            // 验证
            // dd($request);
            $this->validate(
                $request,
                [
                    //限制条件
                    'Books.name' => 'required|min:2|max:20',
                    // 'Books.status' => 'required|integer',
                    'Books.classification' => 'required|integer',
                    'Books.author' => 'required|min:2|max:20',
                    'Books.publisher' => 'required|min:2|max:20',
                ],
                [
                    //翻译
                    'required' => ':attribute 为必填项',
                    'min' => ':attribute 最少为2个字符',
                    'max' => ':attribute 超出字符限制',
                    'integer' => ':attribute 必须是整数'
                ],
                [
                    //翻译
                    'Books.name' => '书籍名称',
                    'Books.status' => '书籍分类',
                    'Books.classification' => '书籍状态',
                    'Books.author' => '书籍作者',
                    'Books.publisher' => '出版社',
                ]
            );

            // 取出里面的值
            $date = $request->input('Books');
            //重新赋值
            $books->name = $date['name'];
            $books->author = $date['author'];
            $books->publisher = $date['publisher'];
            // $books->position = $date['position'];
            $books->status = $date['status'];
            $books->classification = $date['classification'];

            if ($books->save()) {
                return redirect('booksIndex')->with('success', '修改成功！');
            }
        }
        
        return view('books/update', [
            'books'=>$books
        ]);
    }
    //详情
    public function detail($id)
    {
        $books = Books::find($id);
        

        return view('books.detail', [
            'books' => $books
        ]);
    }
    public function delete($id)
    {
        $books = Books::find($id);

        if ($books->delete()) {
            return redirect('booksIndex')->with('success', '删除成功'. $id);
        } else {
            return redirect('booksIndex')->with('error', '删除失败'. $id);
        }
    }
    //id查询
    public function selectID(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            dd($request);
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Books.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //将页面存在Books[..]里的数据放到$books里
            $books = $request->input('Books');
            // dd($users);
            //查名字
            if (!empty($books['data'])) {
                $num = $books['data'];
                // dd($num);
                // 从数据库获得对应数据
                $bookss = Books::where('id', $num)
                    ->get();
                // dd($userss);

                // 判断有无某项数据，否则查无此人
                if (count($bookss)) {
                    // dd($bookss);
                    // 分页
                    $bookss = Books::where('id', $num) -> paginate(10);
                    return view('books/index', [
                        'bookss' => $bookss,
                    ]);
                } else {
                    return redirect('booksIndex')->with('error', '查无此人');
                }
            } else {
                return redirect('booksIndex')->with('error', '查无此人');
            }
        }
    }
    // 书名查询
    public function selectName(Request $request)
    {
        //                                                    代码的减少？？
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // dd($request);
            $validator = \Validator::make(
                $request->input(),
                [
                    //限制条件
                    'Books.data' => 'required'
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            //将页面存在Books[..]里的数据放到$books里
            $books = $request->input('Books');
            // dd($users);
            //查名字
            if (!empty($books['data'])) {
                $num = $books['data'];
                // dd($num);
                // 从数据库获得对应数据
                $bookss = Books::where('name', $num)
                    ->get();
                // dd($userss);

                // 判断有无某项数据，否则查无此人
                if (count($bookss)) {
                    // dd($bookss);
                    // 分页
                    $bookss = Books::where('name', $num) -> paginate(10);
                    return view('books/index', [
                        'bookss' => $bookss,
                    ]);
                } else {
                    return redirect('booksIndex')->with('error', '查无此人');
                }
            } else {
                return redirect('booksIndex')->with('error', '查无此人');
            }
        }
    }
    public function selectRetrieval(Request $request)
    {
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            //将页面存在Books[..]里的数据放到$books里
            $books = $request->input('Booksss');
            // dd($users);
            //查名字
            if (!empty($books['status'])) {
                $num = $books['status'];
                
                // 从数据库获得对应数据
                if ($num == "显示有存量的") {
                    // dd($num);
                    $num = 10;
                    $bookss = Books::where('status', $num) -> paginate(10);
                    return view('books/index', [
                        'bookss' => $bookss,
                    ]);
                } else {
                    return redirect('booksIndex');
                }
            }
        }
    }
    public function selectStatus(Request $request){
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            // dd($request);
            //将页面存在Books[..]里的数据放到$books里
            $books = $request->input('Books');
            // dd($users);
            //查名字
            if (count($books)) {
                $num = $books['status'];
                // dd($num);
                // 从数据库获得对应数据
                $bookss = Books::where('status', $num)
                    ->get();
                // dd($bookss);
                // 判断有无某项数据，否则查无此人
                if (count($bookss)) {
                    // dd($bookss);
                    // 分页
                    $booksss = new Books();
                    $bookss = Books::where('Status', $num) -> paginate(10);
                    return view('books/index', [
                        'bookss' => $bookss,
                        'booksss' => $booksss,
                    ]);
                } else {
                    return redirect('booksIndex')->with('error', '无此分类书籍');
                }
            } else {
                return redirect('booksIndex')->with('error', '无此分类书籍');
            }
        }
    }
}

