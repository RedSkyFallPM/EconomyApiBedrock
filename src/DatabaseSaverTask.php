<?php

declare(strict_types=1);

namespace RedSkyFallPM\EconomyApiBedrock;

use pocketmine\scheduler\Task;

class DatabaseSaverTask extends Task
{
    public function __construct(private Loader $loader) {}

    public function onRun(): void
    {
        $this->loader->db->save();
        $this->loader->getServer()->getLogger()->notice('Database saved successfully.');
    }
}