# Linux - Configuring the PATH Variable

## Introduction

On Linux, the PATH variable is usually controlled by the `/etc/login.defs` file which defines `ENV_SUPATH` for super users and `ENV_PATH` for regular users.

The issue arises when there's a confusion regarding the availability of a certain command, for example I tried running `modprobe` as a regular user and got `command not found`.

I was quite confused by this error so I ran `su` to get a super user shell and I still got that same error.

Obviously this was a problem with the PATH variable because if we run `echo -e ${PATH//:/\\\\n}` we're gonna get a different result in a super user shell compared to the regular user, the actual issue here is that I used `su` instead of `su -`.

This mistake is easy to make and can cause countless hours of headache until you come back to your senses and realize where you made the initial mistake.

Difference between `su` and `su -` are that:

- `su` switches to the specified user without running a login shell

whereas

- `su -` switches to the specified user and runs a login shell.

Thus the issue I encountered above when dropping into a super user shell, I expected the PATH variable to change but it did not because I forgot to specify `-` as the 1st argument to `su`.

## Solving the problem

To solve this problem I'm gonna go ahead and overwrite the PATH variable via `.bash_preload`, which is itself reflected in `/root` as a symlink to `/home/user/.bash_preload`.

```bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin:/usr/local/games
```

After saving and re-opening the Terminal the command `modprobe` now worked for the regular user.

## Thoughts

I don't know if this can cause problems down the road, such as having 2 separate binaries with the same name but one of them having precedence over the other, or things of that nature.

For now this works perfectly okay, and if I discover a downside to this I'll keep this post updated.
