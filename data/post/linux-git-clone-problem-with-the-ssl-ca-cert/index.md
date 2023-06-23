# Linux - Git clone - Problem with the SSL CA cert

## Explaining the problem and fixing it

I encountered this problem when trying to clone one of the repos:

```
$ git clone https://github.com/anbox/anbox-modules
Cloning into 'anbox-modules'...
fatal: unable to access 'https://github.com/anbox/anbox-modules/': Problem with the SSL CA cert (path? access rights?)
```

It turned out I had remanence of Windows-based configuration flags inside `~/.gitconfig`.

Considering these lines:

```
[http]
    sslcainfo = C:\\env\\bin\\git\\usr\\ssl\\certs\\ca-bundle.crt
```

Upon commenting/removing those lines the `git clone` command now works.

## Alternative method

I personally do not recommend this approach but I came across some alternative method by removing certificates and
reinstalling them through the package manager.

Note: Before running any of the commands below, please make a backup of the `/etc/ssl/certs` directory, this is so you have
the original files saved in case something bad happens i.e. you can't reinstall the `ca-certificates` package and whatnot.

---

You'd run:

```bash
sudo rm -rf /etc/ssl/certs/*
```

and then reinstall those certificates:

```bash
sudo apt reinstall ca-certificates -y
```
