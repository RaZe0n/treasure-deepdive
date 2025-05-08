<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function color() {
        $naam = "Groen";
        $kleur = "green-500";

        return view("game.vraag2", ["naam" => $naam, "kleur" => $kleur]);
    }
}
