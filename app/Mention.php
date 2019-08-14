<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Models\Activity;


/**
 * @method static where(string $string, int|null $id)
 */
class Mention extends Model {

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function status(){
        $act = Activity::where('properties->url', $this->url)->orderBy('id','desc')->first();
        if ($act) {
            $i = $act->getExtraProperty('i');
            if (preg_match('/(\!)/', $act->description)) {
                return html(display('Failed'), 'red');
            } else if (explode('/', $i)[0] == explode('/', $i)[1]) {
                return html(display('Done'), 'green');
            } else {
                return html(display('we work on it'), 'orange');
            }
        }
    }
}
