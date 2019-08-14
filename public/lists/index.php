<?php
function bo_print_nice_array($array){
    echo '$array=';
    bo_print_nice_array_content($array, 1);
    echo ';';
}
function bo_print_nice_array_content($array,$length = null,$beauty = false,$keys = false,$deep=1){
    $indent = '';
    $indent_close = '';
    if(isset($length)) $array= array_slice($array, 0, $length);
    echo "[";
    for($i=0; $i<$deep; $i++){
        $indent.='&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    for($i=1; $i<$deep; $i++){
        $indent_close.='&nbsp;&nbsp;&nbsp;&nbsp;';
    }
    foreach($array as $key=>$value){
        if($beauty) echo "<br>".$indent;
        $k = ($keys != false)?''.$key.' => ': "";
        echo $k;
        if(is_string($value)){
            echo '"'.$value.'"';
        }elseif(is_array($value)){
            bo_print_nice_array_content($value, ($deep+1));
        }else{
            echo $value;
        }
        echo ',';
    }
    echo $indent_close.']';
}
if (isset($_GET['list']) and file_exists($_GET['list'])){
    $data = file_get_contents($_GET['list']);

    $array = explode("\n" , $data);

    bo_print_nice_array_content($array,100);

}else {
    echo '<h1>Array Form txt</h1>';
    foreach (scandir('.') as $list) {
        if ($list != '..' and $list != '.' and $list != 'index.php') {
            echo "<a href='?list=$list'>$list</a><br>";
        }
    }
}
?>
