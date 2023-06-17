# Removing Metadata From Ogg Vorbis Files

To remove metadata/comments from Ogg Vorbis files you must have vorbis-tools installed on your system.

## Installation (Windows)

Get **vorbiscomment.exe** from this [GitHub page](https://github.com/Chocobo1/vorbis-tools_win32-build/releases) and extract it to **C:\Windows\system32**.

### Installation (Linux)

Open an elevated shell and run:

Debian:

```
apt install -y vorbis-tools
```

Arch Linux:

```
pacman -S vorbis-tools
```

## Removing comments (Windows)

To remove a comment from a single file you simply do:

Windows:

```
vorbiscomment -w "path to input file" < nul
```

Linux:

```
vorbiscomment -w "path to input file" < /dev/null
```

If you want the changes to be written to a different file:

Windows:

```
vorbiscomment -w "path to file" "path to output file" < nul
```

Linux:

```
vorbiscomment -w "path to file" "path to output file" < /dev/null
```

To process more .OGG files in a directory, we are gonna create a **processed** folder and write files to there, note that you can omit this approach and write directly to the file if you want to overwrite the original by not specifying (Windows) `"processed\%i"` or (Linux) `"processed/$i"`

Windows:

```
mkdir processed
for /f "delims=" %i in ('dir /a /b *.ogg') do @vorbiscomment -w "%i" "processed\%i" < nul
```

Linux (bash):

```
mkdir processed
for i in ./*.ogg
do
	vorbiscomment -w "$i" "processed/$i" < /dev/null
done
```
