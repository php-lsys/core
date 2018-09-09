<?php
/**
 * 核心变量
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS;
/**
 * @author lonely
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
	 * [read-only]当前系统运行环境
	 * @var int
	 */
	static public $environment=self::PRODUCT;
	/**
	 * [read-only]字符编码
	 * @var string
	 */
	static public $charset='utf-8';
	/**
	 * 设置全局核心变量
	 * @param array $settings
	 */
	public static function sets(array $settings){
		if (isset($settings['charset']))
		{
			self::$charset = strtolower($settings['charset']);
		}
		if (function_exists('mb_internal_encoding')&&self::$charset!==null)
		{
			mb_internal_encoding(self::$charset);
		}
		if (isset($settings['environment'])
			&&in_array($settings['environment'], [self::DEVELOP,self::PRODUCT,self::STAGING,self::TESTING]))
		{
			self::$environment=$settings['environment'];
		}
	}
}