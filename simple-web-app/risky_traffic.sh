# Generate traffic towards risky websites.
# Uses a feed from openphish.com.
# This script will run for 24 hours, so create a
# cron job to run every day.
#
# Venky Raju
# ColorTokens Inc.
#
#!/bin/bash

# Download the latest feed.
curl https://openphish.com/feed.txt --output feed.txt

# Calculate sleep interval as 24 hours / number of URLs
count=$(wc -l feed.txt | xargs | cut -d ' ' -f1)
let interval=(24*3600/$count)

# Connect to each URL in the feed list and pause in between.
while read -r line
do
   curl $line > /dev/null 2>&1
   sleep $interval
done < "feed.txt"
