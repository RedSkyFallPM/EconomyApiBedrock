<?php

declare(strict_types=1);

namespace RedSkyFallPM\EconomyApiBedrock;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class CommandMoney extends Command
{
    public function __construct(private Loader $loader)
    {
        parent::__construct('money', 'Manage your money', null, []);
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$sender instanceof Player) {
            $sender->sendMessage("Use this command in game.");
            return;
        }

        switch ($args[0]) {
            case 'add':
                if (isset($args[1])) {
                    $this->loader->addMoney($sender, (int)$args[1]);
                    $sender->sendMessage("Meghdar pool $$args[1] be account shoma variz shod");
                } else {
                    $sender->sendMessage('Meghdar pool peyda nashod');
                }
                break;
            case 'reduce':
                if (isset($args[1])) {
                    $this->loader->reduceMoney($sender, (int)$args[1]);
                    $sender->sendMessage("Meghdar pool $$args[1] az account shoma kam shod");
                } else {
                    $sender->sendMessage('Meghdar pool peyda nashod');
                }
                break;
            case 'see':
                $sender->sendMessage("Your money: " . $this->loader->getMoney($sender));
                break;
        }
    }
}