###initializing the the Virtual Machine

```php
// create our project directory

$ mkdir project					
```

```php
// access our project directory

$ cd project
```

```php
// initialize our VM machine

$ vagrant init
```


___

###editing the *Vagrantfile*

```php
// project/Vagrantfile 

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
 
  config.vm.box = "precise32"

  config.vm.box_url = "http://files.vagrantup.com/precise32.box"
  
end
```

```php
// running the virtual machine

$ vagrant up
```

```php
// destroying a VM

$ vagrant destroy
```
___

###accessing the VM

```php
// SSH into ~vagrant$

$ vagrant ssh
```

* We are now on linux system so can use linux commands
* `sudo apt-get install git` to install git
* Use `~$ exit` to exit the VM

___

### modifying the Vagrantfile

```php
// project-folder/Vagrantfile

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "base"

  config.vm.box_url = "http://files.vagrantup.com/precise32.box"

  # Create a forwarded port mapping which allows access to a specific port
  # within the machine from a port on the host machine.  In the example below,
  # accessing "localhost:8080" will access port 80 on the guest machine.
  config.vm.network :forwarded_port, guest: 80, host: 8080

  config.vm.provision :shell, :path => "bootstrap.sh"

end
```
___

### using a *bash* script to define the *Vagrantfile* installation requirements

```php
// project/bootstrap.sh

#!/usr/bin/env bash

sudo apt-get update

sudo apt-get install -y python-software-properties

sudo add-apt-repository -y ppa:ondrej/php5

sudo apt-get update

sudo apt-get install -y wget php5 apache2 php5-mcrypt php5-curl

# Apache stuff
sudo a2enmod rewrite

sudo rm -rf /var/www/html
sudo ln -fs /vagrant /var/www/html

sudo service apache2 restart
```

* if we already have a VM running and we make changes to our `boostrap.sh` file, then 
we can use `$ vagrant provision`.
* if we make any changes to the `Vagrantfile` then we can use the command `$ vagrant reload`

___

___

###testing the VM installation

```php
// STEP 1: create a file with some contents

$ echo "About me" > about.php
```

```php
// STEP 2: SSH into the VM

$ vagrant ssh
```

```php
// STEP 3: access the vagrant folder

~$ cd /vagrant
```

```php
// STEP 4: list the vagrant folder files

/vagrant$ ls

OUTPUT>>>  bootstrap.sh  about.php   Vagrantfile
```

```php
// STEP 5: add some php content to about.php 

// project/about.php
<?php
$name = 'Andy';
echo 'Hello '.$name;
?>
```

```php
// STEP 6: test in browser

Localhost:8080/about.php
```


___









