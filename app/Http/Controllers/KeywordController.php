<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use View;
use Validator;
use App\Models\Keyword as Keyword;
use App\Models\Place as Place;
use Illuminate\Foundation\Validation\ValidatesRequests;

class KeywordController extends Controller
{

    public function allKeywords()
    {
      $keywords = Keyword::all();
      return json_encode(Keyword::all());
    }

    public function store(Request $request)
    {
      $keyword = $this->validate(request(),[
        'label' => 'required'
      ]);

      Keyword::create($keyword);

      return view('public.index');

    }

}
