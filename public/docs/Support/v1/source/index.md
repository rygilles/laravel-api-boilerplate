---
title: emsearch

language_tabs:
- bash
- javascript

includes:
- errors

search: true

toc_footers:
---
<!-- START_INFO -->
#Support Api Documentation

Welcome to the <b>emsearch</b> API reference.

##Authentication

<b>emsearch</b> API use [OAuth2](https://oauth.net/2/) authentication.

Try out our API with this [postman collection](collection.json)
<aside class="notice">Don't forget to provide a personal authentication token header for every request, like this : <code>Authentication: Bearer xxx</code></aside>

##Pagination

You can specify extra GET parameters with any index / listing routes to request different amount of entries per page and a page number.

| Parameter | Type | Status   | Description              |
|-----------|------|----------|--------------------------|
| page      | int  | optional | Page number              |
| limit     | int  | optional | Maximum entries per page |

<aside class="notice">Minimum / maximum entries limit values can be different according to the route resource complexity.</aside>
<!-- END_INFO -->


#DataStream
<!-- START_087b800e384b5eb8fe1cdf0329840008 -->
## Show data stream list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/dataStream",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project Data Stream",
            "feed_url": "http:\/\/domain.tld\/feedJohn.json",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project Data Stream",
            "feed_url": "http:\/\/domain.tld\/feedTheMouse.json",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        }
    ],
    "meta": {
        "pagination": {
            "total": 2,
            "count": 2,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/dataStream`

`HEAD /api/dataStream`


<!-- END_087b800e384b5eb8fe1cdf0329840008 -->

<!-- START_2637aedf610876a9acf882cb69dc2520 -->
## Get specified data stream

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "605d712c-1934-11e7-93ae-92361f002671",
        "name": "Mickey Mouse Sample Project Data Stream",
        "feed_url": "http:\/\/domain.tld\/feedTheMouse.json",
        "created_at": "2017-04-25 09:29:00",
        "updated_at": "2017-04-25 09:29:00"
    }
}
```

### HTTP Request
`GET /api/dataStream/{dataStreamId}`

`HEAD /api/dataStream/{dataStreamId}`


<!-- END_2637aedf610876a9acf882cb69dc2520 -->

<!-- START_9806e6f48b29aa520cbf710b72b4fa3e -->
## Create and store new data stream

Only one data stream per project is allowed.

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Minus id sunt" \
    -d "feed_url"="http://lesch.com/aut-qui-eum-blanditiis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/dataStream",
    "method": "POST",
    "data": {
        "name": "Minus id sunt",
        "feed_url": "http:\/\/lesch.com\/aut-qui-eum-blanditiis"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/dataStream`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_9806e6f48b29aa520cbf710b72b4fa3e -->

<!-- START_87948eda1c008b091811da4bfc7cd218 -->
## Update a data stream

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Nihil consequatur distinctio" \
    -d "feed_url"="http://www.wunsch.com/" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "name": "Nihil consequatur distinctio",
        "feed_url": "http:\/\/www.wunsch.com\/"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/dataStream/{dataStreamId}`

`PATCH /api/dataStream/{dataStreamId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_87948eda1c008b091811da4bfc7cd218 -->

<!-- START_0402b256ba5cab23aa735079addbfe3e -->
## Delete specified data stream

> Example request:

```bash
curl -X DELETE "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
    "method": "DELETE",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE /api/dataStream/{dataStreamId}`


<!-- END_0402b256ba5cab23aa735079addbfe3e -->

<!-- START_3867fe1670caea34cb239f0f926ad768 -->
## Show project data stream

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "56278dc8-1934-11e7-93ae-92361f002671",
        "name": "John Smith Sample Project Data Stream",
        "feed_url": "http:\/\/domain.tld\/feedJohn.json",
        "created_at": "2017-04-25 09:29:00",
        "updated_at": "2017-04-25 09:29:00"
    }
}
```

### HTTP Request
`GET /api/project/{projectId}/dataStream`

`HEAD /api/project/{projectId}/dataStream`


<!-- END_3867fe1670caea34cb239f0f926ad768 -->

<!-- START_41e37bb4ea451c1a5a85f3a3b34c6589 -->
## Create and store the project data stream

Only one data stream per project is allowed.

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Omnis neque laboriosam" \
    -d "feed_url"="http://crooks.com/quas-ut-pariatur-doloremque-impedit-consequatur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "POST",
    "data": {
        "name": "Omnis neque laboriosam",
        "feed_url": "http:\/\/crooks.com\/quas-ut-pariatur-doloremque-impedit-consequatur"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/project/{projectId}/dataStream`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_41e37bb4ea451c1a5a85f3a3b34c6589 -->

<!-- START_b3bd4bcca43f451aebf51006a642ad0c -->
## Update the project data stream

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Dolore et aut" \
    -d "feed_url"="https://collins.com/sed-quo-soluta-et-animi.html" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "PUT",
    "data": {
        "name": "Dolore et aut",
        "feed_url": "https:\/\/collins.com\/sed-quo-soluta-et-animi.html"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/project/{projectId}/dataStream`

`PATCH /api/project/{projectId}/dataStream`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_b3bd4bcca43f451aebf51006a642ad0c -->

<!-- START_820f0f614fb757aec7e225d86da8b40d -->
## Delete the project data stream

> Example request:

```bash
curl -X DELETE "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "DELETE",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE /api/project/{projectId}/dataStream`


<!-- END_820f0f614fb757aec7e225d86da8b40d -->

#I18nLang
<!-- START_e1171537de1a9b8e9dfbd90e9ef7c13f -->
## Show i18n lang list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/i18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "af",
            "description": "Afrikaans"
        },
        {
            "id": "af_NA",
            "description": "Afrikaans (Namibia)"
        },
        {
            "id": "af_ZA",
            "description": "Afrikaans (South Africa)"
        },
        {
            "id": "ak",
            "description": "Akan"
        },
        {
            "id": "ak_GH",
            "description": "Akan (Ghana)"
        },
        {
            "id": "am",
            "description": "Amharic"
        },
        {
            "id": "am_ET",
            "description": "Amharic (Ethiopia)"
        },
        {
            "id": "ar",
            "description": "Arabic"
        },
        {
            "id": "ar_AE",
            "description": "Arabic (United Arab Emirates)"
        },
        {
            "id": "ar_BH",
            "description": "Arabic (Bahrain)"
        }
    ],
    "meta": {
        "pagination": {
            "total": 434,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 44,
            "links": {
                "next": "http:\/\/emsearch.ryan.ems-dev.net\/api\/i18nLang?page=2"
            }
        }
    }
}
```

### HTTP Request
`GET /api/i18nLang`

`HEAD /api/i18nLang`


<!-- END_e1171537de1a9b8e9dfbd90e9ef7c13f -->

<!-- START_8bf32d4b41c09d1d9801aff1b0737349 -->
## Get specified i18n lang

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "en_US",
        "description": "English (United States)"
    }
}
```

### HTTP Request
`GET /api/i18nLang/{i18nLangId}`

`HEAD /api/i18nLang/{i18nLangId}`


<!-- END_8bf32d4b41c09d1d9801aff1b0737349 -->

#Me
<!-- START_01138559f486b5b7c062a19b1c0412fe -->
## Get current user

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/me" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/me",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "41abdec2-1389-11e7-93ae-92361f002671",
        "user_group_id": "Developer",
        "name": "John Doe",
        "email": "john.doe@domain.tld",
        "created_at": "2017-04-25 09:29:00",
        "updated_at": "2017-04-25 09:29:00"
    }
}
```

### HTTP Request
`GET /api/me`

`HEAD /api/me`


<!-- END_01138559f486b5b7c062a19b1c0412fe -->

#Notification
<!-- START_82a4705cdd5337b4ffe285b4941e2a89 -->
## Current user notification list

You can specify a GET parameter `read_status` to filter results.
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/me/notification?read_status=read" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/me/notification?read_status=read",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [],
    "meta": {
        "pagination": {
            "total": 0,
            "count": 0,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 0,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/me/notification`

