<?php
/**
 * @author     Lonely <shan.liu@msn.com>
 * @copyright  (c) 2017 Lonely <shan.liu@msn.com>
 * @license    http://www.apache.org/licenses/LICENSE-2.0
 */
if (function_exists('mb_substitute_character'))
{
	mb_substitute_character('none');
}
if (function_exists('mb_internal_encoding')){
   mb_internal_encoding(LSYS\Core::$charset);
}
// LSYS\Core::sets(array(
//     'charset'=>'utf-8',
//     'environment'=>LSYS\Core::$environment
// ));
//di reg share object
// LSYS\DI::get()->functionName(new Callback(function(){
//     return share_object;
// },true));
// DI::set(function(){
//     return new DI();//your app di
// });