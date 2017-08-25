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
#End-User Api Documentation

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
<!-- START_2637aedf610876a9acf882cb69dc2520 -->
## Get specified data stream

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
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
        "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
        "name": "Mickey Mouse Sample Project Data Stream",
        "feed_url": "https:\/\/www.e-monsite.com\/blog\/do\/datastream\/",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00"
    }
}
```

### HTTP Request
`GET /api/dataStream/{dataStreamId}`

`HEAD /api/dataStream/{dataStreamId}`


<!-- END_2637aedf610876a9acf882cb69dc2520 -->

<!-- START_3867fe1670caea34cb239f0f926ad768 -->
## Show project data stream

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
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
        "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
        "name": "John Smith Sample Project Data Stream",
        "feed_url": "https:\/\/www.e-monsite.com\/blog\/do\/datastream\/",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_decoder_id"="0017377e-ab34-380b-97cd-4da40c3d9381" \
    -d "name"="Omnis neque laboriosam" \
    -d "feed_url"="http://crooks.com/quas-ut-pariatur-doloremque-impedit-consequatur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "0017377e-ab34-380b-97cd-4da40c3d9381",
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
    data_stream_decoder_id | string |  required  | UUID Valid data_stream_decoder id
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_41e37bb4ea451c1a5a85f3a3b34c6589 -->

<!-- START_b3bd4bcca43f451aebf51006a642ad0c -->
## Update the project data stream

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_decoder_id"="92dba4be-7fd9-3c86-9eb3-fbfc24724c3b" \
    -d "name"="In aspernatur autem" \
    -d "feed_url"="http://heidenreich.com/" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "92dba4be-7fd9-3c86-9eb3-fbfc24724c3b",
        "name": "In aspernatur autem",
        "feed_url": "http:\/\/heidenreich.com\/"
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
    data_stream_decoder_id | string |  required  | UUID Valid data_stream_decoder id
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_b3bd4bcca43f451aebf51006a642ad0c -->

<!-- START_820f0f614fb757aec7e225d86da8b40d -->
## Delete the project data stream

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
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

#DataStreamDecoder
<!-- START_bd915a237dff3bacba3bfa81f74db7a9 -->
## Show data stream decoder list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder",
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
            "id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
            "name": "Emonsite",
            "class_name": "EmonsiteDecoder",
            "file_mime_type": "application\/json",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
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
`GET /api/dataStreamDecoder`

`HEAD /api/dataStreamDecoder`


<!-- END_bd915a237dff3bacba3bfa81f74db7a9 -->

<!-- START_049ef8cf901ed40324a483e5d7e5890c -->
## Get specified data stream decoder

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0",
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
        "id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
        "name": "Emonsite",
        "class_name": "EmonsiteDecoder",
        "file_mime_type": "application\/json",
        "created_at": "2017-08-18 10:21:56",
        "updated_at": "2017-08-18 10:21:56"
    }
}
```

### HTTP Request
`GET /api/dataStreamDecoder/{dataStreamDecoderId}`

`HEAD /api/dataStreamDecoder/{dataStreamDecoderId}`


<!-- END_049ef8cf901ed40324a483e5d7e5890c -->

#I18nLang
<!-- START_e1171537de1a9b8e9dfbd90e9ef7c13f -->
## Show i18n lang list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang",
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
                "next": "https:\/\/emsearch.ryan.ems-dev.net\/api\/i18nLang?page=2"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang/en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en_US",
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

<!-- START_23e983fda5cf9784111b947c3a498672 -->
## Show i18n lang list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang/search" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/search",
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
null
```

### HTTP Request
`GET /api/i18nLang/search`

`HEAD /api/i18nLang/search`


<!-- END_23e983fda5cf9784111b947c3a498672 -->

#Me
<!-- START_01138559f486b5b7c062a19b1c0412fe -->
## Get current user

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/me" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/me",
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
        "created_at": "2017-08-18 10:21:59",
        "updated_at": "2017-08-18 10:21:59"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/me/notification?read_status=unread" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/me/notification?read_status=unread?read_status=unread",
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
            "id": "da36a1e8-65ef-4d6b-a687-0956e29027fd",
            "type": "App\\Notifications\\AdministeredProject",
            "notifiable_id": "605c7610-1389-11e7-93ae-92361f002671",
            "notifiable_type": "App\\Models\\User",
            "data": {
                "user_id": "605c7610-1389-11e7-93ae-92361f002671",
                "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
                "assigned_by_user_id": "82b5da82-138c-11e7-93ae-92361f002671",
                "assigned_by_user": {
                    "name": "Mickey Mouse",
                    "email": "mickey.mouse@domain.tld"
                },
                "project": {
                    "name": "Mickey Mouse Sample Project"
                }
            },
            "read_at": null,
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/me/notification/5b0decfd-6f95-4e76-be12-8cc7fef976b0/read" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/me/notification/5b0decfd-6f95-4e76-be12-8cc7fef976b0/read",
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/me/notification/5b0decfd-6f95-4e76-be12-8cc7fef976b0/unread" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/me/notification/5b0decfd-6f95-4e76-be12-8cc7fef976b0/unread",
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/me/project?user_role_id=Owner" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/me/project?user_role_id=Owner?user_role_id=Owner",
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
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project 1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/me/project`

`HEAD /api/me/project`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_role_id | string |  optional  | Valid user_role id `Owner` or `Administrator`

<!-- END_5951e28de2699182212669b38146cae2 -->

<!-- START_4c7672d1d57bba818fcb5bc7dc53776e -->
## Get specified project

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
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
        "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
        "name": "John Smith Sample Project 1",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/project" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Eos aliquid voluptatem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "name": "Eos aliquid voluptatem"
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
    name | string |  required  | Minimum: `5` Maximum: `100`

<!-- END_f77a6ccd588d420cab2180c05580e7ef -->

<!-- START_3ab7c7860cd533c91de466d299bc9cff -->
## Update a specified project

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Dolor aperiam autem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "name": "Dolor aperiam autem"
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
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
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

