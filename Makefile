APP_NAME ?= QMap
APP_PLATFORM ?= NodeJS
BUILD_ID ?= $(shell git rev-parse --short HEAD)
SSH_HOST ?= mars.cs.qc.cuny.edu
SSH_USER ?= dmap

ssh-ok:
	sed -i "20i\ForwardAgent yes" /etc/ssh/ssh_config && \
	sed -i "35i\StrictHostKeyChecking no" /etc/ssh/ssh_config

get-code:
	ssh ${SSH_USER}@${SSH_HOST} "cd qmap-frontend; git pull"

update-frontend:
	ssh ${SSH_USER}@${SSH_HOST} "rm -r public_html/*"
	ssh ${SSH_USER}@${SSH_HOST} "cp -r qmap-frontend/* public_html/"	

repair-permissions:
	ssh ${SSH_USER}@${SSH_HOST} "chmod -R 754 public_html/*"
