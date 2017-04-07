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
#Developer Api Documentation

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
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project Data Stream",
            "feed_url": "http:\/\/domain.tld\/feedTheMouse.json",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
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
        "created_at": "2017-04-04 12:54:12",
        "updated_at": "2017-04-04 12:54:12"
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
    -d "name"="Vitae qui nam" \
    -d "feed_url"="Eaque ex voluptatem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/dataStream",
    "method": "POST",
    "data": {
        "name": "Vitae qui nam",
        "feed_url": "Eaque ex voluptatem"
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
    feed_url | string |  required  | 

<!-- END_9806e6f48b29aa520cbf710b72b4fa3e -->

<!-- START_87948eda1c008b091811da4bfc7cd218 -->
## Update a data stream

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Ea et non" \
    -d "feed_url"="Velit possimus et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "name": "Ea et non",
        "feed_url": "Velit possimus et"
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
    name | string |  optional  | Maximum: `200`
    feed_url | string |  optional  | 

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
        "created_at": "2017-04-04 12:54:12",
        "updated_at": "2017-04-04 12:54:12"
    }
}
```

### HTTP Request
`GET /api/project/{projectId}/dataStream`

`HEAD /api/project/{projectId}/dataStream`


<!-- END_3867fe1670caea34cb239f0f926ad768 -->

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

<!-- START_2c6c3f202b3909bc34fad9347621aaa1 -->
## Create and store new i18n lang

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/i18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "id"="Earum nemo dignissimos" \
    -d "description"="Sunt explicabo in" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang",
    "method": "POST",
    "data": {
        "id": "Earum nemo dignissimos",
        "description": "Sunt explicabo in"
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
`POST /api/i18nLang`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | Maximum: `30`
    description | string |  required  | 

<!-- END_2c6c3f202b3909bc34fad9347621aaa1 -->

<!-- START_af8f6b1d140489943f05fd909d10f8c5 -->
## Update a i18n lang

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "description"="Et quos modi" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US",
    "method": "PUT",
    "data": {
        "description": "Et quos modi"
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
`PUT /api/i18nLang/{i18nLangId}`

`PATCH /api/i18nLang/{i18nLangId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    description | string |  required  | 

<!-- END_af8f6b1d140489943f05fd909d10f8c5 -->

<!-- START_da33854f6c75cddbbd999cf866437d76 -->
## Delete specified i18n Lang

<aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>

> Example request:

```bash
curl -X DELETE "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US",
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
`DELETE /api/i18nLang/{i18nLangId}`


<!-- END_da33854f6c75cddbbd999cf866437d76 -->

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
        "created_at": "2017-04-04 12:54:12",
        "updated_at": "2017-04-04 12:54:12"
    }
}
```

### HTTP Request
`GET /api/me`

`HEAD /api/me`


<!-- END_01138559f486b5b7c062a19b1c0412fe -->

#Project
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
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "f5224ea0-4bf0-4d9a-a7dd-86669fe1be4d",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcrea",
            "created_at": "2017-04-05 14:46:16",
            "updated_at": "2017-04-05 14:46:16"
        },
        {
            "id": "e6fd9491-713e-4844-96e3-c49f14a1c339",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcrea",
            "created_at": "2017-04-07 07:32:51",
            "updated_at": "2017-04-07 07:32:51"
        },
        {
            "id": "6cbb7e18-543e-488c-b86f-14e06167930c",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcrea",
            "created_at": "2017-04-07 07:41:33",
            "updated_at": "2017-04-07 07:41:33"
        },
        {
            "id": "ea0e8c58-41c8-416b-b56d-a2f842ed1548",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcrea",
            "created_at": "2017-04-07 07:42:12",
            "updated_at": "2017-04-07 07:42:12"
        },
        {
            "id": "a4f14635-4f7c-40c3-9e15-7b8336635613",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 07:42:15",
            "updated_at": "2017-04-07 07:42:15"
        },
        {
            "id": "ea851063-86e6-4b56-a807-29c9203f27a0",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 07:43:39",
            "updated_at": "2017-04-07 07:43:39"
        },
        {
            "id": "2c33abaf-dfc6-4472-ad10-48cda6c6ac8f",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 07:58:07",
            "updated_at": "2017-04-07 07:58:07"
        },
        {
            "id": "6fd47014-2401-402e-b0d0-7045d4d932f8",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 07:58:19",
            "updated_at": "2017-04-07 07:58:19"
        }
    ],
    "meta": {
        "pagination": {
            "total": 34,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 4,
            "links": {
                "next": "http:\/\/emsearch.ryan.ems-dev.net\/api\/user\/605c7610-1389-11e7-93ae-92361f002671\/project?page=2"
            }
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
            "id": "172aee76-4dc5-4a26-8c6b-23b7fcde7012",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:56:39",
            "updated_at": "2017-04-07 08:56:39"
        },
        {
            "id": "17d3d276-4602-4fd1-b406-d3743df51c70",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 12:39:36",
            "updated_at": "2017-04-07 12:39:36"
        },
        {
            "id": "1ba6e827-b996-4e3f-8cea-54855929737a",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:50:47",
            "updated_at": "2017-04-07 08:50:47"
        },
        {
            "id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project 1",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "21f1aea1-580b-48a4-94b5-d1e89d2a6269",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:44:12",
            "updated_at": "2017-04-07 08:44:12"
        },
        {
            "id": "2c33abaf-dfc6-4472-ad10-48cda6c6ac8f",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 07:58:07",
            "updated_at": "2017-04-07 07:58:07"
        },
        {
            "id": "2c447787-122a-4292-8cbc-7471c3bb3316",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:55:02",
            "updated_at": "2017-04-07 08:55:02"
        },
        {
            "id": "2e348aa4-6286-4742-b511-959cfb83c7b4",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 09:19:46",
            "updated_at": "2017-04-07 09:19:46"
        },
        {
            "id": "32ff145b-811a-449b-8cf2-b257280038d9",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:58:02",
            "updated_at": "2017-04-07 08:58:02"
        },
        {
            "id": "34bde4f2-17dc-456a-8911-a81fdd4c5112",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:57:45",
            "updated_at": "2017-04-07 08:57:45"
        }
    ],
    "meta": {
        "pagination": {
            "total": 36,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 4,
            "links": {
                "next": "http:\/\/emsearch.ryan.ems-dev.net\/api\/project?page=2"
            }
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
        "created_at": "2017-04-04 12:54:12",
        "updated_at": "2017-04-04 12:54:12"
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
    -d "search_engine_id"="d55040e8-2b25-35ee-a189-c67898bb9efd" \
    -d "data_stream_id"="daf8424c-4748-3e97-8f26-92d67d633c9c" \
    -d "name"="Labore quia dolor" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "search_engine_id": "d55040e8-2b25-35ee-a189-c67898bb9efd",
        "data_stream_id": "daf8424c-4748-3e97-8f26-92d67d633c9c",
        "name": "Labore quia dolor"
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
    -d "search_engine_id"="f508edb9-71cf-3ab1-a354-aeadf1c9b1ed" \
    -d "data_stream_id"="499c5c71-5a02-3643-82b1-3e399ecae2a3" \
    -d "name"="Sint culpa ullam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "search_engine_id": "f508edb9-71cf-3ab1-a354-aeadf1c9b1ed",
        "data_stream_id": "499c5c71-5a02-3643-82b1-3e399ecae2a3",
        "name": "Sint culpa ullam"
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

All relationships between the project and his users will be automatically deleted too.
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
            "id": "172aee76-4dc5-4a26-8c6b-23b7fcde7012",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:56:39",
            "updated_at": "2017-04-07 08:56:39"
        },
        {
            "id": "17d3d276-4602-4fd1-b406-d3743df51c70",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 12:39:36",
            "updated_at": "2017-04-07 12:39:36"
        },
        {
            "id": "1ba6e827-b996-4e3f-8cea-54855929737a",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:50:47",
            "updated_at": "2017-04-07 08:50:47"
        },
        {
            "id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "John Smith Sample Project 1",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "21f1aea1-580b-48a4-94b5-d1e89d2a6269",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:44:12",
            "updated_at": "2017-04-07 08:44:12"
        },
        {
            "id": "2c33abaf-dfc6-4472-ad10-48cda6c6ac8f",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 07:58:07",
            "updated_at": "2017-04-07 07:58:07"
        },
        {
            "id": "2c447787-122a-4292-8cbc-7471c3bb3316",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:55:02",
            "updated_at": "2017-04-07 08:55:02"
        },
        {
            "id": "2e348aa4-6286-4742-b511-959cfb83c7b4",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 09:19:46",
            "updated_at": "2017-04-07 09:19:46"
        },
        {
            "id": "32ff145b-811a-449b-8cf2-b257280038d9",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:58:02",
            "updated_at": "2017-04-07 08:58:02"
        },
        {
            "id": "34bde4f2-17dc-456a-8911-a81fdd4c5112",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "testcreaggg",
            "created_at": "2017-04-07 08:57:45",
            "updated_at": "2017-04-07 08:57:45"
        }
    ],
    "meta": {
        "pagination": {
            "total": 36,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 4,
            "links": {
                "next": "http:\/\/emsearch.ryan.ems-dev.net\/api\/searchEngine\/ee87e3b2-1388-11e7-93ae-92361f002671\/project?page=2"
            }
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
            "created_at": "2017-04-04 12:54:10",
            "updated_at": "2017-04-04 12:54:10"
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
        "created_at": "2017-04-04 12:54:10",
        "updated_at": "2017-04-04 12:54:10"
    }
}
```

### HTTP Request
`GET /api/searchEngine/{searchEngineId}`

`HEAD /api/searchEngine/{searchEngineId}`


<!-- END_2722bd2e446fc75e00b2f6449ed3d886 -->

<!-- START_015a6f5a15d1264cadd2a7585faf54ac -->
## Create and store new search engine

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/searchEngine" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Aut expedita doloremque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine",
    "method": "POST",
    "data": {
        "name": "Aut expedita doloremque"
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
`POST /api/searchEngine`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `100`

<!-- END_015a6f5a15d1264cadd2a7585faf54ac -->

<!-- START_799a20e4e8308abe543bbd9509f1d445 -->
## Update a search engine

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Omnis occaecati dolor" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "name": "Omnis occaecati dolor"
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
`PUT /api/searchEngine/{searchEngineId}`

`PATCH /api/searchEngine/{searchEngineId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Maximum: `100`

<!-- END_799a20e4e8308abe543bbd9509f1d445 -->

<!-- START_1f959d663af6a541ba1b38647d63575b -->
## Delete specified search engine

<aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>

> Example request:

```bash
curl -X DELETE "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671",
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
`DELETE /api/searchEngine/{searchEngineId}`


<!-- END_1f959d663af6a541ba1b38647d63575b -->

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
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "509dd5c0-1389-11e7-93ae-92361f002671",
            "user_group_id": "Support",
            "name": "Alan Smithee",
            "email": "alan.smithee@domain.tld",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "605c7610-1389-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "John Smith",
            "email": "john.smith@domain.tld",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
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
        "created_at": "2017-04-04 12:54:12",
        "updated_at": "2017-04-04 12:54:12"
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
    -d "user_group_id"="Support" \
    -d "name"="Dolorem vitae qui" \
    -d "email"="maxime77@example.net" \
    -d "password"="g1:TZZKngU" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user",
    "method": "POST",
    "data": {
        "user_group_id": "Support",
        "name": "Dolorem vitae qui",
        "email": "maxime77@example.net",
        "password": "g1:TZZKngU"
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
    -d "user_group_id"="End-User" \
    -d "name"="Et labore debitis" \
    -d "email"="mallie.pacocha@example.com" \
    -d "password"="iP)[C&gt;?7dN3&gt;22`(ML9a" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_group_id": "End-User",
        "name": "Et labore debitis",
        "email": "mallie.pacocha@example.com",
        "password": "iP)[C>?7dN3>22`(ML9a"
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

<!-- START_9617a8e5eaf8871dba9ad8f5000f9cd0 -->
## User group user list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/userGroup/End-User/user" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userGroup/End-User/user",
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
            "id": "605c7610-1389-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "John Smith",
            "email": "john.smith@domain.tld",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
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
`GET /api/userGroup/{userGroupId}/user`

`HEAD /api/userGroup/{userGroupId}/user`


<!-- END_9617a8e5eaf8871dba9ad8f5000f9cd0 -->

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
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "f5224ea0-4bf0-4d9a-a7dd-86669fe1be4d",
            "user_role_id": "Owner",
            "created_at": "2017-04-05 14:46:16",
            "updated_at": "2017-04-05 14:46:16"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "e6fd9491-713e-4844-96e3-c49f14a1c339",
            "user_role_id": "Owner",
            "created_at": "2017-04-07 07:32:51",
            "updated_at": "2017-04-07 07:32:51"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "6cbb7e18-543e-488c-b86f-14e06167930c",
            "user_role_id": "Owner",
            "created_at": "2017-04-07 07:41:33",
            "updated_at": "2017-04-07 07:41:33"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "ea0e8c58-41c8-416b-b56d-a2f842ed1548",
            "user_role_id": "Owner",
            "created_at": "2017-04-07 07:42:12",
            "updated_at": "2017-04-07 07:42:12"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "a4f14635-4f7c-40c3-9e15-7b8336635613",
            "user_role_id": "Owner",
            "created_at": "2017-04-07 07:42:15",
            "updated_at": "2017-04-07 07:42:15"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "ea851063-86e6-4b56-a807-29c9203f27a0",
            "user_role_id": "Owner",
            "created_at": "2017-04-07 07:43:39",
            "updated_at": "2017-04-07 07:43:39"
        }
    ],
    "meta": {
        "pagination": {
            "total": 36,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 4,
            "links": {
                "next": "http:\/\/emsearch.ryan.ems-dev.net\/api\/userHasProject?page=2"
            }
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
            "created_at": "2017-04-04 12:54:12",
            "updated_at": "2017-04-04 12:54:12"
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
    -d "user_id"="abca7ad0-d6c8-3709-9abc-4b08f9635c40" \
    -d "project_id"="76ec1a0f-1cf6-30cf-8b2f-c16fd1a578cb" \
    -d "user_role_id"="Administrator" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject",
    "method": "POST",
    "data": {
        "user_id": "abca7ad0-d6c8-3709-9abc-4b08f9635c40",
        "project_id": "76ec1a0f-1cf6-30cf-8b2f-c16fd1a578cb",
        "user_role_id": "Administrator"
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
    -d "user_id"="8a3d62c5-f158-3369-b612-dd21b715ced0" \
    -d "project_id"="a3a4e6f0-bf26-3e09-a81f-0fb99d6b9013" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_id": "8a3d62c5-f158-3369-b612-dd21b715ced0",
        "project_id": "a3a4e6f0-bf26-3e09-a81f-0fb99d6b9013",
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

