# Linux - Ubuntu Server Autologin

Run these commands, in this order, as a regular user (the user you'll be autologging as)

Note: You may be asked multiple times for your root password depending on your sudoers configuration.

---

```bash
_DIR=/etc/systemd/system/getty@tty1.service.d
_FIL=$_DIR/override.conf
sudo mkdir $_DIR
sudo touch $_FIL
echo "[Service]" | sudo tee -a $_FIL
echo "ExecStart=" | sudo tee -a $_FIL
echo "ExecStart=-/sbin/agetty --noissue --autologin $USER %I \$TERM" | sudo tee -a $_FIL
echo "Type=idle" | sudo tee -a $_FIL
```

Hopefully you don't break your system ;)
