#!/bin/bash

if [ -n "$(git status --porcelain)" ]; then
    echo "There are uncommitted changes in working tree"
    echo "Perform git status"
    git status
    echo "Exiting..."
    exit 0
else
    echo "Git working tree is clean"
fi