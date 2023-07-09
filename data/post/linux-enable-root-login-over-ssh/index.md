# Linux - Enable root Login Over SSH

## Editing the configuration

1. Edit the sshd\_config file in `/etc/ssh/sshd_config`:

```
sudo nano /etc/ssh/sshd_config
```

2. Add a line in the Authentication section of the file that says `PermitRootLogin yes`. This line may already exist and be commented out with a "#". In this case, remove the "#".

```
# Authentication:
#LoginGraceTime 2m
PermitRootLogin yes
#StrictModes yes
#MaxAuthTries 6
#MaxSessions 10
```

3. Save the updated `/etc/ssh/sshd_config` file.

4. Restart the SSH server:

```
sudo service sshd restart
```

## Source

- [Red Hat Customer Portal](https://access.redhat.com/documentation/en-us/red_hat_enterprise_linux/6/html/v2v_guide/preparation_before_the_p2v_migration-enable_root_login_over_ssh)
