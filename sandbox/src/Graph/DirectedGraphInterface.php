<?php

namespace App\Graph;

use App\Model\LeagueInterface;
use App\Model\TeamInterface;
use App\Model\PlayerInterface;
use App\Model\TournamentInterface;

interface DirectedGraphInterface
{
    // brainstorming
    public function getRootNode();

    public function getCalendarSingleton();

    public function getEmailSingleton();

    public function getLocationSingleton();

    /**
     * Get the entry node (earliet parent node).
     *
     * May be a RootNode
     *
     * There needs to be a persisted graph. A graph becomes connected when added
     * to the persistent graph.
     *
     * Disconnected nodes withing a graph are never persisted.
     *
     * Every graph has a node (vertex) collection and arc (edge) collection.
     */
    public function getEntryNode();

    public function addLeagueNode(LeagueInterface $node);

    public function addPlayerNode(PlayerInterface $node);

    public function addTeamNode(TeamInterface $node);

    public function addTournementNode(TournamentInterface $node);

    // not matchinterface: it is part of the TournamentInterface Document.

    // /**
    //  * don't think i need this.
    //  *
    //  * - i could auto-persist the rootnode, which will catch
    //  *   anything that changed. auto-persist may be a performance killer as the
    //  *   graph grows and ignores UnitOfWork awesomeness.
    //  * - i could use observer pattern. have nodes notify once on the first
    //  *   change. graph can observe and persist Nodes that change. would need a
    //  *   onChangesFlushed() that the graph calls at flush, allowing the notifier
    //  *   to clear its changeList.
    //  *   - need ChangeAwareInterface
    //  */
    // public function persistNode();
    //
    // public function flushGraph();
}
