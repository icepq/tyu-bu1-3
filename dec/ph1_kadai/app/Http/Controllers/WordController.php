<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Word;

class WordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $words = Word::getAllOrderBy();
        return response()->view('word.index',compact('words'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return response()->view('word.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'word' => 'required | max:64 | regex:/^[a-zA-Z]+$/',
            'meaning' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
            ->route('word.create')
            ->withInput()
            ->withErrors($validator);
        }
        
        $result = Word::create($request->all());
        return redirect()->route('word.index');
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
        $result = Word::find($id)->delete();
        return redirect()->route('word.index');
    }
}
