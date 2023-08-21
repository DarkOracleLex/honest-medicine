FROM node:20.5.1-alpine

WORKDIR /var/www

# Install dependencies
RUN apk update && apk add --no-cache \
    zip \
    unzip \
    curl

# Change current user
USER node

EXPOSE 8000

# https://github.com/vitejs/vite/discussions/3396
CMD ["sh", "-c", "npm install && npm run host"]