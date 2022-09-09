# Version 6.0.10
FROM snipe/snipe-it@sha256:7535da80d14274826ac7925ee9dd33af575f699e93774425eda6b99c3d67c6b0

# Copy in our custom startup script
COPY dokku-startup.sh /dokku-startup.sh
RUN chmod +x /dokku-startup.sh

# Copy in our PHP Startup Script
COPY startup.php /var/www/html

# Remove Procfile
RUN rm Procfile

CMD ["/dokku-startup.sh"]