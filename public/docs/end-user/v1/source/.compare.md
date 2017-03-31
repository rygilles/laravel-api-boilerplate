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

<aside class="notice">Minimum / maximum entries limit values can be different according to the route resource complexity</aside>
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
        "id": "605c7610-1389-11e7-93ae-92361f002671",
        "user_group_id": "End-User",
        "name": "John Smith",
        "email": "john.smith@domain.tld",
        "created_at": "2017-03-28 14:46:13",
        "updated_at": "2017-03-28 14:46:13"
    }
}
```

### HTTP Request
`GET /api/me`

`HEAD /api/me`


<!-- END_01138559f486b5b7c062a19b1c0412fe -->

#Project
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
        "created_at": "2017-03-28 14:46:13",
        "updated_at": "2017-03-28 14:46:13"
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
    -d "search_engine_id"="e7c50693-00a1-327a-9412-23b4c40a45c8" \
    -d "data_stream_id"="f7701cd4-a1b8-32c1-ba77-efae17a8a680" \
    -d "name"="Excepturi cum illum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "search_engine_id": "e7c50693-00a1-327a-9412-23b4c40a45c8",
        "data_stream_id": "f7701cd4-a1b8-32c1-ba77-efae17a8a680",
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
    -d "search_engine_id"="a0cb82a2-bcfd-3c4d-9201-eff6b452d7d4" \
    -d "data_stream_id"="68fa5fed-11ce-30a9-9305-ffa6a0760234" \
    -d "name"="Alias cumque et" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "search_engine_id": "a0cb82a2-bcfd-3c4d-9201-eff6b452d7d4",
        "data_stream_id": "68fa5fed-11ce-30a9-9305-ffa6a0760234",
        "name": "Alias cumque et"
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

#User Project
<!-- START_aa8a35d90f07e0338dcd98a913a63c76 -->
## User project list

You can specify a GET parameter `user_role_id` to filter results.

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
            "data_stream_id": null,
            "name": "John Smith Sample Project 1",
            "created_at": "2017-03-28 14:46:13",
            "updated_at": "2017-03-28 14:46:13"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-03-28 14:46:13",
            "updated_at": "2017-03-28 14:46:13"
        }
    ],
    "meta": {
        "pagination": {
            "total": 2,
            "count": 2,
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
        "created_at": "2017-03-28 14:46:13",
        "updated_at": "2017-03-28 14:46:13"
    }
}
```

### HTTP Request
`GET /api/user/{userId}/project/{projectId}`

`HEAD /api/user/{userId}/project/{projectId}`


<!-- END_28964cc27ab9afa6ce7f99c0bf0dc46b -->

