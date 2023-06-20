# Linux - Set Block Cursor in TTY

To make the shell cursor a block in the tty screen we do the following steps:

1. Use `sudo nano /boot/grub/grub.cfg`
2. Find a `menuentry` containing a line starting with `linux` and append `vt.cur_default=6 vt.color=7`
3. Run `update-initramfs -u`
4. Reboot

This will force a dim white, blinking block cursor in the tty session.

![](~/0.png)
