<?php

//与微信测试号打通
define('J','php');
$wechat = new Wechat;
$wechat -> validate();

    class wechat{
        public function validate(){
            if($this -> checkSignature()){
                echo $_GET['echostr'];
            }
        }
        private function checkSignature(){
            if(!defined('J')){
                return false;
            }
            $signature = $_GET['signature'];
            $timestamp = $_GET['timestamp'];
            $nonce = $_GET['nonce'];
            $tmpArr = array($timestamp,$nonce,J);
            sort($tmpArr, SORT_STRING);
            $tmpStr = implode($tmpArr);
            $tmpStr = sha1($tmpStr);
            if($tmpStr == $signature){
                return true;
            }else {
                return false;
            }
        }
    }
?>