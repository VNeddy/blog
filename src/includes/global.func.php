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
?>
