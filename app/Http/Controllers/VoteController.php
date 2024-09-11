<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vote;

class VoteController extends Controller
{
  public function handleVote(Request $request, $pasteId)
  {
    $userId = auth()->id();
    $voteValue = $request->input('vote');

    $existingVote = Vote::where('user_id', $userId)->where('paste_id', $pasteId)->first();

    if ($existingVote) {
      if ($existingVote->vote == $voteValue) {
        $existingVote->delete();
      } else {
        $existingVote->update(['vote' => $voteValue]);
      }
    } else {
      Vote::create([
        'user_id' => $userId,
        'paste_id' => $pasteId,
        'vote' => $voteValue
      ]);
    }

    return redirect()->back();
  }
}

