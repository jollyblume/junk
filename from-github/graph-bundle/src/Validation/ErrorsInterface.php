<?php

namespace Jollyblume\Bundle\GraphBundle\Validation;

interface ErrorsInterface
{
    /**
     * @return bool
     */
    public function isValid() : bool;

    /**
     * @return bool
     */
    public function hasErrors() : bool;

    /**
     * @return array [[<error-message>|[<error-message>, ...]], ...]
     */
    public function getErrors() : array;

    /**
     * @param mixed $errorMessage
     * @return self
     */
    public function addError($errorMessage) : ErrorsInterface;

    /**
     * @return self
     */
    public function clearErrors() : ErrorsInterface;
}
