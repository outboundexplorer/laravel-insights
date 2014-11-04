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
    - map: ~/Code
      to: /home/vagrant/Code

sites:
    - map: myapp
      to: /home/vagrant/code/projects/myapp/public

variables:
    - key: APP_ENV
      value: local
```

* This maps to my laravel project `myapp` which is placed in the projects folder.  


```php
// C:\Windows\System32\drivers\etc\hosts

192.168.10.10		myapp
```	  


Homestead>vagrant up










