<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function validatePin(Request $request)
    {
        dd($request->pin);
    }

    public function color() {
        $naam = "Groen";
        $kleur = "green-500";

        return view("game.groupcolor", ["naam" => $naam, "kleur" => $kleur]);
    }
}