`HEAD /api/me/notification`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    read_status | string |  optional  | `read` or `unread`

<!-- END_82a4705cdd5337b4ffe285b4941e2a89 -->

<!-- START_7283d47a827c2bd35bc4e35536395d43 -->
## Mark the specified user notification as read

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/read" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/read",
    "method": "POST",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/me/notification/{notificationId}/read`


<!-- END_7283d47a827c2bd35bc4e35536395d43 -->

<!-- START_2f58084f3aec9f10d264a9d085af79ff -->
## Mark the specified user notification as unread

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/unread" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/unread",
    "method": "POST",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/me/notification/{notificationId}/unread`


<!-- END_2f58084f3aec9f10d264a9d085af79ff -->

#Project
<!-- START_5951e28de2699182212669b38146cae2 -->
## Current user project list

You can specify a GET parameter `user_role_id` to filter results.
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/me/project?user_role_id=Owner" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/me/project?user_role_id=Owner",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [],
    "meta": {
        "pagination": {
            "total": 0,
            "count": 0,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 0,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/me/project`

`HEAD /api/me/project`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_role_id | string |  optional  | Valid user_role id `Owner` or `Administrator`

<!-- END_5951e28de2699182212669b38146cae2 -->

<!-- START_aa8a35d90f07e0338dcd98a913a63c76 -->
## User project list

You can specify a GET parameter `user_role_id` to filter results.
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project?user_role_id=Owner" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project?user_role_id=Owner",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project 1",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        }
    ],
    "meta": {
        "pagination": {
            "total": 3,
            "count": 3,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/user/{userId}/project`

`HEAD /api/user/{userId}/project`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_role_id | string |  optional  | Valid user_role id `Owner` or `Administrator`

<!-- END_aa8a35d90f07e0338dcd98a913a63c76 -->

<!-- START_0244828c4ebed3e3aa5d2acc7f432f35 -->
## Project list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/project" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project 1",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        }
    ],
    "meta": {
        "pagination": {
            "total": 3,
            "count": 3,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/project`

`HEAD /api/project`


<!-- END_0244828c4ebed3e3aa5d2acc7f432f35 -->

<!-- START_4c7672d1d57bba818fcb5bc7dc53776e -->
## Get specified project

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "1bcc7efc-138c-11e7-93ae-92361f002671",
        "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
        "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
        "name": "John Smith Sample Project 1",
        "created_at": "2017-04-25 09:29:00",
        "updated_at": "2017-04-25 09:29:00"
    }
}
```

### HTTP Request
`GET /api/project/{projectId}`

`HEAD /api/project/{projectId}`


<!-- END_4c7672d1d57bba818fcb5bc7dc53776e -->

<!-- START_f77a6ccd588d420cab2180c05580e7ef -->
## Create and store new project

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/project" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_engine_id"="0a84f7c6-774f-3e57-b349-d9a26bef7745" \
    -d "data_stream_id"="77585fa9-224f-3433-95f3-38d209fc086c" \
    -d "name"="Quia officiis occaecati" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "search_engine_id": "0a84f7c6-774f-3e57-b349-d9a26bef7745",
        "data_stream_id": "77585fa9-224f-3433-95f3-38d209fc086c",
        "name": "Quia officiis occaecati"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/project`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_engine_id | string |  required  | UUID Valid search_engine id
    data_stream_id | string |  optional  | UUID Valid data_stream id
    name | string |  required  | Minimum: `5` Maximum: `100`

<!-- END_f77a6ccd588d420cab2180c05580e7ef -->

<!-- START_3ab7c7860cd533c91de466d299bc9cff -->
## Update a specified project

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_engine_id"="1dcd591e-ac55-3a75-9b0e-d5b9719f4a83" \
    -d "data_stream_id"="0f9b13f8-1c5e-3458-81dc-ae2bc7fb0275" \
    -d "name"="Ratione laboriosam facilis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "search_engine_id": "1dcd591e-ac55-3a75-9b0e-d5b9719f4a83",
        "data_stream_id": "0f9b13f8-1c5e-3458-81dc-ae2bc7fb0275",
        "name": "Ratione laboriosam facilis"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/project/{projectId}`

`PATCH /api/project/{projectId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_engine_id | string |  required  | UUID Valid search_engine id
    data_stream_id | string |  optional  | UUID Valid data_stream id
    name | string |  required  | Minimum: `5` Maximum: `100`

<!-- END_3ab7c7860cd533c91de466d299bc9cff -->

<!-- START_9e2aafbf3cd214246c2f0fe7511ec6ea -->
## Delete specified project

All relationships between the project and his users will be automatically deleted too.<br />
The project sync items will be automatically deleted too.<br />
The project data stream will be automatically deleted too, if exists.
<aside class="notice">Only <code>Owner</code> of project is allowed to delete it.</aside>

> Example request:

```bash
curl -X DELETE "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "DELETE",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE /api/project/{projectId}`


<!-- END_9e2aafbf3cd214246c2f0fe7511ec6ea -->

<!-- START_5422def9f3ee3793fdd3b81ad0bce1b0 -->
## Search engine project list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671/project" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671/project",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project 1",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        }
    ],
    "meta": {
        "pagination": {
            "total": 3,
            "count": 3,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/searchEngine/{searchEngineId}/project`

`HEAD /api/searchEngine/{searchEngineId}/project`


<!-- END_5422def9f3ee3793fdd3b81ad0bce1b0 -->

#SearchEngine
<!-- START_4782f8649a902914ec1963f2a78da258 -->
## Show search engine list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/searchEngine" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "name": "Algolia",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        }
    ],
    "meta": {
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/searchEngine`

`HEAD /api/searchEngine`


<!-- END_4782f8649a902914ec1963f2a78da258 -->

<!-- START_2722bd2e446fc75e00b2f6449ed3d886 -->
## Get specified search engine

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "ee87e3b2-1388-11e7-93ae-92361f002671",
        "name": "Algolia",
        "created_at": "2017-04-25 09:28:58",
        "updated_at": "2017-04-25 09:28:58"
    }
}
```

### HTTP Request
`GET /api/searchEngine/{searchEngineId}`

`HEAD /api/searchEngine/{searchEngineId}`


<!-- END_2722bd2e446fc75e00b2f6449ed3d886 -->

#SyncItem
<!-- START_bfc41d85f90ecc0fcd7613be812fb092 -->
## Sync item list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncItem" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncItem",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "item_id": "a37eda90-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "f56a6607aee20f0dab169820bda38706",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "b06e221a-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "d66e8b5e5d17933bdcaf5a03f614e007",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "c07d179c-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "52864717b0abe4851b74bed750df0144",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "d1040d28-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "098de3bc3c69ad3e027d9fefc44fa7a5",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "e6b018e2-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "a18513691f0d1c2a8e3f3ae0c0b8260c",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        }
    ],
    "meta": {
        "pagination": {
            "total": 5,
            "count": 5,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/syncItem`

`HEAD /api/syncItem`


<!-- END_bfc41d85f90ecc0fcd7613be812fb092 -->

<!-- START_7f0ee008d31d890ef106fa3127e34832 -->
## Get specified sync item

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "item_id": "a37eda90-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "f56a6607aee20f0dab169820bda38706",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        }
    ]
}
```

### HTTP Request
`GET /api/syncItem/{syncItemId},{projectId}`

`HEAD /api/syncItem/{syncItemId},{projectId}`


<!-- END_7f0ee008d31d890ef106fa3127e34832 -->

<!-- START_6dc95e6a9c747452ea9b21a9e5cbcbee -->
## Project sync item list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncItem" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncItem",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "item_id": "a37eda90-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "f56a6607aee20f0dab169820bda38706",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "b06e221a-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "d66e8b5e5d17933bdcaf5a03f614e007",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "c07d179c-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "52864717b0abe4851b74bed750df0144",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "d1040d28-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "098de3bc3c69ad3e027d9fefc44fa7a5",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "item_id": "e6b018e2-1f56-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "a18513691f0d1c2a8e3f3ae0c0b8260c",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        }
    ],
    "meta": {
        "pagination": {
            "total": 5,
            "count": 5,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/project/{projectId}/syncItem`

