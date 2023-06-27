# Linux - Create a swap file

## What's a swap file?

Snippet from the [Wikipedia article](https://en.wikipedia.org/wiki/Memory_paging):

```
In computer operating systems, memory paging (or swapping on some Unix-like
systems) is a memory management scheme by which a computer stores and
retrieves data from secondary storage for use in main memory.
```

## Important notes

TL;DR: Don't use `fallocate`.

---

Certain forums propose that use of `fallocate` should be favored over `dd`, but this approach should always be discarded as bad practice.

The reasons behind this is that `fallocate` does not write raw data to the file, it only allocates an
[inode](https://en.wikipedia.org/wiki/Inode) that points to space that may be eventually used by the inode,
this is why `fallocate` is almost instantaneous but this in turn results in a file that has "holes" in it.

Let's take a snippet out from the manual pages of `mkswap` and `swapon` that expain this thoroughly:

**mkswap**
```
Note  that  a  swap  file  must  not contain any holes.  Using cp(1) to
create the file is not acceptable.  Neither is use of  fallocate(1)  on
file  systems  that support preallocated files, such as XFS or ext4, or
on copy-on-write filesystems like btrfs.   It  is  recommended  to  use
dd(1)  and  /dev/zero in these cases.  Please read notes from swapon(8)
before adding a swap file to copy-on-write filesystems.
```

**swapon**
```
You should not use swapon on a file with holes.  This can  be  seen  in
the system log as

      swapon: swapfile has holes.

The  swap file implementation in the kernel expects to be able to write
to the file directly, without the assistance of the  filesystem.   This
is  a problem on preallocated files (e.g.  fallocate(1)) on filesystems
like XFS or ext4, and on copy-on-write filesystems like btrfs.
```

## Create a swap file

### Notes

- `bs=1G` means 1 Gigabyte (see [Wikipedia - Byte - Multiple-byte units](https://en.wikipedia.org/wiki/Byte#Multiple-byte_units))
- `count=8` means 1 Gigabyte is written 8 times. You must always specify `count=1` if you want to explicitly write the size given to `bs` (it allows for bytes).

---

Open a terminal as root and run the following commands:

```bash
dd if=/dev/zero of=/swapfile bs=1G count=8 status=progress
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile
```

---

Verify whether the swap file is in use:

```bash
cat /proc/swaps
Filename   Type   Size      Used   Priority
/swapfile  file   8388604   0      -2
```

But either way add the swap entry into the `/etc/fstab` file.

```
/swapfile   none    swap    sw  0   0
```
