# Docker BLOG SPA API

## Summary

| Project             | PHP     | MySQL   | NGINX         |
|---------------------|---------|---------|---------------|
| blog-spa-api  | 7.3.6   | 8.0     | nginx:latest  |


## Setup configuration files

1) Update host machine's hosts file

```
echo "::1 localhost blog-spa-api.com" | sudo tee -a /etc/hosts
echo "127.0.0.1 localhost blog-spa-api.com" | sudo tee -a /etc/hosts
```

2) Change to your project directory
```
cd ~/blog-spa-api/
```

3) Configure the project's env file

```
cp .env.dist .env
```

You have to manually update paths to the projects if you did not clone the projects into ~/blog-spa-api.


**Note**: TZ (timezone) can be obtained as follows. Update .env:

```
sudo systemsetup -gettimezone | awk '{print $3}'
```

## Running the server
1) Build base images
2) Build server containers

```
cd ~/blog-spa-api/
docker-compose up -d --build
```

## Access on browser
* [http: blog-spa-api.com](http://blog-spa-api.com:8882)


## Access mysql service
**Note** Credentials are found in env file
```
docker exec -it blogspa_mysql bash
mysql -u root -h blogspa_mysql -p
```

## NGINX logs
```
docker exec -it blogspa_nginx bash
cd /var/log/nginx/
```