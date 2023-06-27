# Linux - Make sudo Always Ask For Password

For "enhanced security" we'll make **sudo** always ask for password.

Run `sudo visudo` and find a line that starts with `Defaults`, something like this:

```
Defaults    env_reset
```

and append to it `,timestamp_timeout=0` to disable `sudo` timestamp thus in turn making **sudo** always ask for the password whenever root privileges have been dropped and the user wants elevated session again.

In case the keyword `timestamp_timeout` does exist and its value is set to something other than `0` then modify that entry instead of adding your own.


You can also create a new entry below all the others like so:

```
Defaults    timestamp_timeout=0
```
