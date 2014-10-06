###Serialize a PHP value

```php
$comments = array("greeting" => "Hello");
echo json_encode($truth);
```

`OUTPUT >>>  {"greeting":"Hello"}`


###Deserialze as a stdClass object

```php
$comments = json_decode('{"greeting":"Hello"}');
echo $truth->greeting;
```

`OUTPUT >>> Hello`


###Deserialize as an array

```php
$comments = json_decode('{"greeting":"Hello"}', true);
echo $truth['greeting'];
```

`OUTPUT >>> Hello`
