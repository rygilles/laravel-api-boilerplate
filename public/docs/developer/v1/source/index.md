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


#I18nLang
<!-- START_e1171537de1a9b8e9dfbd90e9ef7c13f -->
## Show I18nLang list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>20</code>.</aside>

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
        },
        {
            "id": "ar_DZ",
            "description": "Arabic (Algeria)"
        },
        {
            "id": "ar_EG",
            "description": "Arabic (Egypt)"
        },
        {
            "id": "ar_IQ",
            "description": "Arabic (Iraq)"
        },
        {
            "id": "ar_JO",
            "description": "Arabic (Jordan)"
        },
        {
            "id": "ar_KW",
            "description": "Arabic (Kuwait)"
        },
        {
            "id": "ar_LB",
            "description": "Arabic (Lebanon)"
        },
        {
            "id": "ar_LY",
            "description": "Arabic (Libya)"
        },
        {
            "id": "ar_MA",
            "description": "Arabic (Morocco)"
        },
        {
            "id": "ar_OM",
            "description": "Arabic (Oman)"
        },
        {
            "id": "ar_QA",
            "description": "Arabic (Qatar)"
        }
    ],
    "meta": {
        "pagination": {
            "total": 434,
            "count": 20,
            "per_page": 20,
            "current_page": 1,
            "total_pages": 22,
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
## Get specified I18n lang

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
## Create and store new I18n lang

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/i18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "id"="Sint ipsam autem" \
    -d "description"="Reprehenderit dicta corporis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang",
    "method": "POST",
    "data": {
        "id": "Sint ipsam autem",
        "description": "Reprehenderit dicta corporis"
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
## Update a I18n lang

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "description"="Numquam dolor voluptatem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/i18nLang/en_US",
    "method": "PUT",
    "data": {
        "description": "Numquam dolor voluptatem"
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

#Me
<!-- START_01138559f486b5b7c062a19b1c0412fe -->
## Get curent user

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
        "created_at": "2017-04-03 10:03:36",
        "updated_at": "2017-04-03 10:03:36"
    }
}
```

### HTTP Request
`GET /api/me`

`HEAD /api/me`


<!-- END_01138559f486b5b7c062a19b1c0412fe -->

#Project
<!-- START_0244828c4ebed3e3aa5d2acc7f432f35 -->
## Project list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>20</code>.</aside>

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
            "data_stream_id": null,
            "name": "John Smith Sample Project 1",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        }
    ],
    "meta": {
        "pagination": {
            "total": 3,
            "count": 3,
            "per_page": 20,
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
## Get specified user project

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
        "data_stream_id": null,
        "name": "John Smith Sample Project 1",
        "created_at": "2017-04-03 10:03:36",
        "updated_at": "2017-04-03 10:03:36"
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
    -d "search_engine_id"="c697ede7-182c-30b9-9d18-697a136c1a7b" \
    -d "data_stream_id"="6aacbace-6f88-3a9d-b295-26110973645a" \
    -d "name"="Voluptas est sit" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "search_engine_id": "c697ede7-182c-30b9-9d18-697a136c1a7b",
        "data_stream_id": "6aacbace-6f88-3a9d-b295-26110973645a",
        "name": "Voluptas est sit"
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
## Update a specified user project

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_engine_id"="1ad0bb76-50c0-32e0-957b-2c60641c6665" \
    -d "data_stream_id"="3a8ebb28-3cf8-3024-a056-3d191ddeae52" \
    -d "name"="Excepturi cum illum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "search_engine_id": "1ad0bb76-50c0-32e0-957b-2c60641c6665",
        "data_stream_id": "3a8ebb28-3cf8-3024-a056-3d191ddeae52",
        "name": "Excepturi cum illum"
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

#SearchEngine
<!-- START_4782f8649a902914ec1963f2a78da258 -->
## Show Search Engine list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>20</code>.</aside>

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
            "created_at": "2017-04-03 10:03:33",
            "updated_at": "2017-04-03 10:03:33"
        }
    ],
    "meta": {
        "pagination": {
            "total": 1,
            "count": 1,
            "per_page": 20,
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
## Get specified Search Engine

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
        "created_at": "2017-04-03 10:03:33",
        "updated_at": "2017-04-03 10:03:33"
    }
}
```

### HTTP Request
`GET /api/searchEngine/{searchEngineId}`

`HEAD /api/searchEngine/{searchEngineId}`


<!-- END_2722bd2e446fc75e00b2f6449ed3d886 -->

<!-- START_015a6f5a15d1264cadd2a7585faf54ac -->
## Create and store new Search Engine

> Example request:

```bash
curl -X POST "http://emsearch.ryan.ems-dev.net/api/searchEngine" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Odit minima esse" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine",
    "method": "POST",
    "data": {
        "name": "Odit minima esse"
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
## Update a Search Engine

> Example request:

```bash
curl -X PUT "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Est non corrupti" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "name": "Est non corrupti"
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

#User
<!-- START_79bbe09b8f53b0948351390dffb959af -->
## User list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>20</code>.</aside>

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
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "id": "509dd5c0-1389-11e7-93ae-92361f002671",
            "user_group_id": "Support",
            "name": "Alan Smithee",
            "email": "alan.smithee@domain.tld",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "id": "605c7610-1389-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "John Smith",
            "email": "john.smith@domain.tld",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        }
    ],
    "meta": {
        "pagination": {
            "total": 4,
            "count": 4,
            "per_page": 20,
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
        "created_at": "2017-04-03 10:03:36",
        "updated_at": "2017-04-03 10:03:36"
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
    -d "name"="Ipsam natus numquam" \
    -d "email"="metz.elinore@example.com" \
    -d "password"="d4B&quot;BNh" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user",
    "method": "POST",
    "data": {
        "user_group_id": "Developer",
        "name": "Ipsam natus numquam",
        "email": "metz.elinore@example.com",
        "password": "d4B\"BNh"
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

#UserHasProject
<!-- START_cf0313d53939313429ce6788fa95624c -->
## List of relationships between users and projects


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>20</code>.</aside>

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
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-04-03 10:04:50",
            "updated_at": "2017-04-03 10:04:50"
        }
    ],
    "meta": {
        "pagination": {
            "total": 5,
            "count": 5,
            "per_page": 20,
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
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
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
    -d "user_id"="4e569840-25fc-39d3-8b9a-d8dcb7681f6c" \
    -d "project_id"="21d33dbb-1797-362d-801c-eb97338d1fca" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject",
    "method": "POST",
    "data": {
        "user_id": "4e569840-25fc-39d3-8b9a-d8dcb7681f6c",
        "project_id": "21d33dbb-1797-362d-801c-eb97338d1fca",
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
    -d "user_id"="c9c096a6-9605-386c-a7c1-45371c6e1234" \
    -d "project_id"="d140b71b-7cc8-3482-ab92-3cd60b3b316e" \
    -d "user_role_id"="Administrator" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_id": "c9c096a6-9605-386c-a7c1-45371c6e1234",
        "project_id": "d140b71b-7cc8-3482-ab92-3cd60b3b316e",
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

#UserProject
<!-- START_aa8a35d90f07e0338dcd98a913a63c76 -->
## User project list

You can specify a GET parameter `user_role_id` to filter results.

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project?user_role_id=Administrator" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project?user_role_id=Administrator",
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
            "data_stream_id": null,
            "name": "John Smith Sample Project 1",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-04-03 10:03:36",
            "updated_at": "2017-04-03 10:03:36"
        }
    ],
    "meta": {
        "pagination": {
            "total": 3,
            "count": 3,
            "per_page": 20,
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

<!-- START_28964cc27ab9afa6ce7f99c0bf0dc46b -->
## Get specified user project

> Example request:

```bash
curl -X GET "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project/1bcc7efc-138c-11e7-93ae-92361f002671",
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
        "data_stream_id": null,
        "name": "John Smith Sample Project 1",
        "created_at": "2017-04-03 10:03:36",
        "updated_at": "2017-04-03 10:03:36"
    }
}
```

### HTTP Request
`GET /api/user/{userId}/project/{projectId}`

`HEAD /api/user/{userId}/project/{projectId}`


<!-- END_28964cc27ab9afa6ce7f99c0bf0dc46b -->

