### Template for Zend Framework based projects

It's really simple template, but it speeds up ZF based projects bootstrap :). Some nice features:

* it is integrated with DoctrineORM framework (thanks to Bisna library)
* layouts are based on Twitter Bootstrap
* there are two modules - one for users, other for administrators
* project configuration is optimised for use in project that many developers are working on
* PHPUnit tests and Doctrine CLI are working out of the box

### Quick start

#### Requirements
You have to have following libraries in your include path:

* Zend Framework (preferably version 1.11.11, I didn't test it on older ones, but should work :))
* DoctrineORM (version 2.2.1)
* PHP 5.3.0+ (as Doctrine uses PHP 5.3 stuff)
* PHPUnit 3.6.10 (optional, but recommended)

#### Installation

* clone this github repo into your computer (you can also download zip or tar.gz package with it)
* set up your web server, for apache you can use configuration like that

```
<VirtualHost *:80>
   DocumentRoot "/path/project-folder/public"
   ServerName name.local

   SetEnv APPLICATION_ENV development

   <Directory "/path/project-folder/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>
</VirtualHost>
```
* add row in your /etc/hosts file, so you can access your project at URL like http://name.local (if you have some fancy configuration with DNS, you probably don't need it, but if you have such fancy configuration you probably won't read this ;)).

```
127.0.0.1 name.local
```

* restart your web server, point your browser to http://name.local and enjoy. You can access admin zone at http://name.local/backend
