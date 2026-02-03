#!/bin/sh

set -e

# Wait for MySQL to be ready
until nc -z mysql 3306; do
  echo "Waiting for MySQL..."
  sleep 1
done

# Wait for Redis to be ready
until nc -z redis 6379; do
  echo "Waiting for Redis..."
  sleep 1
done

exec "$@"
