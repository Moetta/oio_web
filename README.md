# oio_web

Website "Owl In One" — PAE ESAIP 2017-2018

## Apache configuration 

**Mac:** 

In `extra/httpd-vhosts.conf` add:

```sh
<VirtualHost *:[port_number]>
    ServerAdmin oio
	DocumentRoot "/Applications/MAMP/htdocs/oio_web/public"
</VirtualHost>
```
**Windows:**

In `C:\MAMP\conf\apache\httpd.conf` add:

```
Enlever le commentaire pour obtenir:

# Virtual hosts
Include conf/extra/httpd-vhosts.conf
```
In `C:\MAMP\bin\apache\conf\extra\httpd-vhosts.conf`
```
<VirtualHost *:80>
    ServerName oio
    ServerAdmin oio
    DocumentRoot "C:/MAMP/htdocs/oio_web/public"
    ServerAlias oio
</VirtualHost>
```

## Machine configuration 

In `etc/hosts` add:

```sh
	127.0.0.1 	oio
```
