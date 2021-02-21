<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('admin.home');
    // }

    // public function index()
    // {
    //     //分页
    //     $bookss = Book::paginate(10);
    //     $booksss = new Book();
    //     return view('admin/books/index', [
    //         'bookss' => $bookss,
    //         'booksss' => $booksss,
    //     ]);
    // }
}
