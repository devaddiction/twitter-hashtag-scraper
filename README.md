Twitter Hashtag Scraper
========================
[![Build Status](https://travis-ci.org/devaddiction/twitter-hashtag-scraper.svg?branch=master)](https://travis-ci.org/devaddiction/twitter-hashtag-scraper)
[![Coverage Status](https://coveralls.io/repos/devaddiction/twitter-hashtag-scraper/badge.svg)](https://coveralls.io/r/devaddiction/twitter-hashtag-scraper)

Fetch and display tweets based on a customizable hashtag.

### Features

* Standalone version of the app using Vagrant virtual box.
* Prefetch tweets using an already scheduled cron script.
* Redis cache integrated for a better performance.
* All the tweets are stored in the DB. If the requested tweet is not in Redis, the app will call the Twitter API Rest and store it locally.
* Infinite-loop, fetching new tweets from cache (or API is not present)

### Instructions

* Clone the project.
* [Install vagrant](http://docs.vagrantup.com/v2/installation/) and run vagrant up
* Add to your host file this entry:
    192.168.56.101   twitter-hashtag.test
* Install composer (https://getcomposer.org/doc/00-intro.md#system-requirements)
* Run composer install inside the project's folder
* Register a new TwitterApp (https://apps.twitter.com/) [or use an existing app]
* Copy file config.sample.php into config.sample.php and fill the settings with your credentials
* Check http://twitter-hashtag.test !

### Notes

* All the dependencies (web server, redis, curl ... ) will be installed in Vagrant.
* The cron is already scheduled to fetch new tweets every 5 minutes.
* You can change the hashtag to retrieve from the config file.
