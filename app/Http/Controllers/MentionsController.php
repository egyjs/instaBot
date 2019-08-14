<?php

namespace App\Http\Controllers;

use App\Mention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class MentionsController extends Controller{


    public $catList = ([
        "Sing"=>["noor.malak.jana","almar_samer","sohaelknawy","zico2297","neighbor_moon_","ror.k.k","zoza.beso.1","myhr.hhlhb","nunaosman","mem_business63","toqaeladly","mohmed_khedr","zenhoomabdo","design7878","kokokok9892","ahmed_mousaa.1","yr_lrby","ritacassandra25","mohamdalsghir","xx__yaaara__xx","vivi_yasmeen","hossammukhaimar","walaasaad13","muniraneyazi","nirmine_narimal","moamennady","assmaaa25","mai_mostafa22","sososoadsoso","mohamed.elenany.1180","k_kholoud_","mohmaudmai","mohammedismail377","f.thakir","lllwl81","nour_sabry122","sheryrafat828","eman_ony","_menna_mfathy","marwagamal322","elhekool","joodess6","mrkhld393","mlksb1069","h_10se","m_nccm","k_.x9","ahmed.gom3aaaa","hatim7789","fatema98_89","mido.hesham.7528","hisaen2018","72uix","marwan.hassan.718689","ivfu4","mwkshtmwksht720","mayarhany60","ma6586134","atalla933","shereen_abdo_22","asmaaesmail63","hamosaid3","elbanna_samy","alaa_abo_younis","merazehery1010","asmataha1986","mostafa_abohelal.74","m.nady15","nadiinhussam","mahhabibah","hassan_adm","mohamedesmail2000","fa3xx_f","taalllaatey","omar.rabee.3344","bebode_ana_31","ayayman25","razan._._","khaled_elkhayat22","esraahussein49","x_mazen_slman_______________xx","fashion_s193","jaasmine_spamzzzzzz","cccc565656565","hagerbazoom","ahmed6863ali","nada_amr26","fayrouz_ehab9","ah.ma7649","eman_eldsooky","hagermostafa83","lbnwasl","same7.basha","llmosthel","shimaa6502","gana0122","thegraetrana","tamerelhetamy","niissrine_nina","nada.tarek74",],
//            'Nature'=>array(),
//            "Happiness"=>array(),
//            "Humor"=>array(),
//            "art"=>array(),
//            "Travel"=>array(),
//            "Animals"=>array(),
//            "Miscellaneous"=>array()
    ]);
    public $MENTION = 5;
    public $sleep = 25;

    public function __construct(){
        set_time_limit(0);
        ignore_user_abort(true);
        $this->middleware('auth');
    }


    public function index(){
        $buttons = collect(array(  (object) [
            'name'=>'Add new',
            'href'=>route(getModal().'.add'),
            'type'=>'success',
            'icon'=>'plus'
        ], (object) [
            'name'=>'deleted',
            'href'=>'?deleted=1',
            'type'=>'danger',
            'icon'=>'minus'
        ]));


        if (isset($_GET['deleted'])){
            $mentions = Mention::where('by',Auth::id())->withTrashed()->get();

        }else{
            $mentions = Mention::where('by',Auth::id())->get();
        }

        return view('users.mentions.index',compact('buttons','mentions'));
    }

    public function add(){


//        dd($catList);

//        return view('mentions.add',compact('buttons'));
        return view('users.mentions.add')->with('catList',$this->catList)
            ->with('step',$this->MENTION)
            ->with('sleep',$this->sleep);
    }

    public function store(Request $request){
        ignore_user_abort(true);

        $mention = new Mention();
        $postUrl    = $request->url;
        $count   = $request->count;
        $mention->by     = auth()->id();
        $mention->url    = $postUrl;
        $mention->count  = $count;



        //---------------------------
        $cookie = get_cookie();
        $useragent = generate_useragent();

//        $req = proccess(1, $useragent, 'feed/timeline/', $cookie);



        $urls = trim($postUrl);
//        dd($urls);
        $urls = trim($postUrl);
        $urls = explode("\n", $urls);
        $urls = array_filter($urls, 'trim'); // remove any extra \r characters left behind
//        dd($urls);
        foreach ($urls as $url) {

            $cmnts = $this->catList[$request->cat];

//        foreach ()

            $MENTION = $this->MENTION;
            $ROW = (int)($count / $MENTION);

            $mention->save();
            for ($x = 0; $x < $ROW; $x++) {
                $mediaid = getmediaid($url);

                $txt_comment = '';
                for ($y =0; $y < ($MENTION); $y++)
                    $txt_comment .=  "@".trim($cmnts[array_rand($cmnts)]).' ' ;


                //start
                $comment = proccess(1, $useragent, 'media/' . $mediaid . '/comment/', $cookie, hook('{"comment_text":"' . $txt_comment . ' "}'));
                $comment = json_decode($comment[1]);

                if ($comment == null ) return response()->json([ 'msg'=>'Post not found Or the Account is Private', 'status'=>404, ],404);
                if ($comment->status == 'ok') {
                    echo "[+] Success comment" . "\n";
                    activity('mention')
                        ->withProperties([ 'url' =>$url, 'i'=>($x+1)."/$ROW"])
                        ->log('[+] Success comment');

                    Log::info($url.': [+] Success comment');
                } else {
                    activity('mention')
                        ->withProperties(['url'=>($url),'i'=>($x+1)."/$ROW",'commentResponse'=>$comment])
                        ->log('[!] Failed comment');

                    echo "[!] Failed comment" . "\n";
                    print_r($comment);
                    Log::error(json_encode($urls)."[!] Failed comment".json_encode($comment));
                    if (isset($comment->comment_error_key) and $comment->comment_error_key == 'comment_si_blocked') exit;
                }
                sleep($this->sleep);
            }

        }

        //---------------------------

    }

    public function delete($id){
        $ment = Mention::withTrashed()->find($id);
//        dd($ment);
        if ($ment->trashed()){
            $ment->restore();
            return redirect()->back()->with('status','Done Resorted');

        }else{
            $ment->delete();
            return redirect()->back()->with('status','Done Deleted');

        }
    }



}
