<?php
include_once __DIR__."/../vendor/autoload.php";
LSYS\Core::sets(array(
    //定义编码
	"charset"              => "utf-8",
    //定义开发环境
    "environment"		   => LSYS\Core::DEVELOP
));