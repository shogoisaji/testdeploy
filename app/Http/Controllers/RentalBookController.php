<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\StockBook;
use Auth;
use Illuminate\Http\Request;

class RentalBookController extends Controller
{
    public function rental(Request $request, $id)
    {
        $stockBook = StockBook::find($id);
        if ($stockBook->is_rental) {
            return redirect()->back()->with('error', 'This book is already rented.');
        }

        // Rental Model save table
        $rental = new Rental;
        $rental->user_id = auth()->id();
        $rental->stock_book_id = $stockBook->stock_book_id;
        $rental->rental_date = now();
        $rental->return_date = now()->addDays(7);
        $rental->save();

        // StockBook Model save table
        $stockBook->is_rental = true;
        $stockBook->save();

        return redirect()->route('book.list')->with('success', 'The book has been rented.');
    }

    // login user rental history list
    public function list()
    {
        $userId = Auth::id();
        $rentals = Rental::with('stockBook')->where('user_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('books.rentals', ['rentals' => $rentals]);
    }
}