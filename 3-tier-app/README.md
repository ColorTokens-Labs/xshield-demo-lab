# Setting up the 3-tier IceHrm application

Spin up three Linux VMs.  This guide assumes you are using 
Ubuntu 20.03 LTS and other distros will require some changes
to the commands (like `yum` instead of `apt` and so on).

On all VMs make sure you have the latest and greatest:

```
sudo apt update
sudo apt upgrade
```

## Database tier

We will install and configure mysql on the database server.
Set the hostname for this server as __hrm-db__ and then 
install the server package.

```
sudo hostnamectl set-hostname hrm-db
sudo apt install -y mysql-server
```

Now harden the installation by running this script:

```
sudo /usr/bin/mysql_secure_installation
```

Choose "y" when you are prompted to continue securing the
installation.  Select level 1 (MEDIUM) for password complexity
and set a password (and remember it!).

Also select "y" for the following prompts:

- Remove anonymous users
- Disallow root login remotely
- Remove test database
- Reload privilege tables

You will need a two or three IceHrm sql scripts to initialize 
the database.  I've provided these here for convenience:

- [icehrmdb.sql](icehrm/icehrmdb.sql)
- [icehrm_master_data.sql](icehrm_master_data.sql)
- [icehrm_sample_data.sql](icehrm_sample_data.sql) (Optional)

Create the database for IceHrm using the following commands:

```
$ mysql -u root -p
mysql> create database hrms;
mysql> create user 'hrms_user'@'%' identified by 'This_is_my_pa$$w0rd';
mysql> grant all on hrms.* to 'hrms_user'@'%';
```
Note the database password above.  Feel free to change it,  but if you
do, you will also need to update it later in the application tier.


Now let's test connectivity to our new database, and if all is
well, import the IceHrm SQL scripts:

```
mysql -u hrms -p hrms
mysql> source icehrmdb.sql
mysql> source icehrm_master_data.sql
mysql> source icehrm_sample_data.sql

```

As this is a 3-tier application and the application accessing
the database is on a different server, we need to allow remote
clients to connect to our database. These commands will edit the
mysql config file and restart the server.

```
sudo sed -i 's/127.0.0.1/0.0.0.0/g' /etc/mysql/mysql.conf.d/mysqld.cnf
sudo service mysql restart
```

## Application tier

The IceHrm application will be installed on the application server VM.
This is a PHP application that requires php >= 5.3.  On Ubuntu 20.03 LTS
we have access to php7.4 so that is what we shall install:

```
sudo apt install php php-mysql php-net-smtp php-gd memcached
```

Now download version 31 of IceHrm from their 
[Github repo](https://github.com/gamonoid/icehrm/releases/download/v31.0.0.OS/icehrm_v31.0.0.OS.tar.gz)
and extract it into the web directory.

```
wget https://github.com/gamonoid/icehrm/releases/download/v31.0.0.OS/icehrm_v31.0.0.OS.tar.gz
sudo tar xvzf icehrm_v31.0.0.OS.tar.gz -C /var/www
# Change the directory name for simplicity
sudo mv /var/www/icehrm_v31.0.0.OS /var/www/icehrm
```

Now download the configuration file from [here](icehrm/config.php)
and save it in `/var/www/icehrm/app`.  Open the file using your
favorite editor and verify the database credentials, especially
the password if you changed it while configuring the database

```
vi /var/www/icehrm/app/config.php
```

We also need to set directory ownership and permissions for the `app` 
directory:

```
sudo chown -R www-data:www-data /var/www/icehrm/app
sudo chmod 755 /var/www/icehrm/app
```

Almost there! If you don't have your database hostname in your DNS,
add the IP address of the database VM to `/etc/hosts`.

```
sudo echo "<database ip> hrm-db >> /etc/hosts
```

Finally, we need to update the document root for Apache2 and set it to
`/var/www/icehrm`.  You can use this single-line `sed` command to
do the trick, and then restart `apache2`.

```
sudo sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/icehrfm|g' /etc/apache2/sites-enabled/000-default.conf
sudo service apache2 restart
```

If all went well, you should be able to point your browser to the app
server IP address and see this:

![IceHrm installed](../docs/images/icehrm_install.png)

Login using `admin` for both the username and password.








