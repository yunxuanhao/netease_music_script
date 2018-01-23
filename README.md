# music_script

从其它渠道下载网易云音乐下架的歌曲。
该脚本参考了[@metowolf](https://github.com/metowolf)的脚本，并且使用了他的[Meting](https://github.com/metowolf/Meting)，在此表示感谢 

## 环境要求
- php
- curl
- composer

## 安装方式

composer install

## 使用方法

php get_music.php {网易云song-id}

```
$ php get_music.php 22833991

已找到歌曲《기억을 걷는 시간》- Nell  所属专辑《Separation Anxiety》

正在QQ音乐搜索

正在虾米音乐搜索

正在酷狗音乐搜索

正在百度音乐搜索

最佳匹配：在虾米音乐匹配到《기억을 걷는 시간》- Nell/Separation Anxiety，相似度 100%
  % Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                 Dload  Upload   Total   Spent    Left  Speed
100 4891k  100 4891k    0     0   575k      0  0:00:08  0:00:08 --:--:--  672k

```
