<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
namespace LSYS;
/**
 * 基础公共异常基类
 */
class Exception extends \Exception {
	/**
	 * Creates a new translated exception.
	 *
	 *     throw new Exception('Something went terrible wrong');
	 *
	 * @param   string          $message    error message
	 * @param   integer|string  $code       the exception code
	 * @param   Exception       $previous   Previous exception
	 * @return  void
	 */
    public function __construct(string $message = NULL, $code = 0, \Exception $previous = NULL)
	{
		parent::__construct($message, $code, $previous);
		$this->code = $code;
	}
}