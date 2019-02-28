<?php

namespace OldApp\Tests\Excpetion;

use PHPUnit\Framework\TestCase;
use App\Exception\BaseException;
use App\Exception\ExceptionContext;

class BaseExceptionTest extends TestCase
{
    public function testGetContext()
    {
        $context = $this->createMock(ExceptionContext::class);
        $context->method('getStatusCode')->willReturn(500);
        $context->method('getDebugMessage')->willReturn('test debug message');
        $exception = new BaseException($context);
        $this->assertEquals($context, $exception->getContext());
    }

    public function testGetPublicMessage()
    {
        $context = $this->createMock(ExceptionContext::class);
        $context->method('getStatusCode')->willReturn(500);
        $context->method('getPublicMessage')->willReturn('exception.test');
        $context->method('getDebugMessage')->willReturn('test debug message');
        $exception = new BaseException($context);
        $this->assertEquals('exception.test', $exception->getPublicMessage());
    }

    public function testGetDebugMessage()
    {
        $context = $this->createMock(ExceptionContext::class);
        $context->method('getStatusCode')->willReturn(500);
        $context->method('getDebugMessage')->willReturn('test debug message');
        $exception = new BaseException($context);
        $this->assertEquals('test debug message', $exception->getDebugMessage());
    }

    public function testGeStatusCode()
    {
        $context = $this->createMock(ExceptionContext::class);
        $context->method('getStatusCode')->willReturn(500);
        $context->method('getDebugMessage')->willReturn('test debug message');
        $exception = new BaseException($context);
        $this->assertEquals(500, $exception->getStatusCode());
    }

    public function testGetParameters()
    {
        $context = $this->createMock(ExceptionContext::class);
        $context->method('getStatusCode')->willReturn(500);
        $context->method('getParameters')->willReturn([]);
        $context->method('getDebugMessage')->willReturn('test debug message');
        $exception = new BaseException($context);
        $this->assertEquals([], $exception->getParameters());
    }
}