#SearchUseCase
<!-- START_4b5e9ae73571f33c511b43a1f61a4ec0 -->
## Perform search with the specified search use case

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/search?query_string=site internet&i18n_lang_id=fr&page=1&limit=5" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/search?query_string=site internet&amp;i18n_lang_id=fr&amp;page=1&amp;limit=5?query_string=Earum nemo dignissimosi18n_lang_id=Eum temporibus consequaturpage=656871limit=647197982",
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
            "item_id": "4f72bc79df6d0000000082b0",
            "title_fr": "Le site du Mercredi ou comment créer un site internet avec E-monsite",
            "content_fr": "Ce billet inaugure une série d&#39;articles mettant en avant le meilleur de la création de site web sur E-monsite.com. Tous les mercredis, nous présenterons un site réalisé grâce aux outils pour créer un site internet sur E-monsite, l&#39;équipe E-monsite en profitera pour donner son avis d&#39; \"expert\". Ici point de copinages ou d&#39;hypocrisie, mais simplement les coups de cœur de l&#39;équipe E-monsite.\r\n\r\n\r\n\r\nComme précisé sur la page facebook E-monsite, nous ne faisons pas de discriminations entre un site web gratuit, un site internet pro ou une boutique en ligne. Tout le monde a sa chance, les sites sélectionnés auront brillé par leurs designs, leurs contenus (ou les deux) ou encore par l&#39;originalité de leur concept.\r\n\r\nC&#39;est le Blog informatique Willside.net qui inaugure l&#39;opération. Nous avons découvert ce site grâce à un commentaire de l&#39;utilisateur sur notre page facebook et avons été agréablement surpris par la qualité du travail réalisé par le Webmaster. Florian développeur E-monsite nous donne son avis :\r\n\r\nPoints forts :\r\n- Sobriété\r\n- Contenu clair\r\n- Menu fonctionnel\r\n- Header bien mis en avant\r\n- La petite intro dans le post-it\r\n- Footer clair\r\n\r\nEléments à améliorer :\r\n- Couleur des liens du menu\r\n- Le style des liens lorsque l&#39;on passe dessus\r\n\r\nConclusion :\r\nStyle propre et clair, il ne faut pas aller dans le bling-bling pour avoir un site de très très bonne qualité ! C&#39;est le genre de site qui donne envie de lire et d&#39;y passer un petit moment. Félicitation au webmaster !\r\n\r\nCet E-monsitien à vraiment mis à profit les outils pour créer un site internet facilement, nous espérons que ce site vous plaira aussi et qu&#39;il restera dans vos favoris si vous êtes intéressés par l&#39;actualité informatique. A vous de jouer maintenant, le prochain site du mercredi c&#39;est la semaine prochaine !\r\n\r\nEdito du 1er Avril 2010 pour ajouter la petite interview du site du Mercredi.\r\n\r\n1. Quand et Comment avez vous découvert E-monsite ?\r\n\r\nJ&#39;ai découvert E-monsite alors que je cherchais via Google un moyen de me créer un petit site web sympathique facilement. Je pense que c&#39;était il y a un peu moins d&#39;un an. J&#39;ai choisis E-monsite car cette plateforme m&#39;a tout de suite semblé sûre, fiable, fonctionnelle, et de qualité, et je n&#39;ai pas eu tord. J&#39;ai parfois même eu l&#39;occasion de tester d&#39;autres plateformes, sans succès.\r\n\r\n2. Quel niveau de développement web aviez vous au moment où vous avez créé Willside.net ?\r\n\r\nLorsque j&#39;ai créé WillSide.net, le mot \"HTML\" était pour moi totalement étranger de mon vocabulaire. Depuis le temps, il est incroyable de constater tout ce que j&#39;ai pu comprendre et apprendre concernant le développement web, et ce grandement grâce à E-monsite.\r\n\r\n3. Quels conseils pourriez vous donner aux personnes qui découvrent l&#39;outil ?\r\n\r\nPersonnellement, je conseille de vraiment essayer d&#39;exploiter toutes les possibilités de la plateforme. Au premier coup d&#39;oeil, on ne soupçonnerait même pas tout ce qu&#39;il est possible de réaliser. Pourtant, il suffit d&#39;un second coup d&#39;oeil plus approfondi et on se rends compte qu&#39;on va facilement très loin. Plus l&#39;on commence à maîtriser le html, le javascript, le css etc... plus l&#39;on va loin. E-monsite convient à tout le monde, que l&#39;on ait des connaissances ou non sur le développement web.",
            "url_fr": "https:\/\/www.e-monsite.com\/blog\/sites-crees-avec-e-monsite\/le-site-du-mercredi-ou-comment-creer-un-site-internet-avec-e-monsite.html"
        },
        {
            "item_id": "4f72bc7b1dab0000000081ca",
            "title_fr": "Le site du Mercredi #4 ou comment créer un site internet avec E-monsite",
            "content_fr": "Le 4ème site du Mercredi a été sélectionné, et même si c&#39;est le premier ce mois-ci, ce n&#39;est pas un poisson d&#39;avril !  C&#39;est  donc le site peggylurton.com, un site web consacré à l&#39;Art-thérapie qui a retenu notre attention cette semaine. Ici c&#39;est le design sobre et la bonne utilisation des outils de création de site qui ont fait la différence.\r\n\r\n\r\n\r\nPas besoin d&#39;être un crack en informatique pour créer un site internet, et Peggy nous le prouve, car c&#39;est à peine un mois après son inscription qu&#39;elle est arrivée à ce résultat : une vitrine efficace pour son activité, qui permet de trouver rapidement toutes les informations que ses visiteurs pourraient rechercher. C&#39;est Florian, Web-développeur E-monsite qui nous donne son avis d&#39;expert sur le travail du Webmaster du site du mercredi #4 : L&#39;art d&#39;être soi.\r\n\r\nPoints forts :\r\n\r\n- Style sobre et couleurs en harmonie (ce qui donne un côté reposant)\r\n- Bonne utilisation d&#39;un thème (et modifié de façon ingénieuse)\r\n- Menus légers contenant des informations pertinentes\r\n- Utilisation parfaite de l&#39;agenda (brève description qui force à aller voir le contenu détaillé)\r\n\r\nPoints à améliorer :\r\n\r\n- Il manque peut être un footer (pied de page) pour éviter une \"fin brutale\" de la page. Il permettrait notamment d&#39;ajouter d&#39;autres liens vers les pages de contenu (utile tant pour la navigation que pour le référencement).\r\n- Les polices différentes dans une même page (dans l&#39;agenda par exemple) qui sont sûrement dues à des copier-coller depuis un éditeur de texte logiciel.\r\n\r\nConclusion :\r\n\r\nUn site agréable à visiter avec du contenu clair et intéressant. Très bonne utilisation des outils mis à disposition par E-monsite. Un bel exemple de personne n&#39;ayant pas de connaissances en développement web et qui a construit un bien joli site avec les outils de personnalisation. Ses compétences graphiques l&#39;aident pour l&#39;harmonie du contenu et des couleurs. En bref, une belle réussite, bravo !\r\n\r\nLorsqu&#39;elle maîtrisera un peu plus les outils de création web, nul doute que le site de Peggy Lurton nous surprendra à nouveau, mais nous voyons ici que la sobriété du design et des contenus facilement accessibles et cohérents sont les premières clés pour réaliser un bon site internet. Je vous laisse découvrir les réponses de Peggy Lurton aux questions du Mercredi, en espérant que ces différents exemples de sites créés avec E-monsite.com vous encouragent et vous donnent des idées pour votre Site.\r\n\r\n1. Quand et Comment avez vous découvert E-monsite ?\r\n\r\nJ&#39;ai découvert  E-monsite il y a un mois environ en cherchant par hasard sur google comment faire un site simple et efficace. E-monsite faisait la différence par sa simplicité et sa convivialité.\r\n\r\n2. Quel niveau de développement web aviez vous au moment où vous avez créé votre site ?\r\n\r\nZéro au niveau du développement web ! Par contre, je suis graphiste et cela aide un peu.\r\n\r\n3. Quels conseils pourriez vous donner aux personnes qui découvrent l&#39;outil ?\r\n\r\nAllez-y les yeux fermés !!! On est vraiment pris en main et il y a toujours de l&#39;aide si on a des problèmes ou des doutes. La version pro est super ainsi que le nom de domaine (rapide en plus), je ne regrette pas !!! Petit à petit , le site s&#39;améliore, change, car c&#39;est très simple de le manipuler.",
            "url_fr": "https:\/\/www.e-monsite.com\/blog\/sites-crees-avec-e-monsite\/le-site-du-mercredi-4-ou-comment-creer-un-site-internet-avec-e-monsite.html"
        },
        {
            "item_id": "4f72bc7ad9a4000000003a06",
            "title_fr": "Le site du Mercredi #3, ou comment créer un site internet avec E-monsite",
            "content_fr": "Le traditionnel rendez-vous du mercredi est arrivé ! Installez vous dans votre fauteuil, chaise, canapé ou quel que soit l&#39;endroit où vous vous installez pour créer un site internet et suivre l&#39;évolution des outils e-monsite sur le blog, sur Facebook etc... C&#39;est le travail de Sylvie, webmaster du site Almahfrance.com, un site internet consacré à Almah un groupe de Métal brésilien, qui est mis en avant cette semaine.\r\n\r\n\r\n\r\nSite du groupe de Métal brésilien Almah\r\n\r\n\r\n\r\nLe Webmaster administre 4 sites au total, tous liés au groupe Almah, que ce soit le site du chanteur : Edu Falaschi ou les différents sites dédiés aux fans d&#39;Almah. Mais avant de laisser la parole à Tony qui nous donnera son avis d&#39;expert E-monsite sur ce site web, laissez moi vous parler des différentes nouveautés qui font leur apparition dans la rubrique cette semaine.\r\n\r\nTout d&#39;abord, une partie \"interview\" fait son apparition dans l&#39;article, elle est constituée des réponses donnés par le webmaster du site sélectionné à une série de 3 questions qui seront les mêmes chaque semaine.\r\n\r\nEnsuite, notre Web-designer en chef, Pascal, a réalisé un petit logo du site du Mercredi, que les webmasters peuvent intégrer sur leur site ( s&#39;ils le souhaitent bien sûr). Cela leur permettra par exemple de renvoyer directement vers l&#39;article ou une page de leur choix.\r\n\r\nEn sachant que parallèlement, nous réfléchissons à une autre manière de mettre en avant les sites sélectionnés sur le portail d&#39;E-monsite.com. Une autre façon de féliciter les webmasters pour leur travail et de leur apporter certainement une source de trafic non négligeable. C&#39;est donc le moment de contacter Jeremy et Benoît via le support en ligne pour demander comment créer un site internet, ou comment l&#39;améliorer.\r\n\r\nVoici donc l&#39;avis de Tony sur le site.\r\n\r\nPoints forts :\r\n\r\n- Design cohérent dans son ensemble entre les différents supports internet et visuels (pochettes etc...), en phase avec l&#39;identité du groupe.\r\n- Taille d&#39;écriture identique et styles d&#39;écriture cohérents sur toutes les pages :  contenu bien lisible\r\n- Contenu bien organisé (navigation sur plusieurs niveaux)\r\n- Pas de fioritures inutiles (gifs animés, bannières, effets javascript...)\r\n- Très bonne utilisation des fonctionnalités proposées par E-monsite \r\n\r\nPoints à améliorer :\r\n\r\n- Image d&#39;entête trop haute : sur une résolution 1024x768 on ne voit que l&#39;entête\r\n- Des images qui touchent le texte (vignettes sur la page biographies par exemple)\r\n- Liens internes et externes similaires : on ne sait pas quand on quitte le site\r\n- Agenda : le lien dans le menu en haut est une page, et le lien dans le menu du bas est le module agenda.\r\n- La page d&#39;introduction n&#39;est pas forcément nécessaire.\r\n\r\nConclusion\r\n\r\nLe site est graphiquement bien ficelé et est cohérent avec le graphisme du site officiel. Les points à améliorer sont l&#39;image d&#39;entête trop haute (494px de hauteur) qui peut perdre l&#39;internaute qui peut ne pas voir le contenu du site (par exemple après avoir cliqué sur la page d&#39;introduction, il peut penser être resté sur la même page étant donné que l&#39;image d&#39;intro et d&#39;entête sont identiques) et les liens vers les pages externes ne sont pas assez bien signalés (de même, par exemple, en s&#39;abonnant à la newsletter on atterrit, sans avoir été prévenu, sur un autre site). En conclusion, ce site utilise parfaitement les possibilités de E-monsite en matière de design et de gestion de contenu et ne nécessite que quelques petites améliorations mineures qui lui permettront d&#39;éviter de perdre les internautes.\r\n\r\nEncore bravo à Sylvie pour tout le travail réalisé, voici ses réponses aux trois questions du mercredi qui sont assez élogieuses et que l&#39;on pourrait presque utiliser telles quelles dans les futures plaquettes E-monsite ! Nous vous assurons que nous n&#39;avons exercé aucune menace à son encontre au moment où elle a tapé ces lignes... ;)\r\n\r\n1. Quand et Comment avez vous découvert E-monsite ?\r\n\r\nJ&#39;ai découvert E-monsite il y a un an et demi, en cherchant sur le web un moyen simple et efficace de créer un site pour un groupe de musique métal Brésilien, Almah. J&#39;ai essayé plusieurs interfaces, mais je trouve que celle d&#39;E-monsite est vraiment la meilleure et la plus conviviale aussi ! Le service est en plus génial : entre le forum d&#39;E-monsite et la hotline, on trouve toujours de l&#39;aide !\r\n\r\n\r\n2. Quel niveau de développement web aviez vous au moment où vous avez créé Almahfrance.com.\r\n\r\nAucun ... Je suis autodidacte, j&#39;essaye toujours d&#39;apprendre de nouvelles choses ! Je dois aussi avouer que je suis conseillée par mes frères qui sont des professionnels du web.\r\n\r\n\r\n3. Quels conseils pourriez vous donner aux personnes qui découvrent l&#39;outil ?\r\n\r\nL&#39;explorer au maximum ! E-monsite est pour moi un outil vraiment génial, car il s&#39;adapte à notre degré de connaissances web ! Au début, si l&#39;on ne s&#39;y connaît pas du tout, on peut choisir un design proposé par E-monsite et suivre tout simplement les instructions très claires, données pour créer son site ! Si on évolue et que l&#39;on commence à coder en HTML, à maîtriser le Javascript et que l&#39;on touche un peu au design, on peut améliorer son site de manière plus autonome ! E-monsite est très flexible de ce point de vue ! En plus, E-monsite propose régulièrement des nouveautés qui sont excellentes (comme par exemple la gestion avancée des menus verticaux etc ...). Et surtout, ne pas hésiter à poser des questions sur le forum d&#39;E-monsite : les membres de la communauté essaient toujours de donner des conseils, échangent leurs expériences, c&#39;est vraiment un moyen sympathique d&#39;apprendre ! Mon dernier conseil ... essayer la version Pro d&#39;E-monsite ! Elle offre de nombreuses possibilités et permet de faire de très beaux sites, sans pub !\r\n\r\nMerci Sylvie et bravo pour votre travail ! Avis aux E-monsitiens, n&#39;hésitez pas à laisser un commentaire ou à lui demander directement comment elle est arrivée à ce résultat.",
            "url_fr": "https:\/\/www.e-monsite.com\/blog\/sites-crees-avec-e-monsite\/le-site-du-mercredi-3-ou-comment-creer-un-site-internet-avec-e-monsite.html"
        },
        {
            "item_id": "4f72bc7a3a910000000051e0",
            "title_fr": "Le site du Mercredi #2 ou comment créer un site internet avec E-monsite",
            "content_fr": "Voilà donc le deuxième billet mettant en avant un internaute qui a utilisé E-monsite pour faire un site internet, et un beau s&#39;il vous plait ! Cette semaine c&#39;est le webmaster de fan-fortboyard.fr qui a été sélectionné. Nous espérons que vous aurez la même réaction que toute l&#39;équipe en surfant sur ce site dédié aux fans de fort Boyard.\r\n\r\n\r\n\r\nC&#39;est aussi bientôt une date anniversaire car le 28 mars, cela fera 4 ans jour pour jour que cet utilisateur utilise les outils E-monsite et c&#39;est aussi en 2006 qu&#39;il a choisi de créer un site professionnel. C&#39;est peut être ce qui explique sa maîtrise des outils, mais il vous suffit de suivre les conseils de nos deux génies du support, j&#39;ai nommé Jeremy et Benoît, ou encore d&#39;utiliser les nombreuses ressources en ligne pour améliorer votre site internet.\r\n\r\nCette semaine c&#39;est Nicolas qui travaille d&#39;arrache-pied pour concevoir et améliorer les outils pour créer une boutique en ligne qui a pour mission de donner son point de vue d&#39;expert en création de site. Voici ses commentaires:\r\n\r\nPoints forts :\r\n\r\n- Un site très fourni, qui donne une impression d&#39;abondance sans tomber dans l&#39;écueil du fouillis.\r\n- Un design homogène, pas bling-bling, sans fioritures graphiques et effets inutiles.\r\n- Une arborescence structurée, une mise en page claire et soignée.\r\n- Une utilisation raisonnée des menus verticaux.\r\n\r\nPoints à améliorer :\r\n\r\n- Beaucoup d&#39;erreurs de validation, dues à certaines balises HTML \"obsolètes\". Par exemple le cadre \"Dernière Minutes\" avec le texte qui défile.\r\n- Une page d&#39;accueil peut-être un peu trop dense.\r\n\r\nConclusion :\r\n\r\nUn sentiment de confiance se dégage de ce site dès l&#39;arrivée sur la page d&#39;accueil, sans doute grâce à une organisation réfléchie des éléments de contenu et de navigation, et à une utilisation parcimonieuse des potentiels graphiques offerts par la plateforme.\r\n\r\nIl est vrai que ce site inspire confiance et fait très pro, nul doute que c&#39;est une référence incontournable pour tous les amateurs de l&#39;émission télévisée. La constance que l&#39;on retrouve sur les sites professionnels, c&#39;est certes l&#39;implication du webmaster, mais aussi la sobriété et la non-profusion d&#39;éléments clignotants qui peuvent gêner la lecture du contenu et augmenter le temps de chargement de la page. Encore bravo au webmaster et à mercredi prochain pour la présentation du nouveau site réussi. N&#39;hésitez pas à donner votre avis sur le site !\r\n\r\nEdito du 1er avril pour ajouter la mini \"interview\" de Sebastien le webmaster de fan-frotboyard.fr.\r\n\r\n1. Quand et Comment avez vous découvert E-monsite ?\r\n\r\nEt bien j&#39;ai découvert E-Monsite il y a déjà 4 ans, début 2006 en cherchant simplement sur Google ! Après avoir fait le tour de plusieurs autres supports, c&#39;est E-Monsite qui a attiré mon attention. Je n&#39;ai donc pas hésité à m&#39;inscrire dans la foulée !\r\n\r\n2. Quel niveau de développement web aviez vous au moment où vous avez créé fan-fortboyard.fr\r\n\r\nEn fait, je ne connaissais rien ! Auparavant j&#39;avais eu des forums ou des blogs pour d&#39;autres passions que Fort Boyard, mais pas de site. En 2005, j&#39;ai donc ouvert un blog pour l&#39;été 2005 de Fort Boyard, mais j&#39;ai vite vu que ça ne pourrai pas continuer ainsi. J&#39;ai donc décidé de passer à l&#39;étape au-dessus en créant un site rapidement, sans pour autant me compliquer la vie.\r\n\r\n3. Quels conseils pourriez vous donner aux personnes qui découvrent l&#39;outil ?\r\n\r\nDe s&#39;inscrire de suite et de profiter de toutes les possibilités qu&#39;offrent E-Monsite. Tout est clair et toujours expliqué correctement, y a pas d&#39;informations cachées ou de mauvaises surprises.\r\nIl y a des nouveautés très souvent, on peut donc améliorer son site régulièrement, sans aucun effort. Je dirai aussi qu&#39;il ne faut pas avoir peur des tarifs pour la version Pro ou le nom de domaine, car quand on voit toutes les options et les avantages que ça apporte, cela vaut vraiment le coup.\r\nEt puis de toute façon dès qu&#39;un souci se présente ; entre la hotline, le forum ou le support en ligne, l&#39;équipe d&#39;E-monsite est toujours là pour aider !",
            "url_fr": "https:\/\/www.e-monsite.com\/blog\/sites-crees-avec-e-monsite\/le-site-du-mercredi-2-ou-comment-creer-un-site-internet-avec-e-monsite.html"
        },
        {
            "item_id": "51a7164a0d666d16c1b08c67",
            "title_fr": "Afficher l'agenda culturel d'un artiste, d'une ville ou d'un lieu sur son site Internet",
            "content_fr": "En partenariat avec AgendaCulturel.fr, un des principaux sites d&#39;information culturelle en France, nous avons le plaisir de vous proposer un nouveau widget permettant d&#39;afficher l&#39;agenda culturel d&#39;un artiste, d&#39;une ville ou d&#39;un lieu de diffusion culturelle.\nLe widget Agenda Culturel\nCe widget permet donc d&#39;afficher les prochaines dates d&#39;événements culturels :\n\td&#39;une ville en France ; vous pourrez en plus définir un rayon en kilomètres pour élargir la recherche et choisir parmi les différentes catégories d&#39;événements celles à afficher : théâtre, concerts, arts du spectacle, danse, spectacles jeune public, festivals, expositions. Il est ainsi facile, par exemple, d&#39;afficher les concerts à Nantes en y incluant toutes les communes alentours !\n\td&#39;un artiste (groupe de musique, compagnie de théâtre...) ; petits ou gros artistes, la base de données d&#39;artistes d&#39;agendaculturel est très complète. Ainsi, par exemple, afficher les prochains concerts de C2C ou les spectacles de Gad Elmaleh sur son site web est possible !\n\td&#39;un lieu (théâtre, salle de concerts...) ; vous pourrez par exemple afficher la programmation de l&#39;Olympia ou du Zénith de Lille ! De plus, pour les lieux, vous pourrez choisir d&#39;afficher tous les événements du lieu ou seulement ceux des catégories souhaités (théâtre, concerts...)\nUn agenda culturel sur son site Internet, pour qui ?\n\tCe widget peut être utile pour la création de site de chambre d&#39;hôtes ou de gîtes, afin de proposer les prochains événements culturels à proximité de la location de vacances . \n\tIl peut être aussi utile pour créer un site de commune et y proposer l&#39;agenda de la ville facilement. \n\tIl peut être aussi utile dans le cadre de création de site de compagnie de théâtre, de groupe de musique ou pour tout type de site d&#39;artiste ; les artistes peuvent ainsi récupérer directement leur agenda depuis agenda culturel. Si leurs dates ne sont pas présentes sur AgendaCutlurel.fr, ils peuvent annoncer gratuitement leurs événements sur le site ; ainsi, ils font la promotion de leurs événements et n&#39;ont pas à les ressaisir sur leur site.\n\tEnfin, ce widget peut être utile à tout type de site souhaitant proposer une information culturelle localisée !\nComment intégrer le widget Agenda Culturel sur son site ?\nCe widget peut être inséré indifféremment sur une page ou dans un menu vertical. Il se trouve dans les Gadgets :\n\tSur les pages, dans une colonne vide, allez sur \"Autres widgets\".\n\tSur les menus, dans un menu vertical cliquez sur \"Ajouter un widget\".\nVous pourrez ensuite taper le nom d&#39;une ville, d&#39;un artiste ou d&#39;un lieu et choisir les réglages du widget.\nVous avez désormais un joli agenda culturel personnalisé sur votre site web !",
            "url_fr": "https:\/\/www.e-monsite.com\/blog\/nouveaute\/afficher-l-agenda-culturel-d-un-artiste-d-une-ville-ou-d-un-lieu-sur-son-site-internet.html"
        }
    ],
    "meta": {
        "pagination": {
            "total": 11,
            "count": 5,
            "per_page": 5,
            "current_page": 1,
            "total_pages": 3
        }
    }
}
```

### HTTP Request
`GET /api/searchUseCase/{searchUseCaseId}/search`

`HEAD /api/searchUseCase/{searchUseCaseId}/search`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    query_string | string |  required  | Minimum: `1`
    i18n_lang_id | string |  optional  | Maximum: `30` Valid i18n_lang id
    page | integer |  optional  | 
    limit | integer |  optional  | 

<!-- END_4b5e9ae73571f33c511b43a1f61a4ec0 -->

<!-- START_24b7252ad8c658bdd88296027322fed8 -->
## Project search use case list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/searchUseCase" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/searchUseCase",
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
            "id": "37f79df8-707c-11e7-8cf7-a6006ad3dba0",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project Default Search Use Case",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00",
            "search_use_case_fields_count": 0
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
`GET /api/project/{projectId}/searchUseCase`

`HEAD /api/project/{projectId}/searchUseCase`


<!-- END_24b7252ad8c658bdd88296027322fed8 -->

<!-- START_55883498511e97641171546b4cb45d24 -->
## Get specified search use case

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
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
        "id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
        "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
        "name": "Mickey Mouse Sample Project Default Search Use Case",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00",
        "search_use_case_fields_count": 3
    }
}
```

