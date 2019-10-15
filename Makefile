APP_NAME ?= QMap
APP_PLATFORM ?= NodeJS
BUILD_ID ?= $(shell git rev-parse --short HEAD)
SSH_HOST ?= mars.cs.qc.cuny.edu
SSH_USER ?= dmap

ssh-ok:
	sudo sed -i "20i\ForwardAgent yes" /etc/ssh/ssh_config && \
	sudo sed -i "35i\StrictHostKeyChecking no" /etc/ssh/ssh_config && \
	sudo apt-get install -y sshpass

get-code:
	@sshpass -p ${SSH_PASS} ssh ${SSH_USER}@${SSH_HOST} "cd qmap-frontend; git pull"

update-frontend:
	@sshpass -p ${SSH_PASS} ssh ${SSH_USER}@${SSH_HOST} "rm -r public_html"
	@sshpass -p ${SSH_PASS} ssh ${SSH_USER}@${SSH_HOST} "mkdir public_html"
	@sshpass -p ${SSH_PASS} ssh ${SSH_USER}@${SSH_HOST} "cp -r qmap-frontend/* public_html/"	

repair-permissions:
	@sshpass -p ${SSH_PASS} ssh ${SSH_USER}@${SSH_HOST} "chmod 703 public_html"
	@sshpass -p ${SSH_PASS} ssh ${SSH_USER}@${SSH_HOST} "bash -c 'chmod -R 604 public_html/*'"
