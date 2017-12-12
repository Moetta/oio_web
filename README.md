# oio_web

Website "Owl In One" — PAE ESAIP 2017-2018

## Apache configuration 

In `extra/httpd-vhosts.conf` add:

```sh
<VirtualHost *:[port_number]>
	ServerAdmin oio
	DocumentRoot "/Applications/MAMP/htdocs/oio_web/public"
</VirtualHost>
```

## Machine configuration 

In `etc/hosts` add:

```sh
	127.0.0.1 	oio
```
