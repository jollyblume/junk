<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Model\LeagueInterface;
use App\Document\Traits\PhpcrTeamStoreTrait;
use App\Document\Traits\PhpcrPlayerStoreTrait;
use App\Document\Traits\PhpcrLeagueStoreTrait;
use App\Document\Traits\PhpcrCalendarStoreTrait;
use App\Document\Traits\PhpcrTournamentStoreTrait;

/**
 * @PHPCR\Document()
 */
class LeagueNode extends AbstractNode implements LeagueInterface {
    use PhpcrCalendarStoreTrait, PhpcrLeagueStoreTrait, PhpcrPlayerStoreTrait, PhpcrTeamStoreTrait, PhpcrTournamentStoreTrait;
}
