<?php

namespace Home\Controller;

/**
 * 错误页面
 */
class ErrorController extends HomeController {

    public function error_404(){
        $this -> display();
    }

}