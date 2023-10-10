<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    // use api google books
    public function search(Request $request)
    {
        $client = new \App\Services\GoogleBooksClient(config('services.google_books.key'));
        if ($request->has('keyword'))  {
            $keyword = $request->input('keyword');
            $books = $client->searchBook($keyword);
        } else {
            $books = $client->searchBook('books');
        }
        return view('books.search', ['books' => $books]);
    }

    public function searchForm()
    {
        if (auth()->user()->is_admin) {
            return view('books.searchForm');
        }
        return redirect('/');
    }

    public function  searchResult(Request $request)
    {
        $client = new \App\Services\GoogleBooksClient(config('services.google_books.key'));
        if ($request->has('keyword'))  {
            $keyword = $request->input('keyword');
            $books = $client->searchBook($keyword);
        } else {
            $books = $client->searchBook('books');
        }
        return view('books.searchResult', ['books' => $books]);
    }
}
