#!/bin/sh
# Start Script
rigctld -m 3081 -r /tmp/radios/IC-9700 -s 19200 -t 9700&
rigctld -m 3070 -r /tmp/radios/IC-7100 -s 19200 -t 7100&
rigctld -m 3073 -r /tmp/radios/IC-7300 -s 19200 -t 7300& 
