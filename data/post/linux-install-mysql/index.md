# Linux - Install MySQL

### Please note!
This article applies for distributions with the `apt` package manager e.g. Ubuntu or Debian.

---

### Warning
This guide will show you how to quick and dirty install MySQL on a Linux machine without a care for security.

We just want to have a MySQL server running and move on with our lives.

---

### Updating and upgrading
Before installing anything, please run:

```
apt update -y && apt upgrade -y
```

This will update the APT database and all the packages that need upgrading.

---

### Installing MySQL Server and Client
In the evelated shell run:

```
apt install mysql-server mysql-client -y
```

and the installation for the Server and Client will get installed.

---

### Stopping the MySQL Service

Once it's done, MySQL Server service should have been started automatically.

We must shut it down temporarily while we go through the configuration files, so try any of these commands:

```
systemctl stop mysql
systemctl stop mysqld
systemctl stop mysqld.service
```

---

### Configuration
There are some files to modify and commands to run in order to configure MySQL to be accessible through any connection, with or without a password.  For the sake of sanity we won't be using any passwords, but I'll provide an alternative syntax for configuring MySQL user with the password for those who want to be a bit more secure.

#### Setting the Bind address
Open `/etc/mysql/mysql.conf.d/mysqld.cnf` and find a line containing:

```
bind-address = 127.0.0.1
```

and change it to:

```
bind-address = 0.0.0.0
```

**Note**: In case there's a number sign (**#**) before **bind-address** make sure to remove it because if you don't you'll be setting that IP address for nothing.

It's important to know that sometimes this entry may not exist in the **mysqld.cnf** file, if that is the case add the entry at the bottom of the file and it should hopefully still work.

#### Restarting the MySQL Service
After the files have been configured we must restart the MySQL service, so try any of these commands:

```
systemctl start mysql
systemctl start mysqld
systemctl start mysqld.service
```

... and hope that everything works!

#### Logging into MySQL and setting up permissions.
Do these steps in the terminal, with the same order:

```
mysql -u root -p

DROP USER 'root'@'localhost';
DROP USER 'root'@'127.0.0.1';
DROP USER 'root'@'%';

CREATE USER 'root'@'localhost' IDENTIFIED BY '';
CREATE USER 'root'@'127.0.0.1' IDENTIFIED BY '';
CREATE USER 'root'@'%' IDENTIFIED BY '';

GRANT ALL ON *.* TO 'root'@'localhost';
GRANT ALL ON *.* TO 'root'@'127.0.0.1';
GRANT ALL ON *.* TO 'root'@'%';

FLUSH PRIVILEGES;
```

#### Firewall Permissions
To allow MySQL connection through the firewall, run the command:

```
sudo ufw allow mysql
```

If you don't have  [**ufw**](https://wiki.ubuntu.com/UncomplicatedFirewall) installed, run `sudo apt install ufw -y` to install it and try the command again.

#### That's it regarding this section.
Now you are capable of accessing the MySQL database either through localhost or on your LAN network.

#### How do I password protect my user on MySQL?
Going back up onto the **Logging into MySQL and setting up permissions** section, we have decided to create a user without a password.  If you want to create a user with a password you can simply redo the commands in that section and replace `''` in `IDENTIFIED BY ''` with your password, for example:

```
CREATE USER 'root'@'localhost' IDENTIFIED BY 'yourPassword123';
CREATE USER 'root'@'127.0.0.1' IDENTIFIED BY 'yourPassword123';
CREATE USER 'root'@'%' IDENTIFIED BY 'yourPassword123';
```

That should be it - you have created a user that is password protected.
