<?php

namespace OldApp\Tests\Excpetion;

use PHPUnit\Framework\TestCase;
use App\Exception\ExceptionContext;

class ExceptionContextTest extends TestCase
{
    public function testConstructPublicMessage()
    {
        $publicMessage = 'exception.type';
        $context = new ExceptionContext($publicMessage);
        $this->assertEquals($publicMessage, $context->getPublicMessage());
    }

    public function testConstructDefaultStatusCode500()
    {
        $publicMessage = 'exception.type';
        $context = new ExceptionContext($publicMessage);
        $this->assertEquals(500, $context->getStatusCode());
    }

    public function testConstructDefaultDebugMessageEmpty()
    {
        $publicMessage = 'exception.type';
        $context = new ExceptionContext($publicMessage);
        $this->assertEmpty($context->getDebugMessage());
    }

    public function testConstructDefaultParametersEmpty()
    {
        $publicMessage = 'exception.type';
        $context = new ExceptionContext($publicMessage);
        $this->assertEmpty($context->getParameters());
    }

    public function testConstructCustomStatusCode404()
    {
        $publicMessage = 'exception.type';
        $debugMessage = 'nothing to see here';
        $parameters = ['user' => 'testuser'];
        $statusCode = 404;
        $context = new ExceptionContext($publicMessage, $debugMessage, $parameters, $statusCode);
        $this->assertEquals(404, $context->getStatusCode());
    }

    public function testConstructCustomDebugMessage()
    {
        $publicMessage = 'exception.type';
        $debugMessage = 'nothing to see here';
        $parameters = ['user' => 'testuser'];
        $statusCode = 404;
        $context = new ExceptionContext($publicMessage, $debugMessage, $parameters, $statusCode);
        $this->assertEquals($debugMessage, $context->getDebugMessage());
    }

    public function testConstructCustomParameters()
    {
        $publicMessage = 'exception.type';
        $debugMessage = 'nothing to see here';
        $parameters = ['user' => 'testuser'];
        $statusCode = 404;
        $context = new ExceptionContext($publicMessage, $debugMessage, $parameters, $statusCode);
        $this->assertEquals($parameters, $context->getParameters());
    }

    public function testGetTranslationParameters()
    {
        $publicMessage = 'exception.type';
        $debugMessage = 'nothing to see here';
        $parameters = ['user' => 'testuser'];
        $statusCode = 404;
        $context = new ExceptionContext($publicMessage, $debugMessage, $parameters, $statusCode);
        $placeholders = $context->getTranslationParameters($parameters);
        $this->assertEquals(['%user%' => 'testuser'], $placeholders);
    }
}
