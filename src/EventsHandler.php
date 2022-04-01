<?php

declare(strict_types=1);

namespace RedSkyFallPM\EconomyApiBedrock;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;

class EventsHandler implements Listener
{
    public function __construct(private Loader $loader) {}

    public function onPlayerJoinEvent(PlayerJoinEvent $event)
    {
        $player = $event->getPlayer();
        if (!$this->loader->db->exists($player->getName(), true)) {
            $this->loader->db->setNested(strtolower($player->getName()), 0);
        }
    }
}