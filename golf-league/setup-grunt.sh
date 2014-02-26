#!/bin/bash

#
# This script assumes that you have npm already installed. If you do not, please see
# http://nodejs.org/ to install npm
#
# This script does not install the grunt-cli. If you don't have it, you can install it
# by running the following command
#    npm install -g grunt-cli
# That will install it globally so that you never have to do it again.
#

# first, let's make sure the path is set correctly
export PATH=$PATH:/opt/node/bin:/opt/node/lib/node_modules/grunt-cli/bin

# switch to the directory of this script
cd ${0%/*}

# install all of the dependencies defined in package.json
npm install

# now, let's build the project
grunt
