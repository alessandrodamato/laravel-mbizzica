<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PasteRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Tag;

class NoAuthPasteController extends Controller
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
    $paste = null;
    $tags = Tag::all();
    $method = 'POST';
    $btn = 'Crea';
    $route = route('noauth-pastes.store');
    return view('noauth-create', compact('paste', 'tags', 'method', 'btn', 'route'));
  }

  /**
   * Store a newly created resource in storage.
   */

  public function store(PasteRequest $request)
  {

    // CAPTCHA
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
      'secret' => config('services.recaptcha.secret'),
      'response' => $request->input('g-recaptcha-response'),
      'remoteip' => $request->ip(),
    ]);

    $recaptchaResult = $response->json();

    if (!$recaptchaResult['success']) {
      return back()->withErrors(['recaptcha' => 'Verifica reCAPTCHA non riuscita. Riprova.'])->withInput();
    }

    // RATE LIMITING
    $cacheKey = 'paste_creation_' . $request->ip();
    $requests = cache()->get($cacheKey, 0);
    $limit = 6;
    $minutes = 1;

    if ($requests >= $limit
    ) {
      return back()->withErrors(['rate_limit' => "Hai superato il limite di $limit creazioni per minuto. Riprova più tardi."])->withInput();
    }

    cache()->put($cacheKey, $requests + 1, $minutes * 60);

    // SALVATAGGIO NEL JSON
    $filePath = 'data/noauth-pastes.json';

    if (Storage::exists($filePath)) {
      $jsonData = Storage::get($filePath);
      $pastes = json_decode($jsonData, true);
    } else {
      $pastes = [];
    }

    if ($request->hasFile('file')) {
      $file = $request->file('file')->store('uploads', 'public');
    } else {
      $file = null;
    }

    $newPaste = [
      'id' => null,
      'user_id' => null,
      'title' => $request->title,
      'content' => $request->content,
      'visibility' => $request->visibility,
      'expiration_date' => $request->expiration_date,
      'password' => $request->password,
      'tags' => $request->tags,
      'file' => $file,
    ];

    $pastes[] = $newPaste;

    $jsonData = json_encode($pastes, JSON_PRETTY_PRINT);
    Storage::put($filePath, $jsonData);

    return redirect()->route('home');
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
