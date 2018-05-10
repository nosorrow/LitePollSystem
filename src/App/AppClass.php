<?php

namespace App;

class AppClass
{
    public $request;

    /**
     * AppClass constructor.
     */
    public function __construct()
    {
        $this->request = \System\Request::getInstance();
    }
}