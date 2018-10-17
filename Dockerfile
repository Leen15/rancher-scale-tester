FROM leen15/apache-php

MAINTAINER Luca Mattivi <luca@smartdomotik.com>

RUN apt-get update && apt-get install -yqq php-curl

COPY . /var/www/public/

# Port to expose
EXPOSE 80


# Remove pre-existent apache pid and start apache
CMD rm -f $APACHE_PID_FILE && /usr/sbin/apache2ctl -D FOREGROUND