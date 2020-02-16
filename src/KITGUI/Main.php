<?php

// Instead of giving the player the armor in their inventory, use getArmorInventory and set(ArmorPeice) to put the armor on the player.
// This may be an issue if the player wants extra armor in their vault.
// Try to add a function where people can see what items are in the kit.

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
		
		if($this->getDescription()->getAuthors()[0] !== "ethaniccc" or $this->getDescription()->getName() !== "KitGUI"){
			$this->getLogger()->info("§cSeriously? You thought you could just steal my plugin like that?");
			$this->getLogger()->info("§cThis is a KitGUI plugin made by ethaniccc, and not anybody else");
			$this->getLogger()->info("§cEthaniccc will now put your server in a reload loop until proper credits are given.");
			$this->getServer()->reload();

       } if(!InvMenuHandler::isRegistered()){
			InvMenuHandler::register($this);
		}
    }

    public function onCommand(CommandSender $s, Command $c, String $label, array $args) : bool {
	if($s instanceof Player) {
        switch($c->getName()){
            case "kits":
            $this->onSend($s);
            break;
        }
	} else {
		$this->getLogger()->info("§cPlease run this command as a player!");
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
                "§6$250: The Ninja way! Includes many things such as Shurikens!"
            ]
            );
		$item3 = Item::get(276,0,1);
        $item3->setLore(
            [
                "§6$250: It's the PvP kit, but better..."
            ]
            );
		$item4 = Item::get(373,25,1);
        $item4->setLore(
            [
                "§6$500: Become a Witch and use your spells againts others!"
            ]
            );
		$item5 = Item::get(311,0,1);
        $item5->setLore(
            [
                "§6$500: It's all about the defense!"
            ]
            );
            $item->setCustomName("§ePvP");
            $item1->setCustomName("§eArcher");
            $item2->setCustomName("§aNinja");
			$item3->setCustomName("§aPvP+");
			$item4->setCustomName("§2Witch");
			$item5->setCustomName("§2Tank");

            $inv = $menu->getInventory();
            $inv->setItem(0, $item);
            $inv->setItem(1, $item1);
            $inv->setItem(2, $item2);
			$inv->setItem(3, $item3);
			$inv->setItem(4, $item4);
			$inv->setItem(5, $item5);
            $menu->send($p);
			
    } 

    public function formenc(Player $p, Item $item){
        if($item->getId() == 267){
            $mymoney = $this->eco->myMoney($p);
            $pay = 0;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
				//the following is a test //ironsword id is 267
				
				//pvp sword
				$i3 = Item::get(267, 0, 1);
			    $i3->setCustomName("§aPvP Sword");
			    $ie3 = Enchantment::getEnchantment(9);
			    $i3->addEnchantment(new EnchantmentInstance($ie3, 1));
			    $p->getInventory()->addItem($i3);
				
				//pvp bow
				
				$i2 = Item::get(261, 0, 1);
			    $i2->setCustomName("§aPvP Bow");
			    $ie2 = Enchantment::getEnchantment(19);
			    $i2->addEnchantment(new EnchantmentInstance($ie2, 1));
			    $p->getInventory()->addItem($i2);
			   
				$p->getInventory()->addItem(Item::get(322, 0, 16)->setCustomName("§6Golden Apple"));
				$p->getInventory()->addItem(Item::get(306, 0, 1)->setCustomName("§a§lPvP Helmet"));
				$p->getInventory()->addItem(Item::get(307, 0, 1)->setCustomName("§a§lPvP Chestplate"));
				$p->getInventory()->addItem(Item::get(308, 0, 1)->setCustomName("§a§lPvP Leggings"));
				$p->getInventory()->addItem(Item::get(309, 0, 1)->setCustomName("§a§lPvP Boots"));
				//end of test
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the §6PvP §akit!");
				} else {
					$this->getLogger()->info("A player using the KitGUI plugin was not able to obtain a free kit.");
				}
				return true;
        } elseif($item->getId() == 261){
            $mymoney = $this->eco->myMoney($p);
            $pay = 0;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
				//start of test //stone sword id is 272
				
				//archer sword
				
				$i4 = Item::get(272, 0, 1);
			    $i4->setCustomName("§aArcher Knife");
			    $ie4 = Enchantment::getEnchantment(9);
			    $i4->addEnchantment(new EnchantmentInstance($ie4, 1));
			    $p->getInventory()->addItem($i4);
				
				//archer bow
				
				$i5 = Item::get(261, 0, 1);
			    $i5->setCustomName("§aPvP Bow");
			    $ie5 = Enchantment::getEnchantment(19);
			    $i5->addEnchantment(new EnchantmentInstance($ie5, 2));
			    $p->getInventory()->addItem($i5);
				
				$p->getInventory()->addItem(Item::get(322, 0, 16)->setCustomName("§6Golden Apple"));
				$p->getInventory()->addItem(Item::get(262, 0, 64)->setCustomName("§6Arrows"));
				$p->getInventory()->addItem(Item::get(262, 0, 64)->setCustomName("§6Arrows"));
				$p->getInventory()->addItem(Item::get(302, 0, 1)->setCustomName("§aArcher Helmet"));
				$p->getInventory()->addItem(Item::get(311, 0, 1)->setCustomName("§aArcher Chestplate"));
				$p->getInventory()->addItem(Item::get(304, 0, 1)->setCustomName("§aArcher Leggings"));
				$p->getInventory()->addItem(Item::get(305, 0, 1)->setCustomName("§6Archer Boots"));
				//end of test
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the §6Archer §akit!");
				} else {
					$this->getLogger()->info("A player using KitGUI was not able to obtain a free kit...");
				}
            return true;
        }elseif($item->getId() == 368){
            $mymoney = $this->eco->myMoney($p);
            $pay = 250;
            if($mymoney >= $pay){
               $this->eco->reduceMoney($p, $pay);
			   //start of test
			   $p->getInventory()->addItem(Item::get(267, 0, 1)->setCustomName("§aNinja Sword"));
			   $p->getInventory()->addItem(Item::get(441, 7, 1)->setCustomName("§6Camouflage"));
			   $p->getInventory()->addItem(Item::get(441, 7, 1)->setCustomName("§6Camouflage"));
			   $p->getInventory()->addItem(Item::get(368, 0, 16)->setCustomName("§6Ninja Pearls"));
			   $p->getInventory()->addItem(Item::get(332, 0, 16)->setCustomName("§6Ninja Shurikens"));
			   $p->getInventory()->addItem(Item::get(332, 0, 16)->setCustomName("§6Ninja Shurikens"));
			   $p->getInventory()->addItem(Item::get(306, 0, 1)->setCustomName("§aNinja Helmet"));
			   $p->getInventory()->addItem(Item::get(307, 0, 1)->setCustomName("§aNinja Chestplate"));
			   $p->getInventory()->addItem(Item::get(308, 0, 1)->setCustomName("§aNinja Leggings"));
			   $p->getInventory()->addItem(Item::get(309, 0, 1)->setCustomName("§aNinja Boots"));
			   //end of the test
			   $p->getLevel()->addSound(new AnvilUseSound($p));
			   $p->sendMessage("§aYou have successfuly obtained the §6Ninja §akit!");
			   } else {
			   	$p->sendMessage("§cYou do not have enough funds to buy the §6Ninja§c kit!");
			   }
            return true;
        } elseif($item->getId() == 276){
            $mymoney = $this->eco->myMoney($p);
            $pay = 0;
            if($mymoney >= $pay){
                $this->eco->reduceMoney($p, $pay);
				//the following is a test
				$p->getInventory()->addItem(Item::get(276, 0, 1)->setCustomName("§aPvP+ Sword"));
				$p->getInventory()->addItem(Item::get(322, 0, 24)->setCustomName("§6Golden Apple+"));
				$p->getInventory()->addItem(Item::get(306, 0, 1)->setCustomName("§a§lPvP+ Helmet"));
				$p->getInventory()->addItem(Item::get(311, 0, 1)->setCustomName("§a§lPvP+ Chestplate"));
				$p->getInventory()->addItem(Item::get(312, 0, 1)->setCustomName("§a§lPvP+ Leggings"));
				$p->getInventory()->addItem(Item::get(309, 0, 1)->setCustomName("§a§lPvP+ Boots"));
				//end of test
				$p->getLevel()->addSound(new AnvilUseSound($p));
				$p->sendMessage("§aYou have successfuly obtained the §6PvP+ §akit!");
				} else {
					$p->sendMessage("§cYou do not have the funds for the §6PvP+ §ckit!");
				}
				return true;
        } elseif($item->getId() == 373){
            $mymoney = $this->eco->myMoney($p);
            $pay = 500;
            if($mymoney >= $pay){
               $this->eco->reduceMoney($p, $pay);
			   //start of test
			   $p->getInventory()->addItem(Item::get(267, 0, 1)->setCustomName("§aWitch Blade"));
			   $p->getInventory()->addItem(Item::get(466, 0, 1)->setCustomName("§4Emergency Healing Spell"));
			   $p->getInventory()->addItem(Item::get(438, 29, 1)->setCustomName("§6Healing Spell"));
			   $p->getInventory()->addItem(Item::get(438, 29, 1)->setCustomName("§6Healing Spell"));
			   $p->getInventory()->addItem(Item::get(438, 29, 1)->setCustomName("§6Healing Spell"));
			   $p->getInventory()->addItem(Item::get(438, 29, 1)->setCustomName("§6Healing Spell"));
			   $p->getInventory()->addItem(Item::get(438, 25, 1)->setCustomName("§6Poison Spell"));
			   $p->getInventory()->addItem(Item::get(438, 25, 1)->setCustomName("§6Poison Spell"));
			   $p->getInventory()->addItem(Item::get(438, 25, 1)->setCustomName("§6Poison Spell"));
			   //end of the test
			   $p->getLevel()->addSound(new AnvilUseSound($p));
			   $p->sendMessage("§aYou have successfuly obtained the §6Witch §akit!");
			   } else {
			   	$p->sendMessage("§cYou do not have enough money to buy the §6Witch §ckit!");
			   }
            return true;
        } elseif($item->getId() == 311){
            $mymoney = $this->eco->myMoney($p);
            $pay = 500;
            if($mymoney >= $pay){
               $this->eco->reduceMoney($p, $pay);
			   //start of the test
			   
			   //$i = Item::get(267, 0, 1);
			   //$i->setCustomName("Test Blade");
			   //$e = Enchantment::getEnchantment(12);
			   //$i->addEnchantment(new EnchantmentInstance($e, 100));
			   //$p->getInventory()->addItem($i);
			   
			   //end of the test
			   
			   //NOTE: The enchantments can be as broken as the writer may want them to be.
			   
			   //This is the sword for the Tank kit. The variable for the sword is $i and the enchantment $ie
			   $i = Item::get(268, 0, 1);
			   $i->setCustomName("§aStick");
			   $ie = Enchantment::getEnchantment(17);
			   $i->addEnchantment(new EnchantmentInstance($ie, 1000));
			   $p->getInventory()->addItem($i);
			   
			   $p->getInventory()->addItem(Item::get(322, 0, 32)->setCustomName("§6Golden Apple"));
			   
			   //This is the bow for the Tank kit.
			   
			   $i1 = Item::get(261, 0, 1);
			   $i1->setCustomName("§aGun");
			   $ie1 = Enchantment::getEnchantment(19);
			   $i1->addEnchantment(new EnchantmentInstance($ie1, 2));
			   $p->getInventory()->addItem($i1);
			   
			   $p->getInventory()->addItem(Item::get(262, 0, 64)->setCustomName("§aBullet"));
			   $p->getInventory()->addItem(Item::get(262, 0, 64)->setCustomName("§aBullet"));
			   $p->getInventory()->addItem(Item::get(262, 0, 64)->setCustomName("§aBullet"));
			   $p->getInventory()->addItem(Item::get(262, 0, 64)->setCustomName("§aBullet"));
			   $p->getInventory()->addItem(Item::get(262, 0, 64)->setCustomName("§aBullet"));
			   $p->getArmorInventory()->setHelmet(Item::get(310, 0, 1)->setCustomName("§6Tank Helmet"));
			   $p->getArmorInventory()->setChestplate(Item::get(311, 0, 1)->setCustomName("§6Tank Chestplate"));
			   $p->getArmorInventory()->setLeggings(Item::get(312, 0, 1)->setCustomName("§6Tank Leggings"));
			   $p->getArmorInventory()->setBoots(Item::get(313, 0, 1)->setCustomName("§6Tank Boots")); 
			   $p->getLevel()->addSound(new AnvilUseSound($p));
			   $p->sendMessage("§aYou have successfuly obtained the §6Tank §akit!");
			   } else {
			   	$p->sendMessage("§cYou do not have enough money to buy the §6Tank §ckit!");
			   }
            return true;
        }
        
        
    }
    //start
}
    
    //end



