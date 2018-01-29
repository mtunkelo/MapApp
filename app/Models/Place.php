<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
  use softDeletes;

  protected $table = 'places';

  protected $guarded = array('id');

  protected $fillable = array(
    'title',
    'description',
    'lat',
    'lng',
    'open_hours',
    'favorite'
  );


  public static $rules = array(
    'title'=>'max:124',
    'description'=>'max:264',
    'lat'=>'max:12',
    'lng'=>'max:12',
    'open_hours'=>'max:24',
    'favorite'=>'boolean'

  );

  public function keywords()
  {
    return $this->belongsToMany(Keyword::class);
  }

}