`HEAD /api/project/{projectId}/syncItem`


<!-- END_6dc95e6a9c747452ea9b21a9e5cbcbee -->

#SyncTask
<!-- START_2978e0998f660697ab1a780503cb443f -->
## Sync task list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTask" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTask",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_id": null,
            "sync_task_type_id": "Main",
            "sync_task_status_id": "InProgress",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "id": "91bf2f58-2055-11e7-93ae-92361f002671",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamDownload",
            "sync_task_status_id": "InProgress",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        }
    ],
    "meta": {
        "pagination": {
            "total": 2,
            "count": 2,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/syncTask`

`HEAD /api/syncTask`


<!-- END_2978e0998f660697ab1a780503cb443f -->

<!-- START_f9f5013ec23ba437ac7ebb90bcde561a -->
## Get specified sync task

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
        "sync_task_id": null,
        "sync_task_type_id": "Main",
        "sync_task_status_id": "InProgress",
        "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
        "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
        "created_at": "2017-04-25 09:29:01",
        "updated_at": "2017-04-25 09:29:01"
    }
}
```

### HTTP Request
`GET /api/syncTask/{syncTaskId}`

`HEAD /api/syncTask/{syncTaskId}`


<!-- END_f9f5013ec23ba437ac7ebb90bcde561a -->

<!-- START_8151bc8465cc13065e561f4910642cfc -->
## Project sync task list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncTask" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncTask",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_id": null,
            "sync_task_type_id": "Main",
            "sync_task_status_id": "InProgress",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "id": "91bf2f58-2055-11e7-93ae-92361f002671",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamDownload",
            "sync_task_status_id": "InProgress",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        }
    ],
    "meta": {
        "pagination": {
            "total": 2,
            "count": 2,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/project/{projectId}/syncTask`

`HEAD /api/project/{projectId}/syncTask`


<!-- END_8151bc8465cc13065e561f4910642cfc -->

#SyncTaskLog
<!-- START_e7e309913cf8d9268290f526607d5647 -->
## Sync task sync task logs list

You can specify a GET parameter `public` to filter results (Only allowed for `Developer` and `Support` users).
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/log?public=1" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/log?public=1",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "bfbf48da-210d-11e7-93ae-92361f002671",
            "sync_task_status_id": "Planned",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Synchronization planned.",
            "public": "1",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "id": "c8fd9a1e-210d-11e7-93ae-92361f002671",
            "sync_task_status_id": "InProgress",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Synchronization in progress.",
            "public": "1",
            "created_at": "2017-04-25 09:29:03",
            "updated_at": "2017-04-25 09:29:03"
        }
    ],
    "meta": {
        "pagination": {
            "total": 2,
            "count": 2,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/syncTask/{syncTaskId}/log`

`HEAD /api/syncTask/{syncTaskId}/log`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    public | boolean |  optional  | 

<!-- END_e7e309913cf8d9268290f526607d5647 -->

#SyncTaskStatus
<!-- START_4717d42cd5763bf3c418a96430240035 -->
## Show sync task status list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskStatus" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskStatus",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "Complete"
        },
        {
            "id": "InProgress"
        },
        {
            "id": "Planned"
        }
    ],
    "meta": {
        "pagination": {
            "total": 3,
            "count": 3,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/syncTaskStatus`

`HEAD /api/syncTaskStatus`


<!-- END_4717d42cd5763bf3c418a96430240035 -->

<!-- START_ef5bd46c31f4520ae31c481e3881f393 -->
## Get specified sync task status

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "Planned"
    }
}
```

### HTTP Request
`GET /api/syncTaskStatus/{syncTaskStatusId}`

`HEAD /api/syncTaskStatus/{syncTaskStatusId}`


<!-- END_ef5bd46c31f4520ae31c481e3881f393 -->

#SyncTaskStatusVersion
<!-- START_20fd565a8f7cfe7eee960e158fcbbe29 -->
## Sync task status version item list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "sync_task_status_id": "Complete",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is complete.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_status_id": "Complete",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est terminée",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is in progress.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est en cours.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is planned.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        }
    ],
    "meta": {
        "pagination": {
            "total": 6,
            "count": 6,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/syncTaskStatusVersion`

`HEAD /api/syncTaskStatusVersion`


<!-- END_20fd565a8f7cfe7eee960e158fcbbe29 -->

<!-- START_3154293d7e3ad8c7b20f143c3d0e5151 -->
## Get specified sync task status version

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is planned.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        }
    ]
}
```

### HTTP Request
`GET /api/syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}`

`HEAD /api/syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}`


<!-- END_3154293d7e3ad8c7b20f143c3d0e5151 -->

<!-- START_f8d52ae3047e3b3b55a78f36e855095e -->
## Create and store new sync task status version

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_status_id"="Architecto quis eum" \
    -d "i18n_lang_id"="Ut molestiae error" \
    -d "description"="Reiciendis dolorem consequatur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion",
    "method": "POST",
    "data": {
        "sync_task_status_id": "Architecto quis eum",
        "i18n_lang_id": "Ut molestiae error",
        "description": "Reiciendis dolorem consequatur"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/syncTaskStatusVersion`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sync_task_status_id | string |  required  | Maximum: `50` Valid sync_task_status id
    i18n_lang_id | string |  required  | Maximum: `30` Valid i18n_lang id
    description | string |  required  | 

<!-- END_f8d52ae3047e3b3b55a78f36e855095e -->

<!-- START_30fd948e95f773b1dd1c9fb6a441f419 -->
## Update a specified sync task status version

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_status_id"="Vitae doloremque accusantium" \
    -d "i18n_lang_id"="Quidem assumenda voluptatem" \
    -d "description"="Et quod beatae" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US",
    "method": "PUT",
    "data": {
        "sync_task_status_id": "Vitae doloremque accusantium",
        "i18n_lang_id": "Quidem assumenda voluptatem",
        "description": "Et quod beatae"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}`

`PATCH /api/syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sync_task_status_id | string |  required  | Maximum: `50` Valid sync_task_status id
    i18n_lang_id | string |  required  | Maximum: `30` Valid i18n_lang id
    description | string |  required  | 

<!-- END_30fd948e95f773b1dd1c9fb6a441f419 -->

<!-- START_13b4f9936bf59c1205310a48e4965fa2 -->
## Sync task status sync task status versions list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned/version" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned/version",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is planned.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        }
    ],
    "meta": {
        "pagination": {
            "total": 2,
            "count": 2,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/syncTaskStatus/{syncTaskStatusId}/version`

`HEAD /api/syncTaskStatus/{syncTaskStatusId}/version`


<!-- END_13b4f9936bf59c1205310a48e4965fa2 -->

#SyncTaskType
<!-- START_a869c8fb18f078796b83ed04a7f1d327 -->
## Show sync task type list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskType" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskType",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "DataStreamCheck"
        },
        {
            "id": "DataStreamDownload"
        },
        {
            "id": "DataStreamPrepare"
        },
        {
            "id": "ItemsDelete"
        },
        {
            "id": "ItemsInsertion"
        },
        {
            "id": "ItemsUpdate"
        },
        {
            "id": "Main"
        }
    ],
    "meta": {
        "pagination": {
            "total": 7,
            "count": 7,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/syncTaskType`

`HEAD /api/syncTaskType`


<!-- END_a869c8fb18f078796b83ed04a7f1d327 -->

<!-- START_3f3f80bcc247d7b44b856a9cd57ceb0a -->
## Get specified sync task type

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskType/Main" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskType/Main",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "Main"
    }
}
```

### HTTP Request
`GET /api/syncTaskType/{syncTaskTypeId}`

`HEAD /api/syncTaskType/{syncTaskTypeId}`


<!-- END_3f3f80bcc247d7b44b856a9cd57ceb0a -->

#SyncTaskTypeVersion
<!-- START_9a01498af6c604afdba7cca1c3a04ce5 -->
## Sync task type version item list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "sync_task_type_id": "DataStreamCheck",
            "i18n_lang_id": "en_US",
            "description": "Comparison and verification of downloaded data.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "DataStreamCheck",
            "i18n_lang_id": "fr_FR",
            "description": "Comparaison et vérification des données téléchargées.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "fr_FR",
            "description": "Téléchargement des données fournies par l'url du flux de données.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "fr_FR",
            "description": "Ventilation des données pour la création, modification ou suppression.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "fr_FR",
            "description": "Suppression d'enregistrements.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "fr_FR",
            "description": "Création des nouveaux enregistrements.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        }
    ],
    "meta": {
        "pagination": {
            "total": 14,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 2,
            "links": {
                "next": "http:\/\/emsearch.ryan.ems-dev.net\/api\/syncTaskTypeVersion?page=2"
            }
        }
    }
}
```

### HTTP Request
`GET /api/syncTaskTypeVersion`

`HEAD /api/syncTaskTypeVersion`


<!-- END_9a01498af6c604afdba7cca1c3a04ce5 -->

<!-- START_94297c423be097f34970c23692babbec -->
## Get specified sync task type version

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "sync_task_type_id": "Main",
            "i18n_lang_id": "en_US",
            "description": "Main task who rules and manage subtasks.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        }
    ]
}
```

### HTTP Request
`GET /api/syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}`

`HEAD /api/syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}`


<!-- END_94297c423be097f34970c23692babbec -->

<!-- START_751ccfe3854931840964b8a085df46a8 -->
## Create and store new sync task type version

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_type_id"="Quaerat magnam nesciunt" \
    -d "i18n_lang_id"="Pariatur illo laborum" \
    -d "description"="Esse quidem aut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion",
    "method": "POST",
    "data": {
        "sync_task_type_id": "Quaerat magnam nesciunt",
        "i18n_lang_id": "Pariatur illo laborum",
        "description": "Esse quidem aut"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/syncTaskTypeVersion`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sync_task_type_id | string |  required  | Maximum: `50` Valid sync_task_type id
    i18n_lang_id | string |  required  | Maximum: `30` Valid i18n_lang id
    description | string |  required  | 

<!-- END_751ccfe3854931840964b8a085df46a8 -->

<!-- START_77ba68f936c675f0d8693d691bd4c420 -->
## Update a specified sync task type version

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_type_id"="Dolorem aliquid distinctio" \
    -d "i18n_lang_id"="Quo quia enim" \
    -d "description"="Et beatae quasi" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US",
    "method": "PUT",
    "data": {
        "sync_task_type_id": "Dolorem aliquid distinctio",
        "i18n_lang_id": "Quo quia enim",
        "description": "Et beatae quasi"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}`

`PATCH /api/syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sync_task_type_id | string |  required  | Maximum: `50` Valid sync_task_type id
    i18n_lang_id | string |  required  | Maximum: `30` Valid i18n_lang id
    description | string |  required  | 

<!-- END_77ba68f936c675f0d8693d691bd4c420 -->

<!-- START_23d45485a9001240593300c466ec2b0c -->
## I18n lang sync task type versions list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US/syncTaskTypeVersion",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "sync_task_type_id": "DataStreamCheck",
            "i18n_lang_id": "en_US",
            "description": "Comparison and verification of downloaded data.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "ItemsUpdate",
            "i18n_lang_id": "en_US",
            "description": "Updating records.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        },
        {
            "sync_task_type_id": "Main",
            "i18n_lang_id": "en_US",
            "description": "Main task who rules and manage subtasks.",
            "created_at": "2017-04-25 09:28:58",
            "updated_at": "2017-04-25 09:28:58"
        }
    ],
    "meta": {
        "pagination": {
            "total": 7,
            "count": 7,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/i18nLang/{i18nLangId}/syncTaskTypeVersion`

`HEAD /api/i18nLang/{i18nLangId}/syncTaskTypeVersion`


<!-- END_23d45485a9001240593300c466ec2b0c -->

#User
<!-- START_79bbe09b8f53b0948351390dffb959af -->
## User list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/user" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "id": "41abdec2-1389-11e7-93ae-92361f002671",
            "user_group_id": "Developer",
            "name": "John Doe",
            "email": "john.doe@domain.tld",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "509dd5c0-1389-11e7-93ae-92361f002671",
            "user_group_id": "Support",
            "name": "Alan Smithee",
            "email": "alan.smithee@domain.tld",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "605c7610-1389-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "John Smith",
            "email": "john.smith@domain.tld",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        }
    ],
    "meta": {
        "pagination": {
            "total": 4,
            "count": 4,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/user`

`HEAD /api/user`


<!-- END_79bbe09b8f53b0948351390dffb959af -->

<!-- START_e6d1bae0d0740199d7d557e0b0e1d25f -->
## Get specified user

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": {
        "id": "605c7610-1389-11e7-93ae-92361f002671",
        "user_group_id": "End-User",
        "name": "John Smith",
        "email": "john.smith@domain.tld",
        "created_at": "2017-04-25 09:29:00",
        "updated_at": "2017-04-25 09:29:00"
    }
}
```

### HTTP Request
`GET /api/user/{userId}`

`HEAD /api/user/{userId}`


<!-- END_e6d1bae0d0740199d7d557e0b0e1d25f -->

<!-- START_ddfe841311822ba91babd6d2eb588875 -->
## Create and store new user

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/user" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_group_id"="Developer" \
    -d "name"="Et quo voluptas" \
    -d "email"="afarrell@example.com" \
    -d "password"="DA&gt;&quot;cP0" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user",
    "method": "POST",
    "data": {
        "user_group_id": "Developer",
        "name": "Et quo voluptas",
        "email": "afarrell@example.com",
        "password": "DA>\"cP0"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/user`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_group_id | string |  required  | Valid user_group id `Developer`, `Support` or `End-User`
    name | string |  required  | Maximum: `100`
    email | email |  required  | Maximum: `150`
    password | string |  required  | Password with at least: `8` chars, `1` numeric, `1` uppercase and `1` lowercase

<!-- END_ddfe841311822ba91babd6d2eb588875 -->

<!-- START_707699ec45bed549f4600a85f0f86358 -->
## Update a specified user

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_group_id"="Support" \
    -d "name"="Iure harum nobis" \
    -d "email"="austen19@example.net" \
    -d "password"="4%i$e2m&amp;eJa?2w" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_group_id": "Support",
        "name": "Iure harum nobis",
        "email": "austen19@example.net",
        "password": "4%i$e2m&eJa?2w"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/user/{userId}`

`PATCH /api/user/{userId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_group_id | string |  required  | Valid user_group id `Developer`, `Support` or `End-User`
    name | string |  required  | Maximum: `100`
    email | email |  required  | Maximum: `150`
    password | string |  required  | Password with at least: `8` chars, `1` numeric, `1` uppercase and `1` lowercase

<!-- END_707699ec45bed549f4600a85f0f86358 -->

<!-- START_186fff344f72d874e95af874b8843d4e -->
## Delete specified user

All relationships between the user and his projects will be automatically deleted too.<br />
All projects owned by the user will be automatically deleted too.

> Example request:

```bash
curl -X DELETE "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
    "method": "DELETE",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE /api/user/{userId}`


<!-- END_186fff344f72d874e95af874b8843d4e -->

#UserHasProject
<!-- START_cf0313d53939313429ce6788fa95624c -->
## List of relationships between users and projects


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/userHasProject" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-04-25 09:29:01",
            "updated_at": "2017-04-25 09:29:01"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        }
    ],
    "meta": {
        "pagination": {
            "total": 5,
            "count": 5,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 1,
            "links": []
        }
    }
}
```

### HTTP Request
`GET /api/userHasProject`

`HEAD /api/userHasProject`


<!-- END_cf0313d53939313429ce6788fa95624c -->

<!-- START_e2d2b03985c6de501aad3f7ca46704ee -->
## Get specified relationship between a user and a project

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
{
    "data": [
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-25 09:29:00",
            "updated_at": "2017-04-25 09:29:00"
        }
    ]
}
```

### HTTP Request
`GET /api/userHasProject/{userId},{projectId}`

`HEAD /api/userHasProject/{userId},{projectId}`


<!-- END_e2d2b03985c6de501aad3f7ca46704ee -->

<!-- START_dabe60a16184150a559916ed8dc0e3b4 -->
## Create and store new relationship between a user and a project

<aside class="notice">Only one relationship per user/project is allowed and only one user can be <code>Owner</code>of a project.</aside>

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/userHasProject" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_id"="dba70999-bec9-3d5c-abcf-dc819d194d45" \
    -d "project_id"="bbb94ad7-018a-3844-bee5-57e478408589" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject",
    "method": "POST",
    "data": {
        "user_id": "dba70999-bec9-3d5c-abcf-dc819d194d45",
        "project_id": "bbb94ad7-018a-3844-bee5-57e478408589",
        "user_role_id": "Owner"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`POST /api/userHasProject`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | UUID Valid user id
    project_id | string |  required  | UUID Valid project id
    user_role_id | string |  required  | Valid user_role id `Owner` or `Administrator`

<!-- END_dabe60a16184150a559916ed8dc0e3b4 -->

<!-- START_4637e0c2dda7db05925a85154e6d9569 -->
## Update a specified relationship between a user and a project

<aside class="notice">Only one relationship per user/project is allowed and only one user can be <code>Owner</code>of a project.</aside>

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_id"="78c3a49b-bd24-37f1-bb7d-b5477201ed2b" \
    -d "project_id"="5cbe0ff5-621a-37e3-9e42-63b8594e8e2e" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_id": "78c3a49b-bd24-37f1-bb7d-b5477201ed2b",
        "project_id": "5cbe0ff5-621a-37e3-9e42-63b8594e8e2e",
        "user_role_id": "Owner"
},
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`PUT /api/userHasProject/{userId},{projectId}`

`PATCH /api/userHasProject/{userId},{projectId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | string |  required  | UUID Valid user id
    project_id | string |  required  | UUID Valid project id
    user_role_id | string |  required  | Valid user_role id `Owner` or `Administrator`

<!-- END_4637e0c2dda7db05925a85154e6d9569 -->

<!-- START_b81617da55a317875b73c99a2a96f111 -->
## Delete specified relationship between a user and a project

> Example request:

```bash
curl -X DELETE "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "DELETE",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```


### HTTP Request
`DELETE /api/userHasProject/{userId},{projectId}`


<!-- END_b81617da55a317875b73c99a2a96f111 -->

