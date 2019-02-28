<?php

namespace Jollyblume\Bundle\GraphBundle\Validation;

use Jollyblume\Bundle\GraphBundle\Validation\ValidityChainInterface;

trait ErrorsTrait
{
    /**
     * @var array $errors [[<error-message>|[<error-message>, ...]], ...]
     */
    private $errors;

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        $hasErrors = $this->hasErrors();
        if (true === $hasErrors) {
            return false;
        }

        if ($this instanceof ValidityChainInterface) {
            return $this->isChainValid();
        }

        return true;
    }

    /**
     * @return bool
     */
    public function hasErrors() : bool
    {
        $errors = $this->getErrors();
        return !empty($errors);
    }

    /**
     * @return array [[<error-message>|[<error-message>, ...]], ...]
     */
    public function getErrors() : array
    {
        $errors = $this->errors;
        if (null === $errors) {
            $errors = [];
        }

        return $errors;
    }

    /**
     * @param mixed $errorMessage
     * @return self
     */
    public function addError($errorMessage) : ErrorsInterface
    {
        if (!empty($errorMessage)) {
            $errors = $this->getErrors();
            $errors[] = $errorMessage;
            $this->errors = $errors;
        }

        return $this;
    }

    /**
     * @return self
     */
    public function clearErrors() : ErrorsInterface
    {
        $this->errors = null;

        return $this;
    }
}
