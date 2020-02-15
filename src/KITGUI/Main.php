<?php

namespace KITGUI;

use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\Terminal;
use pocketmine\command\FormattedCommandAlias;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\Item;
use pocketmine\item\Armor;
use pocketmine\item\Tool;
use pocketmine\math\Vector3;
use pocketmine\level\sound\AnvilUseSound;

use muqsit\invmenu\{InvMenu, InvMenuHandler};

class Main extends PluginBase implements Listener {

    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->eco = $this->getServer()->getPluginManager()->getPlugin("EconomyAPI");

        if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
    }

    public function onCommand(CommandSender $s, Command $c, String $label, array $args) : bool {
        switch($c->getName()){
            case "kits":
            $this->onSend($s);
            break;
        }
        return true;
    }

    public function onSend(Player $p){
        $menu = new InvMenu(InvMenu::TYPE_CHEST);
        $menu->readonly();
        $menu->setListener([$this, "formenc"]);
        $menu->setName("Kits");

        $item = Item::get(267,0,1);
        $item->setLore(
            [
                "§6The most basic kit in KitPvP mode!"
            ]
            );
        $item1 = Item::get(261,0,1);
        $item1->setLore(
            [
                "§6The archer kit is a kit for people who prefer good bows than good swords!"
            ]
            );
        $item2 = Item::get(368,0,1);
        $item2->setLore(
            [
                "§6For $250, The Ninja kit includes many weapons and things a prepared person might need....."
            ]
            );
            $item->setCustomName("§ePvP");
            $item1->setCustomName("§eArcher");
            $item2->setCustomName("§aNinja");

            $inv = $menu->getInventory();
            $inv->setItem(0, $item);
            $inv->setItem(1, $item1);
            $inv->setItem(2, $item2);
            $menu->send($p);
    }

    public function formenc(Player $p, Item $item){
        if($item->getId() == 267){
            $mymoney = $this->eco->myMoney($p);
            $pay = 25;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " iron_sword");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " golden_apple" . " 16");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 306");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 307");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 308");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 309");
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the §6PvP §akit!");
        }elseif($item->getId() == 261){
            $mymoney = $this->eco->myMoney($p);
            $pay = 25;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " stone_sword");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " bow");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " golden_apple" . " 16");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " arrow" . " 128");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 302");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 311");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 304");
             	$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " 305");
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the §6Archer §akit!");
            return true;
        }elseif($item->getId() == 368){
            $mymoney = $this->eco->myMoney($p);
            $pay = 250;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
               $this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " iron_sword");
               $this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " ender_pearl" . " 4");
               $this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " snowball" . " 64");
               $this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " iron_helmet");
               $this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " iron_chestplate");
               $this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " iron_leggings");
               $this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " iron_boots");
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the §6Ninja §akit!");
            return true;
        }
        
        
    }
    //start
        }
    }
    //end
}