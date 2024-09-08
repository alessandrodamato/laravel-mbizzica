<?php

namespace App\Http\Controllers;

use App\Models\Paste;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasteRequest;

class PasteController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $pastes = Paste::where('user_id', Auth::id())->get()->sortDesc();
    $message = 'Non hai paste nel tuo database';
    return view('admin.pastes.index', compact('pastes', 'message'));
  }

  public function publicIndex()
  {
    $pastes = Paste::where('visibility', 1)->get()->sortDesc();
    $message = 'Non ci sono paste pubblici';
    return view('home', compact('pastes', 'message'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $paste = null;
    $tags = Tag::all();
    $method = 'POST';
    $btn = 'Crea';
    $route = route('pastes.store');
    return view('admin.pastes.create-edit', compact('paste', 'tags', 'method', 'btn', 'route'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(PasteRequest $request)
  {
    $form_data = $request->all();

    if (array_key_exists('file', $form_data)) {
      $file = Storage::disk('public')->put('uploads', $form_data['file']);
      $form_data['file'] = $file;
    } else {
      $form_data['file'] = null;
    }

    $form_data['user_id'] = Auth::id();
    $form_data['password'] = isset($form_data['password']) ? Hash::make($form_data['password']) : null;

    $new_paste = new Paste();
    $new_paste->fill($form_data);
    $new_paste->save();

    if (isset($form_data['tags'])) {
      $tags = explode(',', $form_data['tags']);
      foreach ($tags as $tag) {
        $new_tag = new Tag();
        $new_tag->name = $tag;
        $new_tag->save();
        $new_paste->tags()->attach($new_tag);
      }
    }

    return redirect()->route('pastes.index')->with('success', 'Paste creato con successo');
  }

  public function getPassword(Request $request) {}

  /**
   * Display the specified resource.
   */

  public function show(Request $request, string $id)
  {
    $paste = Paste::find($id);

    if (!$paste) {
      return redirect()->route('home');
    }

    $user = auth()->user();

    if ($paste->visibility === 1) {
      $paste->visibility = 'Pubblico';
    } elseif ($paste->visibility === 2) {
      $paste->visibility = 'Privato';
      if (!$user || $paste->user_id !== $user->id) {
        return redirect()->route('home');
      }
    } elseif ($paste->visibility === 3) {
      $paste->visibility = 'Non in elenco';
    }

    if ($user && $paste->user_id === $user->id) {
      return view('admin.pastes.show', ['paste' => $paste, 'password_correct' => true]);
    }

    if ($request->has('confirm')) {
      $inputPassword = $request->input('confirm');

      if (Hash::check($inputPassword, $paste->password)) {
        return view('admin.pastes.show', ['paste' => $paste, 'password_correct' => true]);
      } else {
        return redirect()->route('pastes.show', $paste->id)
          ->withErrors(['confirm' => 'Password non corretta'])
          ->withInput();
      }
    }

    return view('admin.pastes.show', ['paste' => $paste, 'password_correct' => false]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
    return view('admin.pastes.create-edit');
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
