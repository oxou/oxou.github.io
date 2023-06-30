# Linux - How To Use Command Line To Change Volume

## ALSA

You can use [`amixer`](https://tldp.org/HOWTO/Alsa-sound-6.html). It's in the `alsa-utils` package on Ubuntu and Debian.

Run `amixer` without paramters to get an overview about your controls for the default device.

You can also use `alsamixer` without parameters (from the same package) to get a more visual overview. Use F6 to see and switch between devices. Commonly, you might have PulseAudio and a hardware sound card to select from.

Then use `amixer` with the `set` command to set the volume. For example, to set the master channel to 50%:

```text
amixer set Master 50%
```

`Master` is the control name and should match one that you see when running without parameters.

Note the `%` sign, without it, it will treat the value as a 0 - 65536 level.

If PulseAudio is not your default device, you can use the `-D` switch:

```text
amixer -D pulse set Master 50%
```

Other useful commands pointed out in the comments:

To increase/decrease the volume use `+/-` after the number, use:

```text
amixer set Master 10%+
amixer set Master 10%-
```

To mute, unmute or toggle between muted/unmuted state, use:

```text
amixer set Master mute
amixer set Master unmute
amixer set Master toggle
```

Also note that there might be two different percentage scales, the default raw  and for some devices a [more natural scale based on decibel](https://mailman.alsa-project.org/pipermail/alsa-devel/2012-March/050146.html), which is also used by `alsamixer`. Use `-M` to use the latter.

Finally, if you're interested only in PulseAudio, you might want to check out `pactl` below.

## PulseAudio

[`pactl`](https://linux.die.net/man/1/pactl)/[`pacmd`](https://linux.die.net/man/1/pacmd) (unlike `amixer`) allows increasing volume over 100%

```text
pactl set-sink-mute 0 toggle  # toggle mute, also you have true/false
pactl set-sink-volume 0 0     # mute (force)
pactl set-sink-volume 0 100%  # max
pactl set-sink-volume 0 +5%   # +5% (up)
pactl set-sink-volume 0 -5%   # -5% (down)
```

Manual settings over 100% is possible in `pavucontrol` (unlike `alsamixer`).

**Note**: If you want to share the same commands on different hosts with different sinks, you can use `@DEFAULT_SINK@` as a sink instead of number `0`:

```text
pactl set-sink-volume @DEFAULT_SINK@ +5%
```

You set your default sink with `pactl set-default-sink my-sink-name` (list names with `pactl list short sinks`).

# Source

- [(stackoverflow#1)](https://unix.stackexchange.com/a/21090)
- [(stackoverflow#2)](https://unix.stackexchange.com/a/307302)