### HTTP Request
`GET /api/searchUseCase/{searchUseCaseId}`

`HEAD /api/searchUseCase/{searchUseCaseId}`


<!-- END_55883498511e97641171546b4cb45d24 -->

<!-- START_bef7073a5985de0158499e05875ea492 -->
## Create and store new search use case

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/searchUseCase" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "project_id"="52e014c7-bed9-373a-8cba-2a3ec255c1e3" \
    -d "name"="Temporibus magnam ut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase",
    "method": "POST",
    "data": {
        "project_id": "52e014c7-bed9-373a-8cba-2a3ec255c1e3",
        "name": "Temporibus magnam ut"
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
`POST /api/searchUseCase`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    project_id | string |  required  | UUID Valid project id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_bef7073a5985de0158499e05875ea492 -->

<!-- START_9d5c89968be5399f2e3005a3b3bc7359 -->
## Update a search use case

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "project_id"="b23d9019-6423-3d32-a633-96f62b9a8837" \
    -d "name"="Laborum laboriosam perferendis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "project_id": "b23d9019-6423-3d32-a633-96f62b9a8837",
        "name": "Laborum laboriosam perferendis"
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
`PUT /api/searchUseCase/{searchUseCaseId}`

`PATCH /api/searchUseCase/{searchUseCaseId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    project_id | string |  required  | UUID Valid project id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_9d5c89968be5399f2e3005a3b3bc7359 -->

<!-- START_4416daa71a27a4bded05ac5404e53e9e -->
## Delete specified search use case

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
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
`DELETE /api/searchUseCase/{searchUseCaseId}`


<!-- END_4416daa71a27a4bded05ac5404e53e9e -->

#SearchUseCaseField
<!-- START_e7515d6903905405d52dd827faca1ad3 -->
## Get specified search use case field

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0,36116fa6-5c0d-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0,36116fa6-5c0d-11e7-907b-a6006ad3dba0",
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
        "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
        "data_stream_field_id": "36116fa6-5c0d-11e7-907b-a6006ad3dba0",
        "name": "title",
        "searchable": "1",
        "to_retrieve": "1",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00"
    }
}
```

### HTTP Request
`GET /api/searchUseCaseField/{searchUseCaseId},{dataStreamFieldId}`

`HEAD /api/searchUseCaseField/{searchUseCaseId},{dataStreamFieldId}`


<!-- END_e7515d6903905405d52dd827faca1ad3 -->

<!-- START_8914a823c5cd0a8548590dd616ec14f8 -->
## Create and store new search use case field

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_id"="2c180a76-99f9-3559-9e45-8c1e9c07ee03" \
    -d "data_stream_field_id"="f1c8fd8e-fb80-3835-bcc4-5c827e315335" \
    -d "name"="Enim omnis hic" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField",
    "method": "POST",
    "data": {
        "search_use_case_id": "2c180a76-99f9-3559-9e45-8c1e9c07ee03",
        "data_stream_field_id": "f1c8fd8e-fb80-3835-bcc4-5c827e315335",
        "name": "Enim omnis hic",
        "searchable": true,
        "to_retrieve": true
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
`POST /api/searchUseCaseField`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_id | string |  required  | UUID Valid search_use_case id
    data_stream_field_id | string |  required  | UUID Valid data_stream_field id
    name | string |  required  | Minimum: `1` Maximum: `200`
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_8914a823c5cd0a8548590dd616ec14f8 -->

<!-- START_a12d8c1d71593d39d1691dd3f83888be -->
## Update a specified search use case field

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0,36116fa6-5c0d-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_id"="29e08e21-4477-35a9-ac75-72095e21dac9" \
    -d "data_stream_field_id"="6f8bd76a-ad60-3478-9ae3-a035af9c1d55" \
    -d "name"="Quia amet commodi" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0,36116fa6-5c0d-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "search_use_case_id": "29e08e21-4477-35a9-ac75-72095e21dac9",
        "data_stream_field_id": "6f8bd76a-ad60-3478-9ae3-a035af9c1d55",
        "name": "Quia amet commodi",
        "searchable": true,
        "to_retrieve": true
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
`PUT /api/searchUseCaseField/{searchUseCaseId},{dataStreamFieldId}`

`PATCH /api/searchUseCaseField/{searchUseCaseId},{dataStreamFieldId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_id | string |  required  | UUID Valid search_use_case id
    data_stream_field_id | string |  required  | UUID Valid data_stream_field id
    name | string |  required  | Minimum: `1` Maximum: `200`
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_a12d8c1d71593d39d1691dd3f83888be -->

<!-- START_f5b1f12e424f832740a0b7cda38ed9b5 -->
## Delete specified search use case field

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0,36116fa6-5c0d-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0,36116fa6-5c0d-11e7-907b-a6006ad3dba0",
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
`DELETE /api/searchUseCaseField/{searchUseCaseId},{dataStreamFieldId}`


<!-- END_f5b1f12e424f832740a0b7cda38ed9b5 -->

<!-- START_45565b55352b2e882c2dd42eedec0caa -->
## Search use case search use case fields list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/searchUseCaseField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/searchUseCaseField",
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
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36116fa6-5c0d-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36117334-5c0d-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36118072-5c0d-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/searchUseCase/{searchUseCaseId}/searchUseCaseField`

`HEAD /api/searchUseCase/{searchUseCaseId}/searchUseCaseField`


<!-- END_45565b55352b2e882c2dd42eedec0caa -->

#SearchUseCasePreset
<!-- START_66c2dac2b73afb901f892e71bf96b0ac -->
## Show search use case preset list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset",
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
            "id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Summary",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00",
            "search_use_case_preset_fields_count": 3
        },
        {
            "id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00",
            "search_use_case_preset_fields_count": 2
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
`GET /api/searchUseCasePreset`

`HEAD /api/searchUseCasePreset`


<!-- END_66c2dac2b73afb901f892e71bf96b0ac -->

<!-- START_8ebcce24204dfb4e69f2beb73bdda1e9 -->
## Get specified search use case preset

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34",
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
        "id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
        "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
        "name": "E-monsite | Blog - Summary",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00",
        "search_use_case_preset_fields_count": 3
    }
}
```

### HTTP Request
`GET /api/searchUseCasePreset/{searchUseCasePresetId}`

`HEAD /api/searchUseCasePreset/{searchUseCasePresetId}`


<!-- END_8ebcce24204dfb4e69f2beb73bdda1e9 -->

<!-- START_bc098d76633b8ac3afdd6c0c2a85b443 -->
## Data stream preset search use case preset list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0/searchUseCasePreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0/searchUseCasePreset",
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
            "id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Summary",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00",
            "search_use_case_preset_fields_count": 0
        },
        {
            "id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00",
            "search_use_case_preset_fields_count": 0
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
`GET /api/dataStreamPreset/{dataStreamPresetId}/searchUseCasePreset`

`HEAD /api/dataStreamPreset/{dataStreamPresetId}/searchUseCasePreset`


<!-- END_bc098d76633b8ac3afdd6c0c2a85b443 -->

#SearchUseCasePresetField
<!-- START_7c4b231376235131e97a5bffc85481f6 -->
## Show search use case preset field list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField",
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
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "name": "image_url",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/searchUseCasePresetField`

