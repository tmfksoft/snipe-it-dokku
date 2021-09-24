# Version 5.2.0
FROM snipe/snipe-it@sha256:92214baa5168a6e838e53a63324dfd3bde9ba0a9b1d9d27b5426ce7f1f69c7ed

# Copy in our custom startup script
COPY dokku-startup.sh /dokku-startup.sh
RUN chmod +x /dokku-startup.sh

# Copy in our PHP Startup Script
COPY startup.php /var/www/html

# Remove Procfile
RUN rm Procfile

CMD ["/dokku-startup.sh"]