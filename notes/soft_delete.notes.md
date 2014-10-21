###soft deleting

*example*

```php
// users table
| Field          | Type             | Null | Key | Default             | Extra          |
+----------------+------------------+------+-----+---------------------+----------------+
| id             | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| username       | varchar(255)     | NO   |     | NULL                |                |
| password       | varchar(255)     | NO   |     | NULL                |                |
| email          | varchar(255)     | NO   |     | NULL                |                |
| remember_token | varchar(255)     | NO   |     |                     |                |
| created_at     | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
| updated_at     | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
| deleted_at     | timestamp        | YES  |     | NULL                |                |
+----------------+------------------+------+-----+---------------------+----------------+


// posts table
+------------+------------------+------+-----+---------------------+----------------+
| Field      | Type             | Null | Key | Default             | Extra          |
+------------+------------------+------+-----+---------------------+----------------+
| id         | int(10) unsigned | NO   | PRI | NULL                | auto_increment |
| title      | varchar(255)     | NO   |     | NULL                |                |
| content    | text             | NO   |     | NULL                |                |
| user_id    | int(11) unsigned | NO   | PRI | NULL                |                |
| deleted_at | timestamp        | YES  |     | NULL                |                |
| created_at | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
| updated_at | timestamp        | NO   |     | 0000-00-00 00:00:00 |                |
+------------+------------------+------+-----+---------------------+----------------
```

```php
// app/models/User.php

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	use \Illuminate\Database\Eloquent\SoftDeletingTrait;

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

	protected $fillable = array(
		'username',
		'password',
		'email'
	);

	public function posts()
	{
		return $this->hasMany('Post');
	}
}
```


```php
// app/models/Post.php

class Post extends Eloquent {

    public $table = 'posts';

    use \Illuminate\Database\Eloquent\SoftDeletingTrait;

    protected $fillable = array(
        'title',
        'content',
        'user_id'
    );

    public function user()
    {
        return $this->belongsTo('User');
    }
}
```

```php
// app/routes.php

Route::get('create-post', function()
{
    Post::create(array(
        'title'     => 'My first post',
        'content'   => 'This is the first post',
        'user_id'   => '2'
    ));
    return 'Done';
});

Route::get('delete-user', function()
{
    $user = User::find(2);
    $user->delete();
    $user->posts()->delete();
    return 'User soft-deleted';

});

Route::get('restore-user', function()
{
    $user = User::withTrashed()->find(2);
    $user->restore();
    $user->posts()->restore();
});

Route::get('force-delete', function()
{
    $user = User::withTrashed()->find(2);
    $user->forceDelete();
    $user->posts()->forceDelete();

});
```

* Both the `users` & `posts` table must have a `deleted_at` column in order to use soft deleting.
* We need to include `use SoftDeletingTrait` within our model class.
* As we have created a relationship between our models, we are able to chain our `posts` to the `user` 
and delete the relevant posts at the same time.
* `forceDelete()` will permanently delete the database record.
* `restore()` can only be used to restore records that have been soft-deleted.

___ 