`HEAD /api/searchUseCasePresetField`


<!-- END_7c4b231376235131e97a5bffc85481f6 -->

<!-- START_6814d4579253211626d4f9e34d697b18 -->
## Get specified search use case preset field

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField/516f0252-7767-11e7-b5a5-be2e44b06b34,eb9cb642-5bf3-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField/516f0252-7767-11e7-b5a5-be2e44b06b34,eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
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
        "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
        "data_stream_preset_field_id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
        "name": "title",
        "searchable": "1",
        "to_retrieve": "1",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00"
    }
}
```

### HTTP Request
`GET /api/searchUseCasePresetField/{searchUseCasePresetId},{dataStreamPresetFieldId}`

`HEAD /api/searchUseCasePresetField/{searchUseCasePresetId},{dataStreamPresetFieldId}`


<!-- END_6814d4579253211626d4f9e34d697b18 -->

<!-- START_4e87a3c1dcd147706d05b545269985b2 -->
## Search use case preset search use case preset fields list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34/searchUseCasePresetField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34/searchUseCasePresetField",
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
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/searchUseCasePreset/{searchUseCasePresetId}/searchUseCasePresetField`

`HEAD /api/searchUseCasePreset/{searchUseCasePresetId}/searchUseCasePresetField`


<!-- END_4e87a3c1dcd147706d05b545269985b2 -->

