<?php

namespace App\Http\Controllers;
use App\Models\Keyword as Keyword;


use Illuminate\Http\Request;

class KeywordController extends Controller
{
    public function index(Keyword $keyword)
    {

      $places = $keyword->places;
      return $places;

      return view('public.index', compact('places', 'keywords'));

    }

}
