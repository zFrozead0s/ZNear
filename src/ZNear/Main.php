<?php

namespace ZNear;

use pocketmine\plugin\PluginBase;
use ZNear\commands\NearCommand;

class Main extends PluginBase {

    private $cooldowns = [];
    private $config;

    public function onEnable(): void {
        $this->saveResource("config.yml");
        $this->config = $this->getConfig();
        $this->getServer()->getCommandMap()->register("znear", new NearCommand($this));
    }

    public function getCooldownTime(): int {
        return $this->config->get("cooldown", 30);
    }

    public function setCooldown(string $playerName): void {
        $this->cooldowns[$playerName] = time();
    }

    public function hasCooldown(string $playerName): bool {
        return isset($this->cooldowns[$playerName]) && (time() - $this->cooldowns[$playerName] < $this->getCooldownTime());
    }

    public function getRemainingCooldown(string $playerName): int {
        return $this->getCooldownTime() - (time() - $this->cooldowns[$playerName]);
    }

    public function getRadius(): int {
        return $this->config->get("radius", 80);
    }
}