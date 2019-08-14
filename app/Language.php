<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * @method static where(string $string, int|null $id)
 */
class Language extends Model {

    protected $table = 'language';

    use SoftDeletes;
    protected $dates = ['deleted_at'];

}
