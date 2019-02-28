<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\TournamentInterface;
use App\Document\Traits\PhpcrMatchStoreTrait;

/**
 * @PHPCR\Document()
 */
class TournamentNode extends AbstractNode implements TournamentInterface {
    use PhpcrMatchStoreTrait;
}
