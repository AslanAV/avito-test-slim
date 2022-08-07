# Avito-test-slim

[Github README.md](https://github.com/avito-tech/job-backend-trainee-assignment)

## Api-routes
### Operation with balance
```
/{user1}/{operation}/{count}
```
user1 - userId

operation - **add** or **writeOf**

count - count

example request
```injectablephp
POST http://localhost:8080/1/add/20
Content-Type: application/json
```

### show balance
```
/{user1}/show
```
user1 - userId

example request
```injectablephp
GET http://localhost:8080/1/show
Content-Type: application/json
```


## Install the Application

To run the application in development, you can run these commands 

```bash
composer start
```

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser.

Run this command in the application directory to run the test suite

```bash
composer test
```

That's it! Now go build something cool.


