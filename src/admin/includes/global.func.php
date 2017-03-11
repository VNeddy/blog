<?php
header('Content-Type:text/html;charset=utf8');
/**
 * 用来获取执行耗时
 * @access public
 * @return float 返回浮点型数字
 */
function _runtime() {
    $_mytime = explode(' ',microtime());
    return $_mytime[0] + $_mytime[1];
}

/**
 * 用来取消字符串中的<br />
 * @access public
 * @return string 返回字符串
 */
function br2nl($text) {
    return preg_replace('/<br\\s*?\/??>/i','',$text);
}

/**
 * 用来生成验证码
 * @access public
 * @param  integer $_width    验证码图片长度
 * @param  integer $_height   验证码图片高度
 * @param  integer $_rnd_code 验证码个数
 * @return void             执行后生成验证码
 */
function _code($_width = 100, $_height = 30, $_rnd_code = 4) {
    // 创建随机码
    $_nmsg="";
    for ($i = 0; $i < $_rnd_code; $i++) {
        $_nmsg .= dechex(mt_rand( 0, 15));
    }

    // 保存在session中
    $_SESSION['code'] = $_nmsg;

    // 创建一张图像
    $_img = imagecreatetruecolor($_width, $_height);

    // 画笔
    $_color = imagecolorallocate($_img, 250, 250, 250);

    // 填充
    imagefill($_img, 0, 0, $_color);

    // 随机画出6个线条
    for ($i = 0; $i < 6; $i++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand( 0, 255), mt_rand( 0, 255), mt_rand( 0, 255));
        imageline($_img, mt_rand(0,100), mt_rand(0,30),mt_rand(0,100), mt_rand(0,30), $_rnd_color);
    }

    // 随机雪花
    for ($i = 0; $i < 100; $i++) {
        $_rnd_color = imagecolorallocate($_img, mt_rand( 200, 255), mt_rand( 200, 255), mt_rand( 200, 255));
        imagestring($_img, 1, mt_rand(1,$_width), mt_rand(1,$_height), '*', $_rnd_color);
    }

    // 输出验证码
    $_code_color = imagecolorallocate($_img, mt_rand( 0, 100), mt_rand( 0, 150), mt_rand( 0, 200));
    for ($i = 0; $i < $_rnd_code; $i++) {
        imagestring($_img, mt_rand(5, 7), $i * $_width/$_rnd_code + mt_rand(1, 15), mt_rand(1, $_height/2), $_SESSION['code'][$i], $_code_color);
    }

    // 输出图像
    header('Content-Type:image:png');
    imagepng($_img);

    // 销毁图像
    imagedestroy($_img);
}
?>
