<?php
namespace LSYS;
use PHPUnit\Framework\TestCase;
final class CoreTest extends TestCase
{
    public function testSet()
    {
       Core::sets(array(
           'charset'=>'utf-8',
           'environment'=>Core::DEVELOP
       ));
       $this->assertEquals(Core::$charset, 'utf-8');
       $this->assertEquals(Core::$environment, Core::DEVELOP);
    }
}