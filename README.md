# WP-nginx-config
Basic Nginx + WordPress setup

It is compiled from our production setup. It is not suitable for Copy&Paste to production use without edits.

# Main features
- extended configuration via "features includes"
- PHP5/PHP7 support
- SSL confing based on "Mozilla SSL Configuration Generator" recommendations
- Let's Encrypt enabled (OCSP Stapling included)
- clientside static resources caching and serverside open files descriptors caching
- gzip compression
- CloudFlare support
- optional GeoIP blocking
- optional Nginx Microcache settings
- optional basic HTTP auth
- Basic & WordPress Security
  - prevent HTTP Poxy
  - prevent Slow Loris (optional)
  - blocking common hacking tools and uncommon HTTP methods
  - usernames harvesting denial
  - blocking access to files with sensitive informaion and VCS systems
  - blocking PHP in uploads directory
  - blocking empty referres into comments, login and ajax
  - blocking suspicious queries (based on iThemes Security blacklist)
  - adding basic security headers

# Extra configs
Look at **extras** folder
- mu-plugins - small mu-plugin for WordPress
  - **Enhancer**
  - enable bcryp hashes for user passwords
  - filter out sensitive user info from rest API
  - change status code of failed logins to 401
  - **Mail Fixer**
  - fix Return-Path header
  - set SMTP server
  - **Team Cookie**
  - allow to exclude web related users from analytics via special cookie
- fail2ban rules - block many 404, block failed logins
- log rotate - log rotate rule for nginx logs
- php-fpm - basic PHP-FPM pool with open-basedir and disable_functions

