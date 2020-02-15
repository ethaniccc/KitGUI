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
        $item2 = Item::get(278,0,1);
        $item2->setLore(
            [
                "§6Price§f: §b5000$"
            ]
            );
            $item->setCustomName("§ePvP");
            $item1->setCustomName("§eArcher");
            $item2->setCustomName("§aTools");

            $inv = $menu->getInventory();
            $inv->setItem(0, $item);
            $inv->setItem(1, $item1);
            $inv->setItem(2, $item2);
            $menu->send($p);
    }

    public function formenc(Player $p, Item $item){
        if($item->getId() == 267){
            $mymoney = $this->eco->myMoney($p);
            $pay = 0;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
				//del was before $event
             	$this->getServer()->dispatchCommand($item->getPlayer(), "givekit " . $p . "pvp");
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the PvP kit!");
            return true;
        }elseif($item->getId() == 261){
            $mymoney = $this->eco->myMoney($p);
            $pay = 0;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
                $this->eco->reduceMoney($p, $pay);
             	$this->getServer()->dispatchCommand($item->getPlayer(), "givekit " . $p . "archer");
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the Archer kit!");
            return true;
        }elseif($item->getId() == 278){
            $mymoney = $this->eco->myMoney($p);
            $pay = 5000;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
                $item = $p->getInventory()->getItemInHand();
                if($item instanceof Armor or $item instanceof Tool){
                    $id = $item->getId();
                    $meta = $item->getDamage();
                    $p->getInventory()->removeItem(Item::get($id, $meta, 1));
                    $new = Item::get($id, $meta, 1);
                    $enc = Enchantment::getEnchantment(mt_rand(15, 18));
                    $lvl = (mt_rand(1, 5));
                    $new->addEnchantment(new EnchantmentInstance($enc, (int) $lvl));
                    if($item->hasCustomName()){
                        $new->setCustomName($item->getCustomName());
                    }
                    if($item->hasEnchantments()){
                        foreach($item->getEnchantments() as $enchant){
                            $new->addEnchantment($enchant);
                        }
                    }
                    $p->getInventory()->addItem($new);
                    $p->getLevel()->addSound(new AnvilUseSound($p));
                    $p->sendMessage("§aSuccess");
                }else{
                    $p->sendMessage("§cCannot enchantment this item.");
                }
            }else{
                $p->sendMessage("§cNot enough money");
            }
            return true;
        }
        
        
    }
    //start
        }
    }
    //end
}