<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $book;
    private $category;
    public function __construct(Book $book, Category $category)
    {
        $this->book = $book;
        $this->category = $category;
    }
    public function index()
    {
        //
        $books = $this->book->paginate(10);
        return view('Admin.Books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = $this->category::tree();
        return view('Admin.Books.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        if ($request->isMethod('POST')) {
            if ($request->hasFile('image')) {
                $img = uploadFile('books', $request->file('image'));
            }
            $this->book->name = $request->name;
            $this->book->slug = Str::slug($request->name);
            $this->book->category_id = $request->category_id;
            $this->book->price = $request->price;
            $this->book->status = $request->status;
            $this->book->quantity = $request->quantity;
            $this->book->author = $request->author;
            $this->book->published_company = $request->published_company;
            $this->book->published_year = $request->published_year;
            $this->book->width = $request->width;
            $this->book->height = $request->height;
            $this->book->number_of_pages = $request->number_of_pages;
            $this->book->short_description = $request->short_description;
            $this->book->description = $request->description;
            $this->book->image = $img;
            $this->book->save();
            if ($this->book->save()) {
                return redirect()->route('admin.book.index');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $book = $this->book::find($id);
        if ($book) {
            return view('Admin.Books.show', compact('book'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if ($id) {
            $categories = $this->category::tree();
            $book = $this->book->find($id);
            return view('Admin.Books.edit', compact('book', 'categories'));
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
