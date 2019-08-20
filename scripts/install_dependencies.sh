#!/bin/bash
if ! [ -x "$(command -v httpd)" ]; then sudo yum amazon-linux-extras install -y httpd php7.2 mysql56-server >&2;   exit 1; fi # install apache if not already installed
