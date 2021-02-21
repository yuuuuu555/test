<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Books;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use function PHPSTORM_META\type;

class AdminBooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    // 主页
    public function indexM()
    {
        //分页
        $bookss = Books::paginate(10);
        $booksss = new Books();
        return view('books/index', [
            'bookss' => $bookss,
            'booksss' => $booksss,
        ]);
    }
    public function indexU()
    {
        //分页
        $bookss = Books::paginate(10);
        $booksss = new Books();
        return view('users/indexU', [
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
                return redirect('admin/books')->with('success', '添加成功！');
            } else {
                return redirect()->back();
            }
        }
        // dd($books);
        return view('books/create', [
            'books' => $books,
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
            return redirect('admin/books');
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
                return redirect('admin/books')->with('success', '修改成功！');
            }
        }

        return view('books/update', [
            'books' => $books
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
            return redirect('admin/books')->with('success', '删除成功' . $id);
        } else {
            return redirect('admin/books')->with('error', '删除失败' . $id);
        }
    }
    //id查询
    public function selectID(Request $request)
    {
        $booksss = new Books();
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
                $bookss = Books::where('id', $num)
                    ->first();
                // dd($userss);

                // 判断有无某项数据，否则查无此人
                if (!empty($bookss)) {
                    // dd($bookss);
                    // 分页
                    $bookss = Books::where('id', $num)->paginate(10);
                    return view('books/index', [
                        'bookss' => $bookss,
                        'booksss' => $booksss
                    ]);
                } else {
                    return redirect('admin/books')->with('error', '查无此书');
                }
            } else {
                return redirect('admin/books')->with('error', '请输入信息');
            }
        }
    }
    // 书名查询
    public function selectName(Request $request)
    {
        $booksss = new Books();
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
                $bookss = Books::where('name', $num)->orWhere('name', 'like', '%' . $num . '%')
                    ->first();
                // dd($userss);

                // 判断有无某项数据，否则查无此人
                if (!empty($bookss)) {
                    // dd($bookss);
                    // 分页
                    $bookss = Books::where('name', 'like', $num)->orWhere('name', 'like', '%' . $num . '%')->paginate(10);
                    return view('books/index', [
                        'bookss' => $bookss,
                        'booksss' => $booksss
                    ]);
                } else {
                    return redirect('admin/books')->with('error', '查无此书');
                }
            } else {
                return redirect('admin/booksIndexU')->with('error', '请输入信息');
            }
        }
    }
    public function selectRetrieval(Request $request)
    {
        //分一个数据库给select页，因为检索后需要从新从数据库与返回值给主页，而select页不用
        $booksss = new Books();
        //分一个数据库数据给主页
        $bookss = Books::paginate(10);
        // 回传数据后在数据库查找有无对应的信息并获取
        if ($request->isMethod('get')) {
            //将页面存在Books[..]里的数据放到$books里
            $books = $request->input('Books');
            // dd($books);
            //查名字
            if (!empty($books['classification'])) {
                $data1 = $books['classification'];
                $data2 = $books['status'];
                // dd($data2);
                if ($data1 == "显示所有") {
                    if ($data2 == "所有分类") {
                        return redirect('booksIndexU');
                    } else {
                        // $num = gettype($bookss);
                        // dd($data2);//"1"
                        $bookss = Books::where('status', $data2)->first();
                        // dd($bookss);
                        if (!empty($bookss)) {
                            $bookss = Books::where('status', $data2)->paginate(10);
                            // dd($bookss);
                            return view('books/index', [
                                'bookss' => $bookss,
                                'booksss' => $booksss
                            ]);
                        } else {
                            return redirect('admin/books')->with('error', '此分类无有存量书籍');
                        }
                    }
                } else {
                    // $num = gettype($bookss);
                    // dd($num);
                    if (!empty($bookss)) {
                        $data1 = 10;
                        if ($data2 == "所有分类") {
                            $bookss = Books::where('classification', $data1)->paginate(10);
                            return view('books/index', [
                                'bookss' => $bookss,
                                'booksss' => $booksss
                            ]);
                        } else {
                            // dd($data2,$data1);
                            $bookss = Books::where('classification', $data1)->where('status', $data2)->first();
                            // dd($bookss);
                            if (!empty($bookss)) {
                                $bookss = Books::where('classification', $data1)->where('status', $data2)->paginate(10);
                                // dd($bookss);
                                return view('books/index', [
                                    'bookss' => $bookss,
                                    'booksss' => $booksss
                                ]);
                            } else {
                                return redirect('admin/books')->with('error', '此分类无有存量书籍');
                            }
                        }
                    } else {
                        return redirect('admin/books')->with('error', '此分类无有存量书籍');
                    }
                }
            }
        }
    }
    // 预约
    public function booksAppointment($idU, $idB)
    {
        $books = Books::find($idB);
        $users = Users::find($idU);
        dd($books);

        // $userData =
        // if(){


        // }
    }
}
