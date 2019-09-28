from BeautifulSoup import BeautifulSoup as BS
from pathlib import Path
import urllib
import os
import sys

# Description:
# scrape_regions.py scrapes the navwrap, navcol, extracol, pagefooter
# regions of the usgo.org Drupal user page https://www.usgo.org/user or
# the development site https://dev.usgo.org/user.
#
# Python Requirements:
# - beatifulsoup
# - pathlib
#
# Requirements:
# - configured
#   - usgo_drupal_scrape_conf.py in the current directory.
# - AGA_URL
#   - The environment which this script is running.
# - AGA_WRITE_DIR
#   - The directory to which the cached files will be written.
# Cron Usage for usgo.org:
#   Edit the www-data user's cron file with `$ sudo crontab -u www-data -e`.
#   Then add the entry:
#    10,25,40,55 * * * * /usr/bin/python [usgo_theme_includes_directory]/scrape_regions.py

# Check that the config file exists.
usgo_drupal_scrape_config_file = Path("usgo_drupal_scrape_conf.py")

if (not usgo_drupal_scrape_config_file.is_file()):
     print("No usgo_drupal_scrape_conf.py provided.")
     sys.exit()
else:
     import usgo_drupal_scrape_conf

# URL to scrape.
url = usgo_drupal_scrape_conf.AGA_URL

# Directory to write out our cached files.
write_dir = usgo_drupal_scrape_conf.AGA_WRITE_DIR

# Page object of the scraped url.
page = urllib.urlopen(url).read()

# Define the regions to be scraped in a list
div_ids = ['navwrap', 'navcol', 'extracol', 'postfooter']

soup = BS(page)

if write_dir == '':
    write_dir = '.'

# Write out the each region to a [region].cached.html file.
for id in div_ids:
    tree = soup.find('div', id = id)
    if tree != None:
        f = open('%s/%s.cached.html' % (write_dir, id), 'w')
        f.write(tree.renderContents())
        f.close()
