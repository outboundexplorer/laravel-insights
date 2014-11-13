Recently I started working on a Laravel project that requires integration with Elasticsearch search engine. I didn’t want to change super cool development environment that Taylor (creator of Laravel) so kindly provided to us, so I installed Elasticsearch on Homestead instead of creating a new Vagrant box specially for this project. Here is a little snippet that will help you if you want to use Elasticsearch in you Laravel application.

	
# Login as root
root@homestead:~# sudo -s
 
# Update Aptitude
root@homestead:~# apt-get update
 
# Install Java
root@homestead:~# apt-get install openjdk-7-jre-headless -y
 
# Download and install Elasticsearch Public Signing Key
root@homestead:~# wget -qO - http://packages.elasticsearch.org/GPG-KEY-elasticsearch | sudo apt-key add -
 
# Add repository
root@homestead:~# echo "deb http://packages.elasticsearch.org/elasticsearch/1.4/debian stable main" > /etc/apt/sources.list.d/elasticsearch.list
 
# Update Aptitude
root@homestead:~# apt-get update
 
# Install Elasticsearch
root@homestead:~# apt-get install elasticsearch
 
# Set Elasticsearch to run on startup
root@homestead:~# update-rc.d elasticsearch defaults 95 10
 
# Start Elasticsearch server
root@homestead:~# /etc/init.d/elasticsearch start




After that you can configure port forwarding, edit your homestead.rb file and add following line just below other port forwards:

config.vm.network "forwarded_port", guest: 9200, host: 62000

	
config.vm.network "forwarded_port", guest: 9200, host: 62000

You need to reload vagrant box:

vagrant reload

	
vagrant reload

Now, on your host, try to make curl request:
curl -X GET localhost:62000

	
curl -X GET localhost:62000


	
{
  "status" : 200,
  "name" : "Warhawk",
  "version" : {
    "number" : "1.3.2",
    "build_hash" : "dee175dbe2f254f3f26992f5d7591939aaefd12f",
    "build_timestamp" : "2014-08-13T14:29:30Z",
    "build_snapshot" : false,
    "lucene_version" : "4.9"
  },
  "tagline" : "You Know, for Search"
}

That’s it, now when we have installed Elasticsearch on Laravel, in one of the next tutorials we will see how to index and search data.


___

FRom another person


# Install Java
sudo apt-get install openjdk-7-jre-headless -y
 
# Download & install the Public Signing Key
wget -qO - http://packages.elasticsearch.org/GPG-KEY-elasticsearch | sudo apt-key add -
 
# Add the following to /etc/apt/sources.list
deb http://packages.elasticsearch.org/elasticsearch/1.3/debian stable main
 
# Update Aptitude
sudo apt-get update
 
# Install Elasticsearch
sudo apt-get install elasticsearch
 
# Configure Elasticsearch to run on startup
sudo update-rc.d elasticsearch defaults 95 10
 
# Start the server now
sudo /etc/init.d/elasticsearch start
 
# Test whether it's working
curl -X GET localhost:9200


____


Another person

On guest:

    apt-get update
    apt-get install openjdk-7-jre-headless -y
    wget -qO - http://packages.elasticsearch.org/GPG-KEY-elasticsearch | sudo apt-key add -
    echo "deb http://packages.elasticsearch.org/elasticsearch/1.3/debian stable main" > /etc/apt/sources.list.d/elasticsearch.list
    apt-get update
    apt-get install elasticsearch
    update-rc.d elasticsearch defaults 95 10
    /etc/init.d/elasticsearch start

In vagrant config:

    config.vm.network "forwarded_port", guest: 9200, host: 9200

	
____

Another person:

# Install Java
sudo apt-get install openjdk-7-jre-headless -y
 
# Download & install the Public Signing Key
wget -qO - http://packages.elasticsearch.org/GPG-KEY-elasticsearch | sudo apt-key add -
 
# Add the following to /etc/apt/sources.list
deb http://packages.elasticsearch.org/elasticsearch/1.3/debian stable main
 
# Update Aptitude
sudo apt-get update
 
