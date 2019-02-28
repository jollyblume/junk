<?php

namespace App\Tests\Document;

use PHPUnit\Framework\TestCase;
use App\Document\RootNode;
use App\Document\TeamNode;
use App\Document\TeamBag;
use App\Document\EmailBag;
use App\Document\PlayerNode;
use App\Document\EmailNode;
use App\Document\LeagueBag;
use App\Document\PlayerBag;
use App\Document\LeagueNode;
use App\Document\CalendarBag;
use App\Document\LocationBag;
use App\Document\LocationNode;
use App\Document\CalendarNode;
use App\Document\TournamentBag;
use App\Document\TournamentNode;
use App\Document\AbstractParentNode;

/**
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RootNodeTest extends TestCase {
    public function testSetCalendarBagSetsBag() {
        $node = new RootNode();
        $bag = $this->createMock(CalendarBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setCalendarNodes($bag);
        $this->assertEquals($bag, $node->getCalendarNodes());
    }

    public function testAddCalendarNode() {
        $node = new RootNode();
        $bag = $this->createMock(CalendarNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addCalendarNode($bag);
        $this->assertEquals($bag, $node->getCalendarNode('testbag'));
    }

    public function testRemoveCalendarNode() {
        $node = new RootNode();
        $bag = $this->createMock(CalendarNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addCalendarNode($bag);
        $node->removeCalendarNode($bag);
        $this->assertFalse($node->hasCalendarNode($bag));
    }

    public function testRemoveCalendarName() {
        $node = new RootNode();
        $bag = $this->createMock(CalendarNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addCalendarNode($bag);
        $node->removeCalendarName('testbag');
        $this->assertFalse($node->hasCalendarName('testbag'));
    }

    public function testSetCalendarNode() {
        $node = new RootNode();
        $bag = $this->createMock(CalendarNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setCalendarNode('testbag', $bag);
        $this->assertTrue($node->hasCalendarNode($bag));
    }

    public function testSetEmailBagSetsBag() {
        $node = new RootNode();
        $bag = $this->createMock(EmailBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setEmailNodes($bag);
        $this->assertEquals($bag, $node->getEmailNodes());
    }

    public function testAddEmailNode() {
        $node = new RootNode();
        $bag = $this->createMock(EmailNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addEmailNode($bag);
        $this->assertEquals($bag, $node->getEmailNode('testbag'));
    }

    public function testRemoveEmailNode() {
        $node = new RootNode();
        $bag = $this->createMock(EmailNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addEmailNode($bag);
        $node->removeEmailNode($bag);
        $this->assertFalse($node->hasEmailNode($bag));
    }

    public function testRemoveEmailName() {
        $node = new RootNode();
        $bag = $this->createMock(EmailNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addEmailNode($bag);
        $node->removeEmailName('testbag');
        $this->assertFalse($node->hasEmailName('testbag'));
    }

    public function testSetEmailNode() {
        $node = new RootNode();
        $bag = $this->createMock(EmailNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setEmailNode('testbag', $bag);
        $this->assertTrue($node->hasEmailNode($bag));
    }

    public function testSetLeagueBagSetsBag() {
        $node = new RootNode();
        $bag = $this->createMock(LeagueBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setLeagueNodes($bag);
        $this->assertEquals($bag, $node->getLeagueNodes());
    }

    public function testAddLeagueNode() {
        $node = new RootNode();
        $bag = $this->createMock(LeagueNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addLeagueNode($bag);
        $this->assertEquals($bag, $node->getLeagueNode('testbag'));
    }

    public function testRemoveLeagueNode() {
        $node = new RootNode();
        $bag = $this->createMock(LeagueNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addLeagueNode($bag);
        $node->removeLeagueNode($bag);
        $this->assertFalse($node->hasLeagueNode($bag));
    }

    public function testRemoveLeagueName() {
        $node = new RootNode();
        $bag = $this->createMock(LeagueNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addLeagueNode($bag);
        $node->removeLeagueName('testbag');
        $this->assertFalse($node->hasLeagueName('testbag'));
    }

    public function testSetLeagueNode() {
        $node = new RootNode();
        $bag = $this->createMock(LeagueNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setLeagueNode('testbag', $bag);
        $this->assertTrue($node->hasLeagueNode($bag));
    }

    public function testSetLocationBagSetsBag() {
        $node = new RootNode();
        $bag = $this->createMock(LocationBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setLocationNodes($bag);
        $this->assertEquals($bag, $node->getLocationNodes());
    }

    public function testAddLocationNode() {
        $node = new RootNode();
        $bag = $this->createMock(LocationNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addLocationNode($bag);
        $this->assertEquals($bag, $node->getLocationNode('testbag'));
    }

    public function testRemoveLocationNode() {
        $node = new RootNode();
        $bag = $this->createMock(LocationNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addLocationNode($bag);
        $node->removeLocationNode($bag);
        $this->assertFalse($node->hasLocationNode($bag));
    }

    public function testRemoveLocationName() {
        $node = new RootNode();
        $bag = $this->createMock(LocationNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addLocationNode($bag);
        $node->removeLocationName('testbag');
        $this->assertFalse($node->hasLocationName('testbag'));
    }

    public function testSetLocationNode() {
        $node = new RootNode();
        $bag = $this->createMock(LocationNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setLocationNode('testbag', $bag);
        $this->assertTrue($node->hasLocationNode($bag));
    }

    public function testSetPlayerBagSetsBag() {
        $node = new RootNode();
        $bag = $this->createMock(PlayerBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setPlayerNodes($bag);
        $this->assertEquals($bag, $node->getPlayerNodes());
    }

    public function testAddPlayerNode() {
        $node = new RootNode();
        $bag = $this->createMock(PlayerNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addPlayerNode($bag);
        $this->assertEquals($bag, $node->getPlayerNode('testbag'));
    }

    public function testRemovePlayerNode() {
        $node = new RootNode();
        $bag = $this->createMock(PlayerNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addPlayerNode($bag);
        $node->removePlayerNode($bag);
        $this->assertFalse($node->hasPlayerNode($bag));
    }

    public function testRemovePlayerName() {
        $node = new RootNode();
        $bag = $this->createMock(PlayerNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addPlayerNode($bag);
        $node->removePlayerName('testbag');
        $this->assertFalse($node->hasPlayerName('testbag'));
    }

    public function testSetPlayerNode() {
        $node = new RootNode();
        $bag = $this->createMock(PlayerNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setPlayerNode('testbag', $bag);
        $this->assertTrue($node->hasPlayerNode($bag));
    }

    public function testSetTeamBagSetsBag() {
        $node = new RootNode();
        $bag = $this->createMock(TeamBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setTeamNodes($bag);
        $this->assertEquals($bag, $node->getTeamNodes());
    }

    public function testAddTeamNode() {
        $node = new RootNode();
        $bag = $this->createMock(TeamNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addTeamNode($bag);
        $this->assertEquals($bag, $node->getTeamNode('testbag'));
    }

    public function testRemoveTeamNode() {
        $node = new RootNode();
        $bag = $this->createMock(TeamNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addTeamNode($bag);
        $node->removeTeamNode($bag);
        $this->assertFalse($node->hasTeamNode($bag));
    }

    public function testRemoveTeamName() {
        $node = new RootNode();
        $bag = $this->createMock(TeamNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addTeamNode($bag);
        $node->removeTeamName('testbag');
        $this->assertFalse($node->hasTeamName('testbag'));
    }

    public function testSetTeamNode() {
        $node = new RootNode();
        $bag = $this->createMock(TeamNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setTeamNode('testbag', $bag);
        $this->assertTrue($node->hasTeamNode($bag));
    }

    public function testSetTournamentBagSetsBag() {
        $node = new RootNode();
        $bag = $this->createMock(TournamentBag::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setTournamentNodes($bag);
        $this->assertEquals($bag, $node->getTournamentNodes());
    }

    public function testAddTournamentNode() {
        $node = new RootNode();
        $bag = $this->createMock(TournamentNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addTournamentNode($bag);
        $this->assertEquals($bag, $node->getTournamentNode('testbag'));
    }

    public function testRemoveTournamentNode() {
        $node = new RootNode();
        $bag = $this->createMock(TournamentNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addTournamentNode($bag);
        $node->removeTournamentNode($bag);
        $this->assertFalse($node->hasTournamentNode($bag));
    }

    public function testRemoveTournamentName() {
        $node = new RootNode();
        $bag = $this->createMock(TournamentNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->addTournamentNode($bag);
        $node->removeTournamentName('testbag');
        $this->assertFalse($node->hasTournamentName('testbag'));
    }

    public function testSetTournamentNode() {
        $node = new RootNode();
        $bag = $this->createMock(TournamentNode::class);
        $bag->method('getNodename')->willReturn('testbag');
        $node->setTournamentNode('testbag', $bag);
        $this->assertTrue($node->hasTournamentNode($bag));
    }
}
