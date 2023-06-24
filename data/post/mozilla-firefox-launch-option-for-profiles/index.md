# Mozilla Firefox - Launch Option For Profiles

## Introduction

Firefox doesn't make it easy to create desktop shortcuts pointing to different profiles, and if it does provide that option I could not find it.

This articles already assumes you have created a profile via [about:profiles](about:profiles) and that you either know the name of the profile, or it's **Root Directory**, any of these will be helpful.

## Notes

This article applies to Windows but is specifically written for Linux users, as shown at the bottom of the artice where I specify how to craft a `.desktop` file for Firefox on Linux.

Before continuing on, the differences between Linux and other systems are their directory paths, here's a list of paths for each system where the profiles _should_ be stored at:

|OS|Path|
|-|-|
|Linux|`/home/user/.mozilla/firefox/`|
|MacOS|`/Users/<username>/Library/Application Support/Firefox/Profiles/`|
|Windows|`%APPDATA%\Mozilla\Firefox\Profiles\`|

Therefore this article applies to these systems.

## Open a profile with a direct path

Here I have a profile named `Test1` and it's stored at `/home/user/.mozilla/firefox/XXXXXXXX.test1` where `X` are a set of random characters.

Make a note of that directory and run Firefox as following:

```
firefox -profile /home/user/.mozilla/firefox/XXXXXXXX.test1 & disown
```

This will open a Firefox window that'll be detached from your terminal.

If this was unsuccessful make sure you double-check the path you've provided. If there are spaces in the path you have to escape them using a backslash `\` or specify the path in quotation marks.

## Open a profile with its name

As noted previously I have a profile named `Test` and instead of specifying its direct path, we'll instead specify the profile name as following:

```
firefox -P Test1 & disown
```

This should in theory open the same profile, but again make sure to double-check in [about:profiles](about:profiles) to make sure you are in fact pointing at the right profile.

## Creating a Desktop shortcut

### Windows

Right click on the Desktop, New -> Shortcut, specify the absolute path for `firefox.exe` and then append the parameters as shown above **without** `& disown`, go Next and specify the name of the shortcut, done.

### Linux

Creating a shortcut on Linux may differ significantly depending on the distribution and Desktop Environment you're running.

Many Desktop Environments give you the option to `Create a launcher` where you specify the properties of a Desktop shortcut, but because not many systems will have this option, we're gonna take the text-mode route instead.

Open a shell on your Desktop and create a new file using your editor of choice; I'll use [GNU nano](https://www.nano-editor.org/).

```bash
nano "~/Desktop/Firefox - Test1.desktop"
```

Paste this template below and edit the entries accordingly:

```
[Desktop Entry]
Name=Firefox - Test1
GenericName=Web Browser
Exec=/usr/lib/firefox-esr/firefox-esr -profile "/home/user/.mozilla/firefox/XXXXXXXX.test1" %u
Terminal=false
X-MultipleArgs=false
Type=Application
Icon=firefox-esr
Categories=Network;WebBrowser;
StartupWMClass=Firefox-esr
StartupNotify=true
```

Upon saving the file, you may need to set the executable bit by doing so:

```
chmod +X "~/Desktop/Firefox - Test1.desktop"
```

And just like that you'll have a custom Desktop shortcut for launching a Firefox profile.

You can move that file to `/usr/share/applications` if you want it to appear in the Search results by doing so:

```
sudo mv "~/Desktop/Firefox - Test1.desktop" /usr/share/applications/
```
