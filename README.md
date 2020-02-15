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
None needed right now. The way the players will get the items are through a command being run in the console by this:

`$this->getServer()->dispatchCommand($item->getPlayer(), "give " . $p . " iron_sword");`

The line itself is pretty self-explanitory. The plugin gets the server and runs a command through it. $item is defined in the plugin. $p stands for the player in this case. So the command run in the console will be give (player) (the items that are put in the particular kit)

###### Help please, I know I'm an idiot <3
