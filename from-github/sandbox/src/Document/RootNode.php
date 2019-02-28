<?php

namespace App\Document;
use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCR;
use App\Document\Traits\AbstractParentNode;
use App\Document\Traits\PhpcrCalendarStoreTrait;
use App\Document\Traits\PhpcrEmailStoreTrait;
use App\Document\Traits\PhpcrLeagueStoreTrait;
use App\Document\Traits\PhpcrLocationStoreTrait;
use App\Document\Traits\PhpcrPlayerStoreTrait;
use App\Document\Traits\PhpcrTeamStoreTrait;
use App\Document\Traits\PhpcrTournamentStoreTrait;
use App\Model\RootNodeInterface;

/**
 * @PHPCR\Document(childClasses={
 *      "App\Document\CalendarBag",
 *      "App\Document\EmailBag",
 *      "App\Document\LeagueBag",
 *      "App\Document\LocationBag",
 *      "App\Document\PlayerBag",
 *      "App\Document\TeamBag",
 *      "App\Document\TournamentBag",
 * });
 */
class RootNode extends AbstractNode implements RootNodeInterface  {
    use PhpcrCalendarStoreTrait, PhpcrEmailStoreTrait, PhpcrLeagueStoreTrait, PhpcrLocationStoreTrait, PhpcrPlayerStoreTrait, PhpcrTeamStoreTrait, PhpcrTournamentStoreTrait;
}
