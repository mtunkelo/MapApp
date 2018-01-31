<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use View;
use Validator;
use App\Models\Place as Place;
use App\Models\Keyword as Keyword;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PlaceController extends Controller
{

  public function index()
  {
    $places = Place::all();

    return view('public.index', compact('places'));
  }

  public function store(Request $request)
  {
    $place = $this->validate(request(),[
      'title' => 'required',
      'description' => 'required',
      'lat' => 'required',
      'lng' => 'required',
      'open_hours' => 'required',
      'favorite' => 'required',
    ]);

    Place::create($place);
    return view('public.index');

  }

  public function search(Request $request)
  {
    if($request->ajax())
    {
      $output='';

      $places = DB::table('places')
      ->whereNull('deleted_at')
      ->where('title','LIKE','%'.$request->search."%")
      ->get();

      if($places)
      {
        foreach ($places as $key => $place) {
          $output.='<tr>'.
          '<td>'.$place->title.'</td>'.
          '<td>'.$place->open_hours.'</td>'.
          '</tr>';
        }

        return Response($output);
      }
    }
  }


  // public function update(Request $request)
  // {
  //
  //   $place = Place::where('id', '=', $request->id)->first();
  //   if($place)
  //   {
  //     $place->title = $request->get('title');
  //     $place->description = $request->get('description');
  //     $place->open_hours = $request->get('open_hours');
  //     $place->lat = $request->get('lat');
  //     $place->lng = $request->get('lng');
  //     $place->favorite = $request->get('favorite');
  //     $place->save();
  //     return response()->make('Nyt on päivitetty');
  //
  //   } else
  //   {
  //     return response()->make('error', 400);
  //   }
  // }

  public function delete($id = null){

    if(!is_null($id))
    {
      $place = Place::where('id', '=', $id)->first();

      if($place)
      {
        $place->delete();
      }
      return response()->make('Nyt on poistettu');

    } else
    {
      return response()->make('error', 400);
    }
  }

  public function all()
  {
    $places = Place::all();
    return json_encode(Place::all());

  }

}
