#!/usr/bin/env sh

# Add a recent Node repo
curl -sL https://deb.nodesource.com/setup_4.x | sudo -E bash -

apt install nodejs

# Tools to run API tests
npm install -g jasmine-node
npm install --no-bin-links frisby
