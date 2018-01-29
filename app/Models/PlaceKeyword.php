<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaceKeyword extends Model
{
  use softDeletes;

  protected $table = 'place_keywords';

  protected $guarded = array('id');




/**
 * Has-Many relation
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function places()
{
    return $this->HasMany(Place::class);
}

public function keywords()
{
    return $this->HasMany(Keyword::class);
}
}
