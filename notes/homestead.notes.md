###Setting up Laravel Homestead

Download Vagrant and install in /Users/Andy/


Download VirtualBox and install in /Users/Andy/



C:\Users\Andy>vagrant box add laravel/homestead

C:\Users\Andy>mkdir code


cd C:\Users\Andy\code> git clone https://github.com/laravel/homestead.git homestead


```php
// /Users/Andy/code/homestead/Homestead.yaml

---
ip: "192.168.10.10"
memory: 2048
cpus: 1

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: ~/code/projects
      to: /home/vagrant/projects

sites:
    - map: myapp
      to: /home/vagrant/projects/myapp/public

variables:
    - key: APP_ENV
      value: local
```

* This maps to my laravel project `myapp` which is placed in the projects folder.  


```php
// C:\Windows\System32\drivers\etc\hosts

192.168.10.10		myapp
```	  


C:\Users\Andy\code\homestead>vagrant up




To take a close look at our VM installation

In PhpStorm Tools > Start SSH

Host: 127.0.0.1
Post: 2222
User name: vagrant
Auth Type: Key Pair
Private key: C:/Users/Andy/.vagrant.d/insecure_private_key



vagrant@homestead:~$ cd /home
vagrant@homestead:/home$ ls
ubuntu vagrant

vagrant@homestead:/home$ cd vagrant
vagrant@homestead:~$ ls
projects

vagrant@homestead:~$ cd projects
vagrant@homestead:~/projects$ ls
myapp

vagrant@homestead:~/projects$ cd myapp
vagrant@homestead:~/projects/myapp$ ls
app artisan bootstrap composer.json public vendor ...........


vagrant@homestead:~$ mysql -uhomestead -p
Password: secret

(if have problems can try mysql -uhomestead -psecret



to connect via MySQL Workbench 

Connection Name: <anyname>

Conenction Method: Standard(TCP/IP)
Hostname: 127.0.0.1 
Port: 33060
Username: homestead
Password: secret
Default Schema: homestead

NOTE: We use 33060 instead of 3306 because we connecting from outside the VM.  Within the VM the default
ports are fine to use.




Adding a second site

---
ip: "192.168.10.10"
memory: 2048
cpus: 1

authorize: ~/.ssh/id_rsa.pub

keys:
    - ~/.ssh/id_rsa

folders:
    - map: ~/CodeLab/projects
      to: /home/vagrant/projects

sites:
    - map: myapp
      to: /home/vagrant/projects/myapp/public
    - map: second-app
      to: /home/vagrant/projects/second-app/public

variables:
    - key: APP_ENV
      value: local




#ANDY ADDED 04-11-2014
192.168.10.10		myapp
192.168.10.10		second-app












