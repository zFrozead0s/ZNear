<?php

namespace ZNear\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use ZNear\Main;

class NearCommand extends Command {

    private $plugin;

    public function __construct(Main $plugin) {
        parent::__construct("near", "Shows players nearby you.");
        $this->setPermission("znear.command");
        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool {
        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::RED . "Only players can use the command.");
            return false;
        }

        if (!empty($args)) {
            $sender->sendMessage(TextFormat::RED . "Usage: §e/near§c");
            return false;
        }

        $playerName = $sender->getName();
        $config = $this->plugin->getConfig();

        if ($this->plugin->hasCooldown($playerName)) {
            $remaining = $this->plugin->getRemainingCooldown($playerName);
            $sender->sendMessage(str_replace("{time}", $remaining, $config->get("cooldown_message", "§cWaut §e{time}s §c.")));
            return false;
        }

        $radius = $this->plugin->getRadius();
        $count = 0;

        foreach ($sender->getWorld()->getPlayers() as $player) {
            if ($player === $sender) continue;
            $distance = $sender->getPosition()->distance($player->getPosition());
            if ($distance <= $radius) {
                $count++;
            }
        }

        $message = ($count === 0)
            ? str_replace("{radius}", $radius, $config->get("no_players", "§cThere isn't any players. (§e{radius}m§c)."))
            : str_replace(["{count}", "{radius}"], [$count, $radius], $config->get("players_near", "§aPlayers near: §e{count} §7(radius: §e{radius}m§7)"));

        $sender->sendMessage($message);
        $this->plugin->setCooldown($playerName);
        return true;
    }
}