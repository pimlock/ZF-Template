README
======

This is simple template for creating new ZF based projects.

Setting Up Your VHOST
=====================

The following is a sample VHOST you might want to consider for your project.

<VirtualHost *:80>
   DocumentRoot "/path/project-folder/public"
   ServerName name.local

   # This should be omitted in the production environment
   SetEnv APPLICATION_ENV development

   <Directory "/path/project-folder/public">
       Options Indexes MultiViews FollowSymLinks
       AllowOverride All
       Order allow,deny
       Allow from all
   </Directory>

</VirtualHost>
