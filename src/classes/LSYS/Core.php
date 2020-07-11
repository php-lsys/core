<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS;
/**
 * 核心环境参数
 */
abstract class Core{
	/**
	 * 开发环境
	 * @var int
	 */
	const PRODUCT  = 1;
	/**
	 * 测试环境
	 * @var integer
	 */
	const STAGING  = 2;
	/**
	 * 线上测试
	 * @var integer
	 */
	const TESTING  = 3;
	/**
	 * 生产环境
	 * @var integer
	 */
	const DEVELOP  = 4;
	/**
	 * 当前系统运行环境
	 * @var int
	 */
	static private $environment=self::PRODUCT;
	/**
	 * 字符编码
	 * @var string
	 */
	static private $charset;
	/**
	 * 当前系统版本
	 * @var string
	 */
	static private $version;
	/**
	 * 设置全局核心变量
	 * @param array $settings
	 */
	public static function sets(array $settings):void{
		if (isset($settings['charset']))
		{
			self::$charset = strtolower($settings['charset']);
		}
		if(is_null(self::$charset)){
			self::$charset='utf-8';//default charset
		}
		if (function_exists('mb_internal_encoding'))
		{
			mb_internal_encoding(self::$charset);
		}
		if (isset($settings['environment'])
			&&in_array($settings['environment'], [self::DEVELOP,self::PRODUCT,self::STAGING,self::TESTING]))
		{
			self::$environment=$settings['environment'];
		}
		if (isset($settings['version']))
		{
		    self::$version=strval($settings['version']);
		}
	}
	/**
	 * 当时环境是否与制定环境变量相同
	 * @param int $environment
	 * @return bool
	 */
	public static function envIs(int $environment):bool{
	    return self::$environment===$environment;
	}
	/**
	 * 当前环境变量
	 * @return int
	 */
	public static function env():int{
	    return self::$environment;
	}
	/**
	 * 当前系统版本号
	 * @return string
	 */
	public static function version():?string{
	    return self::$version;
	}
	/**
	 * 当前系统字符编码
	 * @return string
	 */
	public static function charset():string{
		if(is_null(self::$charset)){
			self::$charset='utf-8';//default charset
			if (function_exists('mb_internal_encoding'))
			{
				mb_internal_encoding(self::$charset);
			}
		}
	    return self::$charset;
	}
}