# Install Elasticsearch
sudo apt-get install elasticsearch
 
# Configure Elasticsearch to run on startup
sudo update-rc.d elasticsearch defaults 95 10
 
# Start the server now
sudo /etc/init.d/elasticsearch start
 
# Test whether it's working
curl -X GET localhost:9200


____

Another person:


isimmons
Jul 7

You may have found out if you create a database inside a vm and then forget to suspend/halt before shutting down the host computer, later when you do 'vagrant up' it will start from scratch pulling in the base box and provisioning so any databases you had are gone now.

Considering that in development you should be working with a clean development db and fake seed data, there is an easy fix.

Using Laravel Homestead for the example but you should be able to do something similar with other setups like Vaprobash.

In Homestead.yaml you can place any settings you want and then use them in scripts/homestead.rb so here is a starting point

My Homestead.yaml setup for two sites with added database settings.

---
authorize: /Users/lotus/.ssh/id_rsa.pub

keys:
    - /Users/lotus/.ssh/id_rsa

folders:
    - map: /Users/lotus/projects/larabook
      to: /home/vagrant/larabook
    - map: /Users/lotus/projects/meticulous
      to: /home/vagrant/meticulous

sites:
    - map: larabook.dev
      to: /home/vagrant/larabook/public
    - map: meticulous.dev
      to: /home/vagrant/meticulous/public

databases:
    - name: larabook
    - name: meticulous

variables:
    - key: APP_ENV
      value: local


In scripts create dbmaker.sh (you could inline the script in homestead.rb but I like having a separate shell script)

#!/usr/bin/env bash
DB=$1;
#clean up first
echo "Droping database $DB if it already exists.";
mysql -uhomestead -psecret -e "DROP DATABASE IF EXISTS $DB";

echo "Creating new database $DB";
mysql -uhomestead -psecret -e "create database $DB";

Now after all the other settings loops in homestead.rb you can add your own loop to loop through the database names

   # create project databases
    settings["databases"].each do |db|
        config.vm.provision "shell" do |s|
            s.path = "./scripts/dbmaker.sh"
            s.args = [db["name"]]
        end
    end

I tested re-provisioning with already existing databases and also manually dropped the databases and re-provisioned to make sure both the DROP and CREATE commands are working.

Like I said this is a simple starting point that works. The next step would be to run 'artisan migrate' and 'artisan db:seed' before starting to work with your application (assuming you have migrations and seeds created)

If you want, I think you could extend this to work with dump files. It would be a matter of adding a dumppath to databases in Homestead.yaml, adding the second argument to the loop in homestead.rb, and then changing the dbmaker.sh to something like this.

#!/usr/bin/env bash
DB=$1;
DUMPFILE=$2;

#clean up first
echo "Droping database $DB if it already exists.";
mysql -uhomestead -psecret -e "DROP DATABASE IF EXISTS $DB";

echo "Creating new database $DB";
mysql -uhomestead -psecret -e "create database $DB";

echo "Importing data to $DB from $DUMPFILE";
mysql -uhomestead -psecret -h localhost -e "$DB < $DUMPFILE";

WARNING: I haven't tried this second way yet so I'm not sure if it works and there are two different kinds of dumps -- ones that create the database and insert the data, and ones that just insert the data so I'm not sure how that works with this. I think ones that create the database will DROP and CREATE before inserting the data which would make the first two commands in dbmaker.sh redundant.

More info on importing data dumps here http://www.cyberciti.biz/faq/import-mysql-dumpfile-sql-datafile-into-my-database/

Be glad to here others input on a simple way to create the databases and seed data on 'vagrant up'



oes
Jul 8

I do something similar in my separate shell script I do the following. To me seed is so important instead of running mysql dumps and importing them back in. Seeding is so much better.

mysql -uroot -psecret -e"create database my_database_name;"
( cd /home/app_name ; php artisan migrate --seed )

cat << EOF | sudo tee -a /home/vagrant/.profile
PATH="vendor/bin/phpspec:\$PATH"
EOF

As you can see also adding phpspec to my path

___

