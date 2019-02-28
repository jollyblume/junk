<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\LocationInterface;
use App\Document\Traits\PhpcrTeamStoreTrait;
use App\Document\Traits\PhpcrPlayerStoreTrait;
use App\Document\Traits\PhpcrLeagueStoreTrait;
use App\Document\Traits\PhpcrCalendarStoreTrait;
use App\Document\Traits\PhpcrLocationStoreTrait;
use App\Document\Traits\PhpcrTournamentStoreTrait;

/**
 * @PHPCR\Document()
 */
class LocationNode extends AbstractNode implements LocationInterface {
    use PhpcrCalendarStoreTrait, PhpcrLeagueStoreTrait, PhpcrLocationStoreTrait, PhpcrPlayerStoreTrait, PhpcrTeamStoreTrait, PhpcrTournamentStoreTrait;
}
