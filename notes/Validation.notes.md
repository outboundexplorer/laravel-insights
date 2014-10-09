###Validation rules


```html
accepted					Value matches yes, on, 1.
```

```html
active_url					Value is valid URL structure and available within DNS records.
```

```html
after:10/10/10				Date after the given parameter.
```

```html
alpha						Value consists entirely of alphabetical characters.
```

```html
alpha_dash					Value consists of alphabetical characters,dashes (-) and underscores(_).
```

```html
alhpa_num					Value consists of alphabetical and numeric characters.
```

```html
before						Date before the given parameter. 
```

```html
between:1,10				Value between parameters given.
```

```html
confirm						Match the current field appended with (_confirmation).
```

```html
date						Value is a valid date.
```

```html
date_format:d/m/y			Value is a date string that matches the format provided as a parameter.
```

```html
different:another_field		Value to this field is different to the value of another_field.
```

```html
email						Value is a valid email address.
```

```html
exists:users,username		Value exists within 'users' table under the 'username' column'.
							(second parameter is optional -- default will use current field name)
							
							exists:users,username,role,admin  -- where role column has the role admin.
```

```html
image						File extension is (.bmp), (.gif), (.jpeg) or (.png).
```

```html
in:UK,USA,India				Value matches on of the parameters.
```

```html
integer						Value is an integer.
```

```html
ip							Value is a correctly formatted IP address.
```

```html
max:10						Value is smaller than or equal to 10.
```

```html
mimes:pdf,doc,docx			Value matches uploaded file's mime type specified in parameters.
```

```html
min:10						Value is greater than or equal to parameter.
```

```html
not_in:USA,UK, India		Value does not match values provided in the parameters.
```

```html
numeric						Value is a numeric value.
```

```html
regex:[a-z]					Value contains only lowercase letters (a-z).
```

```html
required					Current field must have a value.
```

```html
required_if:username,jim	Current field must have a value when username field is jim.
```

```html
required_with:size,color	Current field must have a value when size and color fields have values exist.
```

```html
required_without:color		Current field must have a value when color does not have a value.
```

```html
same:color					Value must match the value of the color field.
```

```html
size:10						Value of a string must match the number of characters declared 
							by the parameter. Value of a numeric value must match mathematically.
```

```html
unique:users,username		Value must be unique in the username of the users table. 
							(second parameter is optional -- default will use current fields name) 
```

```html
url							Value is a valid URL (does not check DNS records).
```
