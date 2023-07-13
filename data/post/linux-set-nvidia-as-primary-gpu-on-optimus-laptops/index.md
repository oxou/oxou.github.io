# Linux - Set NVIDIA As Primary GPU On Optimus Laptops

## Introduction

I have a laptop that has 2 GPUs:

- Intel HD 3000
- NVIDIA GeForce GT 540M

Trying to use VMware Player with accelerated graphics will not work with
Intel HD 3000, as modern versions require newer graphics APIs in order
to provide accelerated graphics in the virtual machine.

Before going through this post, I only used this tweak on proprietary drivers.

I cannot confirm this will work for open-source drivers, this tweak should
also work for AMD too.

## Prerequisites

- unzip
- wget
- python3

Install by running:

```
sudo apt update && sudo apt install unzip wget python3 -y
```

## Installation

Run the following commands:

```
sudo su
cd /tmp
wget https://github.com/bayasdev/envycontrol/archive/refs/heads/main.zip -O envycontrol.zip
unzip envycontrol.zip
mv envycontrol-main/envycontrol.py /usr/local/bin/envycontrol
chmod +x /usr/local/bin/envycontrol
```

Running `envycontrol` should give you an output similar to this:

```
usage: envycontrol [-h] [-v] [-q] [-s MODE] [--dm DISPLAY_MANAGER]
                   [--force-comp] [--coolbits [VALUE]] [--rtd3 [VALUE]]
                   [--reset-sddm] [--reset] [--verbose]
...
```

## Setting NVIDIA as the Primary GPU

Note: The command given below may not work for your configuration, if so
please read the help section of the command, or try and look for available
issues or open your own on the
[official repository of envycontrol](https://github.com/bayasdev/envycontrol).

To make the primary display output powered by the NVIDIA GPU, as well as
every other application, we are gonna run this command:

```
sudo envycontrol -s nvidia --force-comp --dm lightdm --rtd3 0
```

You should get a similar output to this:

```
Switching to nvidia mode
Enable ForceCompositionPipeline: True
Enable Coolbits: False
Rebuilding the initramfs...

Successfully rebuilt the initramfs!
Operation completed successfully
Please reboot your computer for changes to take effect!
```

## Verifying

Before rebooting, we wanna verify some information.

Running `nvidia-smi` gives us this:

```
+-----------------------------------------------------------------------------+
| NVIDIA-SMI 390.157                Driver Version: 390.157                   |
|-------------------------------+----------------------+----------------------+
| GPU  Name        Persistence-M| Bus-Id        Disp.A | Volatile Uncorr. ECC |
| Fan  Temp  Perf  Pwr:Usage/Cap|         Memory-Usage | GPU-Util  Compute M. |
|===============================+======================+======================|
|   0  GeForce GT 540M     Off  | 00000000:01:00.0 N/A |                  N/A |
| N/A   48C    P0    N/A /  N/A |      0MiB /   964MiB |     N/A      Default |
+-------------------------------+----------------------+----------------------+
```

Where the `0MiB / 964MiB` implies that the GPU is not used at all.

Upon rebooting, running the same command shows the memory is being used, thus
the GPU is being used.

```
+-----------------------------------------------------------------------------+
| NVIDIA-SMI 390.157                Driver Version: 390.157                   |
|-------------------------------+----------------------+----------------------+
| GPU  Name        Persistence-M| Bus-Id        Disp.A | Volatile Uncorr. ECC |
| Fan  Temp  Perf  Pwr:Usage/Cap|         Memory-Usage | GPU-Util  Compute M. |
|===============================+======================+======================|
|   0  GeForce GT 540M     Off  | 00000000:01:00.0 N/A |                  N/A |
| N/A   51C    P0    N/A /  N/A |     49MiB /   964MiB |     N/A      Default |
+-------------------------------+----------------------+----------------------+
```

and running `glxinfo | grep vendor` gives us this:

```
server glx vendor string: NVIDIA Corporation
client glx vendor string: NVIDIA Corporation
OpenGL vendor string: NVIDIA Corporation
```

## Notes

This tweak may still rely on the Integrated GPU as the display may be still
be driven by it, especially if the display is connected by hardware and not
software to the primary GPU. Therefore trying to blacklist the Integrated GPU
drivers may cause the NVIDIA GPU to not work, display resolution issues,
black screen, etc... thus requiring a recovery environment to revert the
changes.

The way this tweak works is by copying the frame buffer from the NVIDIA GPU
to the Integrated GPU, this statement may be false as I have not personally
researched it thoroughly to be 100% sure this is the case.
