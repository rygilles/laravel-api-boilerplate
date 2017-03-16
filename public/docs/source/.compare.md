---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://emsearch.ryan.ems-dev.net/docs/collection.json)

<!-- END_INFO -->

#general
<!-- START_01138559f486b5b7c062a19b1c0412fe -->
## Get curent user

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net///api/me" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/me",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/me`

`HEAD /api/me`


<!-- END_01138559f486b5b7c062a19b1c0412fe -->

<!-- START_79bbe09b8f53b0948351390dffb959af -->
## User list

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net///api/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/user",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/user`

`HEAD /api/user`


<!-- END_79bbe09b8f53b0948351390dffb959af -->

<!-- START_ddfe841311822ba91babd6d2eb588875 -->
## Create and store new user

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net///api/user" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/user",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/user`


<!-- END_ddfe841311822ba91babd6d2eb588875 -->

<!-- START_58a7597d78a515df314a48b0125a0b5b -->
## Get specified user

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net///api/user/{user}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/user/{user}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/user/{user}`

`HEAD /api/user/{user}`


<!-- END_58a7597d78a515df314a48b0125a0b5b -->

<!-- START_aa8a35d90f07e0338dcd98a913a63c76 -->
## User project list

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net///api/user/{userId}/project" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/user/{userId}/project",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/user/{userId}/project`

`HEAD /api/user/{userId}/project`


<!-- END_aa8a35d90f07e0338dcd98a913a63c76 -->

<!-- START_28964cc27ab9afa6ce7f99c0bf0dc46b -->
## Get specified user project

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net///api/user/{userId}/project/{projectId}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/user/{userId}/project/{projectId}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/user/{userId}/project/{projectId}`

`HEAD /api/user/{userId}/project/{projectId}`


<!-- END_28964cc27ab9afa6ce7f99c0bf0dc46b -->

<!-- START_0244828c4ebed3e3aa5d2acc7f432f35 -->
## Project list

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net///api/project" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/project",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/project`

`HEAD /api/project`


<!-- END_0244828c4ebed3e3aa5d2acc7f432f35 -->

<!-- START_f77a6ccd588d420cab2180c05580e7ef -->
## Create and store new project

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net///api/project" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/project",
    "method": "POST",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/project`


<!-- END_f77a6ccd588d420cab2180c05580e7ef -->

<!-- START_48295e905557186718bbf92bca1f48e5 -->
## Get specified user project

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net///api/project/{project}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/project/{project}",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET /api/project/{project}`

`HEAD /api/project/{project}`


<!-- END_48295e905557186718bbf92bca1f48e5 -->

<!-- START_4fbe95cf853ec486b09c7dd34f550fea -->
## Update a specified user project

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net///api/project/{project}" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net///api/project/{project}",
    "method": "PUT",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/project/{project}`

`PATCH /api/project/{project}`


<!-- END_4fbe95cf853ec486b09c7dd34f550fea -->

