
Version 1: Just runs migrations and seeds for specific project


```php
// Homestead/scripts/homestead.rb (addition)

# Run migrations and seeds
config.vm.provision "shell" do |s|
  s.path = "./scripts/run_migrations_and_seeds.sh"
end
```

```php
// Homestead/scripts/run_migrations_and_seeds.sh

#!/usr/bin/env bash

#run migrations
echo "Running migrations and seeds";
cd projects/groupie;
php artisan migrate;
php artisan db:seed;
```


_____

```
// Homestead/scripts/homestead.rb (addition)

# Run migrations and seeds
settings["sites"].each do |site|
  config.vm.provision "shell" do |s|
	s.path = "./scripts/migrations-and-seeds.sh"
	s.args = [site["map"]]
  end
end
```

```
#!/usr/bin/env bash
MAP=$1

#run migrations and seeds
echo "Running migrations and seeds";
cd /home/vagrant/projects/$MAP;
php artisan migrate;
php artisan db:seed;
```

Note that when using this kind of script, projects that have not had migrations or seeds will just pass through this.  However, if the database folder has been deleted, then this will cause a fatal error and the virtual machine will not run correctly. 



