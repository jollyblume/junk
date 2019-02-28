<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\PlayerInterface;
use App\Document\Traits\PhpcrTournamentStoreTrait;

/**
 * @PHPCR\Document()
 */
class PlayerNode extends AbstractNode implements PlayerInterface {
    use PhpcrTournamentStoreTrait;
}
