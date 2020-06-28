<?php
namespace LSYS;
use PHPUnit\Framework\TestCase;
final class CoreTest extends TestCase
{
    public function testSet()
    {
       Core::sets(array(
           'charset'=>'utf-8',
           'environment'=>Core::DEVELOP,
           'version'=>'1.0.0'
       ));
       $this->assertEquals(Core::charset(), 'utf-8');
       $this->assertEquals(Core::environment(), Core::DEVELOP);
       $this->assertTrue(Core::envIs(Core::DEVELOP));
       $this->assertEquals(Core::version(), '1.0.0');
    }
}