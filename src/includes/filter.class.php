<?php
// header('Content-Type:text/html;charset=utf8');
// 防止恶意调用
if (!defined('IN_TG')) {
    exit('Access Defined');
}

class Filter {
    private $data = array();
    function __construct($data) {
        $this->data = $data;
    }

    /**
     * 过滤提交信息
     * @param  array $arr 待过滤信息
     * @return bool      输入是否合法
     */
    public static function validate(&$arr, $current) {
        // if (!filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
        //     $errors['email'] = '请输入合法邮箱';
        // }

        // 过滤留言
        if ($current == "message") {
            if (!$data['tmpuser'] = filter_input(INPUT_POST, 'tmpuser', FILTER_CALLBACK, array('options'=>'Filter::validate_str'))) {
                $errors['tmpuser'] = '请输入合法昵称';
            }
            if (!$data['content'] = filter_input(INPUT_POST, 'content', FILTER_CALLBACK, array('options'=>'Filter::validate_str'))) {
                $errors['content'] = '请输入合法内容';
            }
            $data['tmpuser'] = trim($data['tmpuser']);
        }

        if (!empty($errors)) {
            $arr = $errors;
            return false;
        }
        $arr = $data;
        // $arr['email'] = strtolower(trim($arr['email']));
        return true;
    }

    /**
     * 过滤特殊字符
     * @param  string $str 要过滤的字符串
     * @return false|string      空字符串返回false，否则返回过滤后字符串
     */
    public static function validate_str($str) {
        if (mb_strlen($str, 'UTF8') < 1) {
            return false;
        }
        $str = nl2br(htmlspecialchars($str, ENT_QUOTES));
        return $str;
    }
}
