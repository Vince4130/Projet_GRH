#!/bin/bash

sed -i "s/^/#/g" .htaccess

systemctl restart httpd

