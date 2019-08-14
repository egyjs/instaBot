<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Spatie\Activitylog\Models\Activity;
use TCG\Voyager\Models\Page;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $this->middleware('auth');
        return view('home');
    }



    public function welcome(){

        $pages = Page::all();

        return view('welcome',compact('pages'));
    }

    public function page($slug){
        $page = Page::where('slug','like',"%$slug%")->withTranslation(['ar','en'])->firstOrFail();

//        $page = $page->translate('locale', 'fallbackLocale');
        $page = $page->translate(App::getLocale());
//        dd($page);
        return view('page',compact('page'));
    }

}
