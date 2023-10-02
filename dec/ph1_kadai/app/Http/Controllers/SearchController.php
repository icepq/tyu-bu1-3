<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\User;
use Auth;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index1(Request $request)
    {
        $keyword = trim($request->keyword);
        $words = User::query()
            ->find(Auth::user()->id)
            ->userWords()
            ->where('word', 'like', "{$keyword}%")
            ->get();
        return response()->view('word.index', compact('words'));
    }

    public function index2(Request $request)
    {
        $keyword = trim($request->keyword);
        $words = User::query()
            ->find(Auth::user()->id)
            ->userWords()
            ->where('word', 'like', "%{$keyword}%")
            ->get();
        return response()->view('word.index', compact('words'));
    }

    public function index3(Request $request)
    {
        $keyword = trim($request->keyword);
        $words = User::query()
            ->find(Auth::user()->id)
            ->userWords()
            ->where('meaning', 'like', "{$keyword}%")
            ->get();
        return response()->view('word.index', compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('search.input');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
