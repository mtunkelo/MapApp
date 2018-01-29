<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyword extends Model
{
  use softDeletes;

  protected $table = 'keywords';

  protected $guarded = array('id');

  protected $fillable = array(
    'label',
  );


  public static $rules = array(
    'label'=>'max:124',
  );

  public function places()
  {
      return $this->belongsToMany(Place::class);
  }

  public function getRouteKeyName()
  {
      return 'label';
  }
}
