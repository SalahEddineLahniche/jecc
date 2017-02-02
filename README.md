# JECC Web Site

## Setup a web server

- For more info goto [link][https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mysql-php-lemp-stack-on-ubuntu-14-04]

- install `virtualbox` and `vagrant`

- clone this repository

- `vagrant up`

- within the guest machine:

  - `sudo apt-get update`

  - `sudo apt-get install nginx`

  - `sudo apt-get install mysql-server`

  - `sudo mysql_install_db`

  - `sudo mysql_secure_installation`

  - `sudo apt-get install php5-fpm php5-mysql`

  - `sudo nano /etc/php5/fpm/php.ini` then find `cgi.fix_pathinfo` uncomment it and make it 0

  - `sudo service php5-fpm restart`

  - `sudo nano /etc/nginx/sites-available/default` then replace the exisiting server with the following:

  - ```nginx
    server {
        listen 192.168.33.10:80;
        #listen [::]:80 default_server ipv6only=on;

        root /vagrant;
        index index.php index.html index.htm;

        server_name jecc.ma.web;

        location / {
            try_files $uri $uri/ =404;
        }

        error_page 404 /404.html;
        error_page 500 502 503 504 /50x.html;
        location = /50x.html {
            root /usr/share/nginx/html;
        }

        location ~ \.php$ {
            try_files $uri =404;
            fastcgi_split_path_info ^(.+\.php)(/.+)$;
            fastcgi_pass unix:/var/run/php5-fpm.sock;
            fastcgi_index index.php;
            fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
            include fastcgi_params;
        }
    }
    ```

  - restart to work with updated configuration`sudo service nginx restart`

  - make it start-up`sudo update-rc.d nginx defaults`

  - go to `etc/hosts` and add the following line `192.168.33.10 jecc.ma.web`

## Setup mysql

- `mysql --user=root --password=toor` note that i used these credentials when i installed mysql
- with in mysql shell `create user 'jecc'@'%' identified by 'ccej';`
- `grant all privileges on *.* to 'jecc'@'%' identified by 'ccej' with grant option;`
- You can use MySQL Workbench as mysql client
- goto [link][http://jecc.ma.web/suivi/prepare-the-database.php] in order to setup the database
- `chmod 700 /vagrant/suivi/prepare-the-database.php` to prevent further access to this file.

## Testing

Goto this [link][http://jecc.ma.web]

you should have it functionning ...