#SyncItem
<!-- START_6dc95e6a9c747452ea9b21a9e5cbcbee -->
## Project sync item list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncItem" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncItem",
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
`GET /api/project/{projectId}/syncItem`

`HEAD /api/project/{projectId}/syncItem`


<!-- END_6dc95e6a9c747452ea9b21a9e5cbcbee -->

#SyncTask
<!-- START_8151bc8465cc13065e561f4910642cfc -->
## Project sync task list

You can specify a GET parameter `root` (return only root tasks if true, children only if false) to filter results.
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncTask" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncTask?root=1",
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
            "sync_task_status_id": "Planned",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-08-18 10:32:00",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00",
            "sync_task_logs_count": 1,
            "children_sync_tasks_count": 0
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
`GET /api/project/{projectId}/syncTask`

`HEAD /api/project/{projectId}/syncTask`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    root | boolean |  optional  | 

<!-- END_8151bc8465cc13065e561f4910642cfc -->

#SyncTaskLog
<!-- START_d132997bbec07a0fd69cee40c3cff8ea -->
## Sync task sync task logs list

You can specify a GET parameter `public` to filter results (Only allowed for `Developer` and `Support` users).
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/syncTaskLog?public=" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/syncTaskLog?public=?public=1",
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
            "public": true,
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/syncTask/{syncTaskId}/syncTaskLog`

`HEAD /api/syncTask/{syncTaskId}/syncTaskLog`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    public | boolean |  optional  | 

<!-- END_d132997bbec07a0fd69cee40c3cff8ea -->

#SyncTaskStatus
<!-- START_4717d42cd5763bf3c418a96430240035 -->
## Show sync task status list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus",
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
            "id": "Complete",
            "sync_tasks_count": 0,
            "sync_task_logs_count": 0,
            "sync_task_status_versions_count": 2
        },
        {
            "id": "InProgress",
            "sync_tasks_count": 0,
            "sync_task_logs_count": 0,
            "sync_task_status_versions_count": 2
        },
        {
            "id": "Planned",
            "sync_tasks_count": 2,
            "sync_task_logs_count": 1,
            "sync_task_status_versions_count": 2
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned",
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
        "id": "Planned",
        "sync_tasks_count": 2,
        "sync_task_logs_count": 1,
        "sync_task_status_versions_count": 2
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion",
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
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_status_id": "Complete",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est terminée",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is in progress.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est en cours.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is planned.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US",
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
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        }
    ]
}
```

