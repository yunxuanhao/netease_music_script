<?php
require 'vendor/autoload.php';
use Metowolf\Meting;
// 网易云歌曲id
$song_id = $argv[1];
$api = new Meting('netease');

$job = array();
if(!empty($song_id)) {
    $api->format(true);
    $data = json_decode($api->song($song_id),true);
    if(empty($data)) {
        exit('未找到指定歌曲'.PHP_EOL);
    }
    $job = array(
        'id'        => $data[0]['id'],
        'name'      => $data[0]['name'],
        'artist'    => $data[0]['artist'][0],
        'album'     => $data[0]['album'],
    );
}

printf(PHP_EOL."已找到歌曲《%s》- %s  所属专辑《%s》".PHP_EOL,$job['name'],$job['artist'],$job['album']);

$suppose_list = array(
    'tencent' => 'QQ音乐',
    'xiami' => '虾米音乐',
    'kugou' => '酷狗音乐',
    'baidu' => '百度音乐',
);
$best = 0;
foreach ($suppose_list as $suppose => $suppose_name) {
    $api->site($suppose);
    printf(PHP_EOL."正在%s搜索".PHP_EOL,$suppose_name);
    $data = $api->format(true)->search($job['name'].' '.$job['artist']);
    $data = json_decode($data,true);
    foreach($data as $vo){
        $ta = $job['name'];
        $tb = $vo['name'];
        similar_text($ta,$tb,$per);
        if($per < 50)continue;
        $ta = $job['name'].$job['album'].$job['artist'];
        $tb = $vo['name'].$vo['album'].$vo['artist'][0];
        similar_text($ta,$tb,$per);
        if($per > $best){
            $best = $per;
            $best_suppose = $suppose;
            $ans = $vo;
        }

    }
}

printf(PHP_EOL."最佳匹配：在%s匹配到《%s》- %s/%s，相似度 %d%%\n",$suppose_list[$best_suppose],$ans['name'],$ans['artist'][0],$ans['album'],$best);
$api->site($best_suppose);
$url = $api->url($ans['url_id']);
$url = json_decode($url,true);
exec('curl -o download/'.str_replace(' ', '', $ans['name']).'.mp3 "'.$url['url'].'"');