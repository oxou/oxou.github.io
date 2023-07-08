# Removing Metadata From FLAC Files

To remove metadata/comments from FLAC files you must have `flac` installed on your system.

## Installation (Windows)

Visit the [official download page](https://ftp.osuosl.org/pub/xiph/releases/flac/) where you'll find flac\*-win\* files listed for download.

Either create a `C:\flac` and set it to the `PATH` variable or simply extract the files to `C:\Windows\System32` (Not recommended).

## Installation (Linux)

Open an elevated shell and run:

Debian:

```
apt install -y flac
```

Arch Linux:

```
pacman -S flac
```

## Removing metadata

To remove metadata from a FLAC file you run:

```
metaflac --remove-all --dont-use-padding "path to input file"
```
