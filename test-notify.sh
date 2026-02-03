#!/bin/bash

# Test the notify endpoint with curl
# Make sure to set your API_TOKEN in .env file first

curl -X POST http://localhost/api/notify \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer your-secret-token-here" \
  -d '{
    "from": "sender@example.com",
    "to": "recipient@example.com",
    "message": "This is a test notification message"
  }'
