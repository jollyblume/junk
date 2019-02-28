<?php

namespace Jollyblume\Bundle\GraphBundle\Validation;

use Jollyblume\Bundle\GraphBundle\Collection\TargetCollectionInterface;
use Jollyblume\Bundle\GraphBundle\Validation\ErrorsInterface;

/**
 * ValidityChainTrait
 *
 * ValidityChainTrait implements ValidityChainInterface for TargetCollectionInterfaces
 */
trait ValidityChainTrait
{
    /**
     * @return bool
     */
    public function isChainValid() : bool
    {
        $validityChain = $this->getCollectableTargets();
        foreach ($validityChain as $visitor) {
            if (!$visitor instanceof ErrorsInterface) {
                // Ignore visitor's with no ErrorsInterface
                continue;
            }

            if (true !== $visitor->isValid()) {
                // Stop processing at first visitorFailure
                return false;
            }
        }

        // validityChain is valid when all it's links are valid
        return true;
    }
}
