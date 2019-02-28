<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\MatchInterface;

/**
 * @PHPCR\Document()
 */
class MatchNode extends AbstractNode implements MatchInterface {
}
