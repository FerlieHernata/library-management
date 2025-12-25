<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        // SEARCH
        if ($request->search) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('author', 'like', '%' . $request->search . '%');
        }

        // FILTER STOK
        if ($request->filter == 'available') {
            $query->where('stock', '>', 0);
        }

        if ($request->filter == 'empty') {
            $query->where('stock', '=', 0);
        }

        $books = $query->get();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'category' => 'required',
            'year' => 'required',
            'stock' => 'required|numeric'
        ]);

        Book::create($request->all());

        return redirect('/')->with('success', 'Buku berhasil ditambahkan');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->all());

        return redirect()->route('home')
            ->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('home')
            ->with('success', 'Buku berhasil dihapus');
    }

    public function __construct()
    {
        $this->middleware(['auth','admin'])->except(['index']);
    }

}
