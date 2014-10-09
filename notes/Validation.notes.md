###Validation rules


```html
accepted					yes, on, 1
```

```html
active_url					valid URL structure and available within DNS records
```

```html
after:10/10/10				date after the given parameter
```

```html
alpha						value consists entirely of alphabetical characters
```

```html
alpha_dash					value consists of alphabetical characters,dashes (-) and underscores(_) 
```

```html
alhpa_num					value consists of alphabetical and numeric characters
```

```html
before						date before the given parameter 
```

```html
between:1,10				value between parameters given 
```

```html
confirm						match the current field appended with (_confirmation)
```

```html
date						value is a valid date
```

```html
date_format:d/m/y			value is a date string that matches the format provided as a parameter
```

```html
different:another_field		value to this field is different to the value of another_field
```

```html
email						value is a valid email address
```

```html
exists:users,username		value exists within 'users' table under the 'username' column' 
							(second parameter is optional -- default will use current field name)
							
							exists:users,username,role,admin  -- where role column has the role admin      							
```

```html
image						file extension is (.bmp), (.gif), (.jpeg) or (.png)
```

```html
in:UK,USA,India				value matches on of the parameters
```

```html
integer						value is an integer
```

```html
ip							value is a correctly formatted IP address
```

```html
max:10						value is smaller than or equal to 10
```

```html
mimes:pdf,doc,docx			value matches uploaded file's mime type specified in parameters						
```

```html
min:10						value is greater than or equal to parameter
```

```html
not_in:USA,UK, India		value does not match values provided in the parameters
```

```html
numeric						value is a numeric value
```

```html
regex:[a-z]					value contains only lowercase letters (a-z)
```

```html
required					current field must have a value
```

```html
required_if:username,jim	current field must have a value when username field is jim
```

```html
required_with:size,color	current field must have a value when size and color fields have values exist				
```

```html
required_without:color		current field must have a value when color does not have a value
```

```html
same:color					Value must match the value of the color field
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
