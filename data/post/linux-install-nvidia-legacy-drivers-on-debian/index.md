# Linux - Install NVIDIA Legacy Drivers on Debian

I have a device that's using an older NVIDIA graphics card that requires
legacy drivers on Linux.

On Debian 12 I don't have access to these out of the box, but this post will
walk us through the steps in order to install these drivers.

## Source

Most of the steps here were helped by the
[Debian Wiki](https://wiki.debian.org/NvidiaGraphicsDrivers).

## 1. Blocking nouveau

Before installing properietary NVIDIA drivers we must block the open-source
NVIDIA driver [nouveau](https://en.wikipedia.org/wiki/Nouveau_(software%29).

Open a root shell and navigate to `/etc/modprobe.d/` and verify there are no
conflicting files regarding NVIDIA drivers.

If there are any make sure to read through them, if there are comments
saying to not remove them then you have to figure out what package created
that file and remove it.

Once you've made sure there are no conflicting files, create a file named
`blacklist-nouveau.conf` and write the following contents into it:

```
blacklist nouveau
```

After saving proceed to run `update-initramfs -u` and reboot.  Upon booting up
you may notice your screen resolution change or the GPU fans spin faster and
louder than usual - this is normal and means you have successfully disabled
the [nouveau](https://en.wikipedia.org/wiki/Nouveau_(software%29) driver.

## 2. Editing APT sources.list

The default Debian installation does not include adequate sources in its
`/etc/apt/sources.list` file required for getting the legacy drivers and thus
we're gonna create our own file `/etc/apt/sources.list.d/nvidia-legacy.list`
in which we'll put the required definition:

```
deb http://ftp.at.debian.org/debian/ sid main contrib non-free non-free-firmware
```

Keep in mind that this definition is only meant to be active temporarily until
we install the legacy drivers, upon which we'll comment out that line to
prevent APT from installing unintended packages during upgrades.

In the terminal run `apt update` which will fetch the list of packages
available on the `sid` source which contains the legacy drivers.

If you're from US you may want to use `ftp.debian.org` instead of
`ftp.at.debian.org`

See more mirrors [here](https://www.debian.org/mirror/list#per-country).

## 3. Installing the driver

We can't just go ahead and install any driver, before doing that you wanna do
some research regarding your hardware, for me it's pretty simple by running
`lspci | grep -i vga` and it tells me:

```
01:00.0 VGA compatible controller: NVIDIA Corporation GF108M [GeForce GT 540M] (rev a1)
```

By searching the latest driver on the
[NVIDIA Drivers page](https://www.nvidia.com/download/index.aspx)
I concluded that the driver I need is `390xx`.

    If `lspci` does not work install it with `apt install pciutils -y`.

To list all the available legacy drivers, use this one-liner:

```
apt search nvidia 2>/dev/null | grep -iv "^ " | sort | uniq | awk -F '/' '{print $1}' | grep -iE "driver$"
```

Which should give you an output similar to this:

```
nvidia-driver
nvidia-legacy-340xx-driver
nvidia-legacy-340xx-vdpau-driver
nvidia-legacy-390xx-driver
nvidia-legacy-390xx-vdpau-driver
nvidia-tesla-418-driver
nvidia-tesla-418-vdpau-driver
...
```

So because I want to install the `390xx` driver, I'll run this:

```
DRIVER=390xx

sudo apt install\
    mesa-utils\
    freeglut3-dev\
    nvidia-legacy-$DRIVER-driver\
    nvidia-settings-legacy-$DRIVER\
    xserver-xorg-video-nvidia-legacy-$DRIVER\
    nvidia-legacy-$DRIVER-smi\
    nvidia-legacy-$DRIVER-vulkan-icd\
    nvidia-legacy-$DRIVER-opencl-icd\
    nvidia-xconfig\
    -y
```

This will install all required packages for the legacy driver.

Once installed and configured, reboot the system.

## 4. Verification

Once booted, run `nvidia-smi` in the terminal and you should see an output similar to this:

```
+-----------------------------------------------------------------------------+
| NVIDIA-SMI 390.157                Driver Version: 390.157                   |
|-------------------------------+----------------------+----------------------+
| GPU  Name        Persistence-M| Bus-Id        Disp.A | Volatile Uncorr. ECC |
| Fan  Temp  Perf  Pwr:Usage/Cap|         Memory-Usage | GPU-Util  Compute M. |
|===============================+======================+======================|
|   0  GeForce GT 540M     Off  | 00000000:01:00.0 N/A |                  N/A |
| N/A   53C    P0    N/A /  N/A |      0MiB /   964MiB |     N/A      Default |
+-------------------------------+----------------------+----------------------+
                                                                               
+-----------------------------------------------------------------------------+
| Processes:                                                       GPU Memory |
|  GPU       PID   Type   Process name                             Usage      |
|=============================================================================|
|    0                    Not Supported                                       |
+-----------------------------------------------------------------------------+
```

This means the NVIDIA driver has recognized the device and is working.

## 5. Cleaning up

Now we must go back to the `/etc/apt/sources.list/nvidia-legacy.list` and change the
line starting with `deb` to `#deb` which will turn it into a comment and thus APT
will ignore it.

Run `sudo apt clean && sudo apt update` and this should get rid of unintended
packages from the APT package list.
