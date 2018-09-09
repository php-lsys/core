<?php
namespace LSYS;
use PHPUnit\Framework\TestCase;
final class ExceptionTest extends TestCase
{
    public function testAll()
    {
        $this->expectException(Exception::class);
        throw new Exception("test",111);
    }
}