# WP-nginx-config
Basic Nginx + WordPress setup

It is compiled from our production setup.

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

