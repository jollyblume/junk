<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\EmailInterface;
/**
 * EmailNode
 *
 * Represents a single email address
 *
 * @PHPCR\Document()
 */
class EmailNode extends AbstractNode implements EmailInterface {
}
