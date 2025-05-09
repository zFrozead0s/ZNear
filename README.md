# 🌟 ZNear Plugin

A sleek and efficient PocketMine-MP plugin to check nearby players with cooldown and customizable radius.  
**Created by [zFrozead0s](https://github.com/zFrozead0s)**  

![PocketMine-MP](https://img.shields.io/badge/PocketMine%20MP-5.x-blue?style=flat-square)
![License](https://img.shields.io/badge/License-MIT-green?style=flat-square)

---

## ✨ Features
- 🕒 **30-second cooldown** to prevent command spam.
- 📏 **Configurable radius** (default: `80` blocks).
- 🌍 **Multi-world support** (checks players in the same world).
- 🛠️ **Fully customizable messages** in `config.yml`.
- ✅ **Permission system** (`znear.command`).

---

## 📥 Installation
1. Download the latest `ZNear.phar` from [Releases](https://github.com/zFrozead0s/ZNear/releases).
2. Place the `.phar` file into your server's `plugins` folder.
3. Restart the server.

---

## ⚙️ Configuration (`plugins/ZNear/config.yml`)
```yaml
cooldown: 30
radius: 80

cooldown_message: "§cYou must wait §e{time} seconds §cto use /near."
no_players: "§cNo players nearby (§e{radius}m§c)."
players_near: "§aPlayers nearby: §e{count} §7(radius: §e{radius}m§7)"
