###General notes

* Table names are plural: users, books, authors

* When linking tables, foreign key is always named ***_id: user_id, book_id, author_id (note: singular noun used)


___

###'hasMany'

```php
authors hasMany books
```

* **one-to-many** relationship (one author hasMany books)

* foreign key is **author_id** on the books table

___

###'hasOne'

```php
authors hasOne books
```

* **one-to-one** relationship (one author hasOne books)

* foreign key is **author_id** on the books table

___



###'belongsTo'

```php
books belongsTo author
```

* **one-to-many** relationship (many books **belongsTo** one author -- for authors hasMany books)

* **one-to-one** relationship (one book **belongsTo** one author -- for authors hasOne books)

* foreign key is **author_id** on the books table

__


###'belongsToMany'

```php
readers belongsToMany books 
books belongsToMany books
```

* **book_reader** pivot table with book_id and reader_id columns 

* Pivot table table name uses singular noun in alphabetical order

* When we create a pivot table, we do not need to use the timestamps() method or include a primary key.

___

###Using 'associate()' to save data for one-to-one or one-to-many relationships

First we create the **Song** class with the assocArtist method (or any other name) which binds a one-to-many (or one-to-one) relationship with the Artist.  This basically states that there will be an **artist_id** on the **songs** table as there can only be one entry per song. 

```php
Class Song extends Eloquent {

	public function assocArtist()
	{
		return $this->belongsTo(‘Artist’);
	}
}
```


```php
Class Artist extends Eloquent {

	public function assocSong()
	{
		return $this->hasMany(‘Song’);
	}
}
```


We can save data to the database using either of the following methods:

```php
$artist = new Artist;
$artist->name = ‘Coldplay’;
$artist->save();

$song = new Song;
$song->name = ‘Yellow’;
$song->assocArtist()->associate($artist);  
$song->save();
```

```php
$artist = new Artist;
$artist->name = ‘Coldplay’;
$artist->save();

$song = new Song;
$song->name = ‘Yellow’;
$song->artist_id = $artist->id;
$song->save();
```

* The two blocks of code will save to the database and create a relationship between the **$song** and the **$artist** objects.

* **$artist** must be saved before being passed to **$song** 

___

###saving data for many-to-many relationships

```php
$listener = new Listener;
$listener->name = ‘Andy Roddam’;
$listener->save();
$listener->
```


