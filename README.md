# KitGUI
This is a KitGUI (chest interface) plugin for Pocketmine-MP
## Important
Before installing this plugin on your server, please keep this in mind.

`- This plugin is incomplete. Everytime you try to take a Kit from the plugin it will come back with internal server error.`

`- The reasons I uploaded this was for someone smarter (then 13 year-old me) to help me fix this and make this into something functional.`
## Setting Up The Plugin
There is no config.yml right now as I don't know how to do that. This is why contribtuions are highly wanted (and highly appreciated as well).
To set up the plugin, you must have it in folder form. You will also need DevTools for this.
You may download DevTools from [here.](https://poggit.pmmp.io/p/DevTools)

## Additonal Dependencies
Before I got into something truly advanced, I made this plugin, I made it depend on [EasyKits.](https://poggit.pmmp.io/p/EasyKits)

How would this work then? Well, it was supposed to work like this:

Every time you click on the selected item, it would run this in console:

`givekit (the player) (kit)`

This is how I'm doing it right now, I'm not sure if I'm doing something wrong, so yeah.

`$this->getServer()->dispatchCommand($item->getPlayer(), "givekit " . $p . " pvp");`

$p stands for the player, and pvp was the kit I orignally created on EasyKits.

###### Help please, I know I'm an idiot <3
