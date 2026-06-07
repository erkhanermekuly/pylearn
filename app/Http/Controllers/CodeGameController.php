<?php

namespace App\Http\Controllers;

class CodeGameController extends Controller
{
    public function index()
    {
        $raw = require database_path('seeders/data/code_puzzles.php');

        $puzzles = collect($raw)->map(function (array $puzzle) {
            $solution = $puzzle['lines'];
            $shuffled = $solution;

            do {
                shuffle($shuffled);
            } while ($shuffled === $solution && count($solution) > 1);

            return [
                'id' => $puzzle['id'],
                'title' => __('messages.' . $puzzle['title_key']),
                'hint' => __('messages.' . $puzzle['hint_key']),
                'shuffled' => $shuffled,
                'solution' => $solution,
            ];
        })->values();

        return view('student.code-game', compact('puzzles'));
    }
}
