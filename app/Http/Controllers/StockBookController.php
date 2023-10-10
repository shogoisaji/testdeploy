<?php

namespace App\Http\Controllers;

use App\Models\StockBook;
use Illuminate\Http\Request;

class StockBookController extends Controller
{
    // main page
    public function list()
    {
    $stockBooks = StockBook::paginate(10);

    return view('books.list', ['stock_books' => $stockBooks, 'bookPaginator' => $stockBooks]);
    }

    public function detail($id)
    {
        $stockBook = StockBook::with(['comments.user',  'rentals'])->find($id);
        return view('books.detail', ['stock_book' => $stockBook]);
    }

    // request -> isbn
    // searchResult -> save stock_books table
    public function store(Request $request)
    {
        $client = new \App\Services\GoogleBooksClient(config('services.google_books.key'));
        $book = $client->searchBook($request->isbn);
        $stockBook = new StockBook();
        $stockBook->title = $book[0]->volumeInfo->title ?? 'no title';
        $stockBook->author = $book[0]->volumeInfo->authors[0] ?? 'null';
        $stockBook->isbn = $book[0]->volumeInfo->industryIdentifiers[1]->identifier ?? '1234567891012';
        $stockBook->image = $book[0]->volumeInfo->imageLinks->thumbnail ?? null;
        $stockBook->save();

        return redirect()->route('book.list');
    }

    public function return($id)
    {
        // StockBook Model save table
        $stockBook = StockBook::find($id);
        $stockBook->is_rental = false;
        $stockBook->save();

        // Rental Model save table
        $rental = $stockBook->rentals()->latest('created_at')->first();
        if ($rental) {
            $rental->returned_date = now();
            $rental->save();
        }

        return redirect()->route('book.list');
    }
}