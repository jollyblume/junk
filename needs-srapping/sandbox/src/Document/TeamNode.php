<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\TeamInterface;
use App\Document\Traits\PhpcrTournamentStoreTrait;

/**
 * @PHPCR\Document()
 */
class TeamNode extends AbstractNode implements TeamInterface {
    use PhpcrTournamentStoreTrait;
}
