<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    public function store($id)
    {
        $book = Book::findOrFail($id);

        // Cek stok
        if ($book->stock <= 0) {
            return back()->with('error', 'Stok buku habis');
        }

        // CEK SUDAH PERNAH PINJAM & BELUM DIKEMBALIKAN
        $alreadyBorrowed = Borrow::where('user_id', auth()->id())
            ->where('book_id', $id)
            ->where('status', 'borrowed')
            ->exists();

        if ($alreadyBorrowed) {
            return back()->with('error', 'Anda sudah meminjam buku ini');
        }

        DB::transaction(function () use ($book) {
            Borrow::create([
                'user_id'     => auth()->id(),
                'book_id'     => $book->id,
                'borrow_date' => now(),
                'status'      => 'borrowed'
            ]);

            $book->decrement('stock');
        });

        return back()->with('success', 'Buku berhasil dipinjam');
    }

    public function returnBook($id)
    {
        $borrow = Borrow::findOrFail($id);

        DB::transaction(function () use ($borrow) {

            $borrow->update([
                'return_date' => now(),
                'status'      => 'returned'
            ]);

            $borrow->book->increment('stock');
        });

        return back()->with('success', 'Buku berhasil dikembalikan');
    }
}
