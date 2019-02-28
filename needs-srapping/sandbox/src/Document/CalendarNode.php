<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\CalendarInterface;

/**
 * @PHPCR\Document()
 */
class CalendarNode extends AbstractNode implements CalendarInterface {
}
