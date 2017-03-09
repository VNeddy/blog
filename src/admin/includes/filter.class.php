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
        // 过滤文章
        if ($current == "article") {
            if (!$data['url'] = filter_input(INPUT_POST, 'url', FILTER_VALIDATE_URL)) {
                $data['url'] = '';
            }
            if (!$data['content'] = filter_input(INPUT_POST, 'content', FILTER_CALLBACK, array('options'=>'Filter::validate_str'))) {
                $errors['content'] = '请输入合法内容';
            }
            if (!$data['author'] = filter_input(INPUT_POST, 'author', FILTER_CALLBACK, array('options'=>'Filter::validate_str'))) {
                $errors['author'] = '请输入作者';
            }
            if (!$data['title'] = filter_input(INPUT_POST, 'title', FILTER_CALLBACK, array('options'=>'Filter::validate_str'))) {
                $errors['title'] = '请输入合法标题';
            }
            $data['title'] = trim($data['title']);
            $data['author'] = trim($data['author']);
        }
        //过滤说说以及个人简介
        if ($current == "gossip" || $current == "about" || $current == "replay") {
            if (!$data['content'] = filter_input(INPUT_POST, 'content', FILTER_CALLBACK, array('options'=>'Filter::validate_str'))) {
                $errors['content'] = '请输入合法内容';
            }
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
