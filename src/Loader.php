<?php

declare(strict_types=1);

namespace RedSkyFallPM\EconomyApiBedrock;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Loader extends PluginBase
{
    public Config $db;

    protected function onEnable(): void
    {
        $this->db = new Config($this->getDataFolder() . 'Database.json', Config::JSON);
        $this->getServer()->getPluginManager()->registerEvents(new EventsHandler($this), $this);
        $this->getScheduler()->scheduleRepeatingTask(new DatabaseSaverTask($this), 2 * 60 * 20);
        $this->getServer()->getCommandMap()->register('money', new CommandMoney($this));
    }

    public function getMoney(Player $player): ?int
    {
        return $this->db->getNested(strtolower($player->getName()));
    }

    public function addMoney(Player $player, int $amount, bool $save = false): void
    {
        $this->db->setNested(strtolower($player->getName()), $this->getMoney($player) + $amount);
        if ($save) {
            $this->db->save();
        }
    }

    public function reduceMoney(Player $player, int $amount, bool $save = false): void
    {
        $this->db->setNested(strtolower($player->getName()), $this->getMoney($player) - $amount);
        if ($save) {
            $this->db->save();
        }
    }
}
