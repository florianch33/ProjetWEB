
- Création d'un VHOST localhost : 

Création d'un fichier de configuration dans -> /etc/apach2/sites-available

Activer la configuration -> Sudo a2ensite [monsite.com]

Modifier dans /etc/hoss -> Ajouter l'url [monsite.com]


- Activer le SSL (openssl) : sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/apache2/ssl/apache2ssl.key -out /etc/apache2/ssl/apache2ssl.crt

Ajouter dans le fichier de configuration du VHOST ->  
SSLEngine on
SSLCertificateFile /etc/apache2/ssl/apache2ssl.crt
SSLCertificateKeyFile /etc/apache2/ssl/apache2ssl.key

-SSLEngine on
-SSLCertificateFile /etc/apache2/ssl/apache2ssl.crt
-SSLCertificateKeyFile /etc/apache2/ssl/apache2ssl.key










