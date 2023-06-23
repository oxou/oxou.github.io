# Linux - Fix SSH Permissions

## Introduction

Upon setting up git on my Linux machine and manually copied over my SSH keys, I've encountered this error when trying to push changes:

```
sign_and_send_pubkey: signing failed: agent refused operation
```

This is related to the permissions of `~/.ssh` itself and the files inside.

## Fixing the problem

Open a Terminal as a traditional user and type:

```
$ chmod 700 ~/.ssh
$ chmod 600 ~/.ssh/*
```

Hopefully this solves the issue.
