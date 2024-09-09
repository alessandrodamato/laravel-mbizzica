<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Paste;
use App\Models\Comment;

class CommentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    $request->validate([
      'paste_id' => 'required|exists:pastes,id',
      'text' => 'required|string|max:3000',
    ]);

    $comment = new Comment();
    $comment->user_id = Auth::id();
    $comment->paste_id = $request->input('paste_id');
    $comment->text = $request->input('text');
    $comment->save();

    return redirect()->route('pastes.show', $request->input('paste_id'))
    ->with('success', 'Commento aggiunto con successo!');
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