### HTTP Request
`GET /api/syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}`

`HEAD /api/syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}`


<!-- END_3154293d7e3ad8c7b20f143c3d0e5151 -->

<!-- START_13b4f9936bf59c1205310a48e4965fa2 -->
## Sync task status sync task status versions list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned/version" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned/version",
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
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskType" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskType",
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
            "id": "DataStreamCheck",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "DataStreamDownload",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "DataStreamPrepare",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "ItemsDelete",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "ItemsInsertion",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "ItemsUpdate",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "Main",
            "sync_tasks_count": 2,
            "sync_task_type_versions_count": 2
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskType/Main" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskType/Main",
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
        "id": "Main",
        "sync_tasks_count": 2,
        "sync_task_type_versions_count": 2
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion",
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
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "DataStreamCheck",
            "i18n_lang_id": "fr_FR",
            "description": "Comparaison et vérification des données téléchargées.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "fr_FR",
            "description": "Téléchargement des données fournies par l'url du flux de données.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "fr_FR",
            "description": "Ventilation des données pour la création, modification ou suppression.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "fr_FR",
            "description": "Suppression d'enregistrements.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "fr_FR",
            "description": "Création des nouveaux enregistrements.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
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
                "next": "https:\/\/emsearch.ryan.ems-dev.net\/api\/syncTaskTypeVersion?page=2"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US",
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
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        }
    ]
}
```

### HTTP Request
`GET /api/syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}`

`HEAD /api/syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}`


<!-- END_94297c423be097f34970c23692babbec -->

<!-- START_23d45485a9001240593300c466ec2b0c -->
## I18n lang sync task type versions list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang/en_US/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en_US/syncTaskTypeVersion",
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
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "ItemsUpdate",
            "i18n_lang_id": "en_US",
            "description": "Updating records.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
        },
        {
            "sync_task_type_id": "Main",
            "i18n_lang_id": "en_US",
            "description": "Main task who rules and manage subtasks.",
            "created_at": "2017-08-18 10:21:56",
            "updated_at": "2017-08-18 10:21:56"
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

#Widget
<!-- START_b2dd13b0d6ee24e0e54c9a96a4614770 -->
## Get specified widget

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34",
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
        "id": "b070b438-781d-11e7-b5a5-be2e44b06b34",
        "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
        "name": "E-monsite | Blog - Photo Widget",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00"
    }
}
```

