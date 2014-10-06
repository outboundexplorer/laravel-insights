###Apache 2 VirtualHost configuration

```C
<VirtualHost *:80>

    # Host that will serve this project.
    ServerName      app.dev

    # The location of our projects public directory.
    DocumentRoot    /path/to/our/public

    # Useful logs for debug.
    CustomLog       /path/to/access.log common
    ErrorLog        /path/to/error.log

    # Rewrites for pretty URLs, better not to rely on .htaccess.
    <Directory /path/to/our/public>
        <IfModule mod_rewrite.c>
            Options -MultiViews
            RewriteEngine On
            RewriteCond %{REQUEST_FILENAME} !-f
            RewriteRule ^ index.php [L]
        </IfModule>
    </Directory>

</VirtualHost>
```