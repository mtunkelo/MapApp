<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Models\Places as Places;

class PublicController extends Controller
{
  /**
   * Show the main public index
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('public.index');
  }

}
