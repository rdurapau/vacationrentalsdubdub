# sweetspot
SweetSpot dev environment.



certbot certonly \
    --manual \
    --preferred-challenges=dns \
    --email anthonybudd94@gmail.com \
    --config-dir . \
    --work-dir . \
    -d vrww.app





root@vrww:/ssl/live/vrww.app# ls
README  cert.pem  chain.pem  fullchain.pem  privkey.pem

/ssl/live/vrww.app/


     - Congratulations! Your certificate and chain have been saved at:
   /tmp/cert/live/vrww.app/fullchain.pem
   Your key file has been saved at:
   /tmp/cert/live/vrww.app/privkey.pem
   Your cert will expire on 2020-03-20. To obtain a new or tweaked
   version of this certificate in the future, simply run certbot
   again. To non-interactively renew *all* of your certificates, run
   "certbot renew"
 - Your account credentials have been saved in your Certbot
   configuration directory at /tmp/cert. You should make a secure
   backup of this folder now. This configuration directory will also
   contain certificates and private keys obtained by Certbot so making
   regular backups of this folder is ideal.
 - If you like Certbot, please consider supporting our work by: