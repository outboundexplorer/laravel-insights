

```php
// add everything (or all modified files) to staging area 

git add .
```

```php
// add a specific file to the staging area

git add app/config/database.php
```

```php
// see staging area

git status
```

```php
// commit staging area to git repository

git commit -m setuplaravel
```

```php
// view the git log

git log
```

``` php
// view the git log on one line

git log --online
```

```php
// revert all changes to all files since last commit

git checkout .
```

```php
// revert all changes to a specific file since last commit

git checkout app/config/database.php
```

```php
// revert to a specific commit (with soft delete)

git reset 5g0994300efdsfi0909039029090f9vdvds09vdss9fdsfds0
```

```php
// revert to a specific commit and delete all changes that followed

git reset --hard
```

```php
// create a new branch

git checkout -b feature/mailer
```

```php
// switch to a different branch

git checkout master
```