### HTTP Request
`GET /api/widget/{widgetId}`

`HEAD /api/widget/{widgetId}`


<!-- END_b2dd13b0d6ee24e0e54c9a96a4614770 -->

<!-- START_5eb7f4f27d5cdc5690d10c932be8d8d3 -->
## Create and store new widget

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/widget" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_id"="cdd0584f-f363-309b-b834-28ac8f763fe8" \
    -d "name"="Hic provident reiciendis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget",
    "method": "POST",
    "data": {
        "search_use_case_id": "cdd0584f-f363-309b-b834-28ac8f763fe8",
        "name": "Hic provident reiciendis"
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
`POST /api/widget`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_id | string |  required  | UUID Valid search_use_case id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_5eb7f4f27d5cdc5690d10c932be8d8d3 -->

<!-- START_f9bfda230eb6676fcdcc3dba62802c78 -->
## Update a widget

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_id"="1ee031c8-cbab-3a87-899a-89c5a1f605ab" \
    -d "name"="Eveniet rerum illo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34",
    "method": "PUT",
    "data": {
        "search_use_case_id": "1ee031c8-cbab-3a87-899a-89c5a1f605ab",
        "name": "Eveniet rerum illo"
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
`PUT /api/widget/{widgetId}`

`PATCH /api/widget/{widgetId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_id | string |  required  | UUID Valid search_use_case id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_f9bfda230eb6676fcdcc3dba62802c78 -->

<!-- START_a1d66c11d4282c18663bc1bd7fd3cc06 -->
## Delete specified widget

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34",
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
`DELETE /api/widget/{widgetId}`


<!-- END_a1d66c11d4282c18663bc1bd7fd3cc06 -->

<!-- START_35485bc693c4215a20193030b843e99b -->
## Search use case widget list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/widget" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/widget",
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
            "id": "b070b438-781d-11e7-b5a5-be2e44b06b34",
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo Widget",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/searchUseCase/{searchUseCaseId}/widget`

`HEAD /api/searchUseCase/{searchUseCaseId}/widget`


<!-- END_35485bc693c4215a20193030b843e99b -->

#WidgetPreset
<!-- START_c514d31fc60ba92e4e6e76dfc255405a -->
## Show widget preset list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/widgetPreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widgetPreset",
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
            "id": "0f85eb82-776a-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Photo Widget",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/widgetPreset`

`HEAD /api/widgetPreset`


<!-- END_c514d31fc60ba92e4e6e76dfc255405a -->

<!-- START_fcd0c7112a22c2f60070949c9c1ca609 -->
## Get specified widget preset

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/widgetPreset/6be0a102-7769-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widgetPreset/6be0a102-7769-11e7-b5a5-be2e44b06b34",
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
        "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
        "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
        "name": "E-monsite | Blog - Summary Widget",
        "created_at": "2017-08-18 10:22:00",
        "updated_at": "2017-08-18 10:22:00"
    }
}
```

### HTTP Request
`GET /api/widgetPreset/{widgetPresetId}`

`HEAD /api/widgetPreset/{widgetPresetId}`


<!-- END_fcd0c7112a22c2f60070949c9c1ca609 -->

<!-- START_2b3702d640866ae1858bbc97f220a7fa -->
## Search use case preset widget presets list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34/widgetPreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34/widgetPreset",
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
            "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/searchUseCasePreset/{searchUseCasePresetId}/widgetPreset`

`HEAD /api/searchUseCasePreset/{searchUseCasePresetId}/widgetPreset`


<!-- END_2b3702d640866ae1858bbc97f220a7fa -->

<!-- START_91c5599d9f3148be8af11c702acba433 -->
## Data stream preset widget preset list

(Through the related search use case presets)
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0/widgetPreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0/widgetPreset",
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
            "id": "0f85eb82-776a-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Photo Widget",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
        },
        {
            "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-08-18 10:22:00",
            "updated_at": "2017-08-18 10:22:00"
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
`GET /api/dataStreamPreset/{dataStreamPresetId}/widgetPreset`

`HEAD /api/dataStreamPreset/{dataStreamPresetId}/widgetPreset`


<!-- END_91c5599d9f3148be8af11c702acba433 -->

