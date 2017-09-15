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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream",
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
            "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
            "name": "John Smith Sample Project Data Stream",
            "feed_url": "https:\/\/www.e-monsite.com\/blog\/do\/datastream\/",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "605d712c-1934-11e7-93ae-92361f002671",
            "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
            "name": "Mickey Mouse Sample Project Data Stream",
            "feed_url": "https:\/\/www.e-monsite.com\/blog\/do\/datastream\/",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_decoder_id"="e83a109a-ccd7-3357-b874-e1766c0cafe0" \
    -d "name"="Libero nostrum molestias" \
    -d "feed_url"="http://schneider.com/nostrum-est-quos-cum-alias-quas-repellat-dolore-sunt.html" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "e83a109a-ccd7-3357-b874-e1766c0cafe0",
        "name": "Libero nostrum molestias",
        "feed_url": "http:\/\/schneider.com\/nostrum-est-quos-cum-alias-quas-repellat-dolore-sunt.html"
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
    data_stream_decoder_id | string |  required  | UUID Valid data_stream_decoder id
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_9806e6f48b29aa520cbf710b72b4fa3e -->

<!-- START_87948eda1c008b091811da4bfc7cd218 -->
## Update a data stream

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_decoder_id"="25703485-6c6d-39fe-8833-a535b548632c" \
    -d "name"="Voluptas corporis quia" \
    -d "feed_url"="https://www.ledner.com/cupiditate-animi-in-eaque-eos-minus-quia" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "25703485-6c6d-39fe-8833-a535b548632c",
        "name": "Voluptas corporis quia",
        "feed_url": "https:\/\/www.ledner.com\/cupiditate-animi-in-eaque-eos-minus-quia"
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
    data_stream_decoder_id | string |  required  | UUID Valid data_stream_decoder id
    name | string |  required  | Maximum: `200`
    feed_url | url |  required  | 

<!-- END_87948eda1c008b091811da4bfc7cd218 -->

<!-- START_0402b256ba5cab23aa735079addbfe3e -->
## Delete specified data stream

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
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
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
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
    -d "data_stream_decoder_id"="ce2a27f0-ea03-3b24-a02b-e65656862f00" \
    -d "name"="Voluptas minima animi" \
    -d "feed_url"="http://gorczany.biz/consequatur-sed-molestiae-qui" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "ce2a27f0-ea03-3b24-a02b-e65656862f00",
        "name": "Voluptas minima animi",
        "feed_url": "http:\/\/gorczany.biz\/consequatur-sed-molestiae-qui"
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
    -d "data_stream_decoder_id"="ef47b10c-af91-3a4a-ada7-82abe857293b" \
    -d "name"="Non veniam dolore" \
    -d "feed_url"="http://www.ankunding.com/eum-voluptate-et-aliquam-eligendi-minus-consequuntur-ut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/dataStream",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "ef47b10c-af91-3a4a-ada7-82abe857293b",
        "name": "Non veniam dolore",
        "feed_url": "http:\/\/www.ankunding.com\/eum-voluptate-et-aliquam-eligendi-minus-consequuntur-ut"
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

<!-- START_6c118c8a40f2e0a928a0b386584f151b -->
## I18n lang data streams list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang/en/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en/dataStream",
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
            "id": "605d712c-1934-11e7-93ae-92361f002671",
            "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
            "name": "Mickey Mouse Sample Project Data Stream",
            "feed_url": "https:\/\/www.e-monsite.com\/blog\/do\/datastream\/",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/i18nLang/{i18nLangId}/dataStream`

`HEAD /api/i18nLang/{i18nLangId}/dataStream`


<!-- END_6c118c8a40f2e0a928a0b386584f151b -->

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
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
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
        "created_at": "2017-09-14 13:08:25",
        "updated_at": "2017-09-14 13:08:25"
    }
}
```

### HTTP Request
`GET /api/dataStreamDecoder/{dataStreamDecoderId}`

`HEAD /api/dataStreamDecoder/{dataStreamDecoderId}`


<!-- END_049ef8cf901ed40324a483e5d7e5890c -->

<!-- START_b50a178d1d8a0de1e81b3256ceeb1215 -->
## Create and store new data stream decoder

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Ut et et" \
    -d "class_name"="Minus iusto similique" \
    -d "file_mime_type"="Laboriosam est quo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder",
    "method": "POST",
    "data": {
        "name": "Ut et et",
        "class_name": "Minus iusto similique",
        "file_mime_type": "Laboriosam est quo"
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
`POST /api/dataStreamDecoder`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Minimum: `5` Maximum: `200`
    class_name | string |  required  | 
    file_mime_type | string |  required  | 

<!-- END_b50a178d1d8a0de1e81b3256ceeb1215 -->

<!-- START_501935d1e31d5941cd4788c04c355a06 -->
## Update a data stream decoder

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Et non reiciendis" \
    -d "class_name"="Hic quas laborum" \
    -d "file_mime_type"="Et architecto eum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "name": "Et non reiciendis",
        "class_name": "Hic quas laborum",
        "file_mime_type": "Et architecto eum"
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
`PUT /api/dataStreamDecoder/{dataStreamDecoderId}`

`PATCH /api/dataStreamDecoder/{dataStreamDecoderId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Minimum: `5` Maximum: `200`
    class_name | string |  required  | 
    file_mime_type | string |  required  | 

<!-- END_501935d1e31d5941cd4788c04c355a06 -->

<!-- START_b90290a79243f48f6887768e82b4ecc5 -->
## Delete specified data stream decoder

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0",
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
`DELETE /api/dataStreamDecoder/{dataStreamDecoderId}`


<!-- END_b90290a79243f48f6887768e82b4ecc5 -->

#DataStreamField
<!-- START_1f0df6729ce1e819c646e60ae411212b -->
## Show data stream field list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamField",
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
            "id": "145ca4a6-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "title",
            "path": "title",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145ca730-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145ca848-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145ca9ba-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145cac44-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145cad20-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145cade8-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145caeb0-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145cb13a-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "145cb27a-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "rating_count",
            "path": "rating_count",
            "versioned": false,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        }
    ],
    "meta": {
        "pagination": {
            "total": 22,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 3,
            "links": {
                "next": "https:\/\/emsearch.ryan.ems-dev.net\/api\/dataStreamField?page=2"
            }
        }
    }
}
```

### HTTP Request
`GET /api/dataStreamField`

`HEAD /api/dataStreamField`


<!-- END_1f0df6729ce1e819c646e60ae411212b -->

<!-- START_0c68b59d60b2dcf52f0f70c04fe5189d -->
## Get specified data stream field

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamField/36116fa6-5c0d-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamField/36116fa6-5c0d-11e7-907b-a6006ad3dba0",
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
        "id": "36116fa6-5c0d-11e7-907b-a6006ad3dba0",
        "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
        "name": "title",
        "path": "title",
        "versioned": true,
        "searchable": true,
        "to_retrieve": true,
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
    }
}
```

### HTTP Request
`GET /api/dataStreamField/{dataStreamFieldId}`

`HEAD /api/dataStreamField/{dataStreamFieldId}`


<!-- END_0c68b59d60b2dcf52f0f70c04fe5189d -->

<!-- START_e4f5a62a1fdf37d9ab9dbf645399ebf4 -->
## Create and store new data stream field

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/dataStreamField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_id"="2f7af4b9-be60-39d2-b3e4-2239cdb0ce1f" \
    -d "name"="Sed id id" \
    -d "path"="Corporis earum debitis" \
    -d "versioned"="1" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamField",
    "method": "POST",
    "data": {
        "data_stream_id": "2f7af4b9-be60-39d2-b3e4-2239cdb0ce1f",
        "name": "Sed id id",
        "path": "Corporis earum debitis",
        "versioned": true,
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
`POST /api/dataStreamField`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_id | string |  required  | UUID Valid data_stream id
    name | string |  required  | Minimum: `1` Maximum: `200`
    path | string |  required  | Minimum: `1` Maximum: `1000`
    versioned | boolean |  required  | 
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_e4f5a62a1fdf37d9ab9dbf645399ebf4 -->

<!-- START_d7b37b405a727213cd116589814ddfbc -->
## Update a data stream field

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/dataStreamField/36116fa6-5c0d-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_id"="d4011948-3af3-3828-9ce4-954e3f07639e" \
    -d "name"="Explicabo libero eius" \
    -d "path"="Vel quas quae" \
    -d "versioned"="1" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamField/36116fa6-5c0d-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "data_stream_id": "d4011948-3af3-3828-9ce4-954e3f07639e",
        "name": "Explicabo libero eius",
        "path": "Vel quas quae",
        "versioned": true,
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
`PUT /api/dataStreamField/{dataStreamFieldId}`

`PATCH /api/dataStreamField/{dataStreamFieldId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_id | string |  required  | UUID Valid data_stream id
    name | string |  required  | Minimum: `1` Maximum: `200`
    path | string |  required  | Minimum: `1` Maximum: `1000`
    versioned | boolean |  required  | 
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_d7b37b405a727213cd116589814ddfbc -->

<!-- START_0d343d9925b1c16cb0f8169fcb2daa1b -->
## Delete specified data stream field

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/dataStreamField/36116fa6-5c0d-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamField/36116fa6-5c0d-11e7-907b-a6006ad3dba0",
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
`DELETE /api/dataStreamField/{dataStreamFieldId}`


<!-- END_0d343d9925b1c16cb0f8169fcb2daa1b -->

<!-- START_4b156587d4848b382a843ec6a22a2afe -->
## Data stream data stream field list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStream/737441b0-57ea-11e7-907b-a6006ad3dba0/dataStreamField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/737441b0-57ea-11e7-907b-a6006ad3dba0/dataStreamField",
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
`GET /api/dataStream/{dataStreamPresetId}/dataStreamField`

`HEAD /api/dataStream/{dataStreamPresetId}/dataStreamField`


<!-- END_4b156587d4848b382a843ec6a22a2afe -->

#DataStreamHasI18nLang
<!-- START_6480b30fcf62aed727b8d054f27d2ba4 -->
## List of relationships between data streams and i18n langs


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang",
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
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "fr",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "en",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "fr",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/dataStreamHasI18nLang`

`HEAD /api/dataStreamHasI18nLang`


<!-- END_6480b30fcf62aed727b8d054f27d2ba4 -->

<!-- START_c8d4458275668d086a4bba4c84949459 -->
## Get specified relationship between a data stream and a i18n lang

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en",
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
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "en",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        }
    ]
}
```

### HTTP Request
`GET /api/dataStreamHasI18nLang/{dataStreamId},{i18nLangId}`

`HEAD /api/dataStreamHasI18nLang/{dataStreamId},{i18nLangId}`


<!-- END_c8d4458275668d086a4bba4c84949459 -->

<!-- START_feae1493ce50aede965c560ad5a43044 -->
## Create and store new relationship between a data stream and a i18n lang

<aside class="notice">Only one relationship per data stream/i18n lang is allowed.</aside>

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_id"="1ad0bb76-50c0-32e0-957b-2c60641c6665" \
    -d "i18n_lang_id"="Deleniti id magnam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang",
    "method": "POST",
    "data": {
        "data_stream_id": "1ad0bb76-50c0-32e0-957b-2c60641c6665",
        "i18n_lang_id": "Deleniti id magnam"
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
`POST /api/dataStreamHasI18nLang`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_id | string |  required  | UUID Valid data_stream id
    i18n_lang_id | string |  required  | Maximum: `30` Valid i18n_lang id

<!-- END_feae1493ce50aede965c560ad5a43044 -->

<!-- START_aaebcb033986fbd8103cec98df10ccbe -->
## Update a specified relationship between a data stream and a i18n lang

<aside class="notice">Only one relationship per data stream/i18n lang is allowed.</aside>

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_id"="11691d12-2176-39d0-b90c-b952034fd22b" \
    -d "i18n_lang_id"="Ab consequatur cum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en",
    "method": "PUT",
    "data": {
        "data_stream_id": "11691d12-2176-39d0-b90c-b952034fd22b",
        "i18n_lang_id": "Ab consequatur cum"
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
`PUT /api/dataStreamHasI18nLang/{dataStreamId},{i18nLangId}`

`PATCH /api/dataStreamHasI18nLang/{dataStreamId},{i18nLangId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_id | string |  required  | UUID Valid data_stream id
    i18n_lang_id | string |  required  | Maximum: `30` Valid i18n_lang id

<!-- END_aaebcb033986fbd8103cec98df10ccbe -->

<!-- START_f2ba37d64397dbbce91ca71158e5fdf1 -->
## Delete specified relationship between a data stream and a i18n lang

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en",
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
`DELETE /api/dataStreamHasI18nLang/{dataStreamId},{i18nLangId}`


<!-- END_f2ba37d64397dbbce91ca71158e5fdf1 -->

<!-- START_f477825a313f90bc4ef00fb9d0cf638e -->
## Data stream relationship between data stream and i18n langs list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671/dataStreamHasI18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671/dataStreamHasI18nLang",
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
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "en",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "fr",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/dataStream/{dataStreamId}/dataStreamHasI18nLang`

`HEAD /api/dataStream/{dataStreamId}/dataStreamHasI18nLang`


<!-- END_f477825a313f90bc4ef00fb9d0cf638e -->

#DataStreamPreset
<!-- START_0b4fd875b346dbe345c23d1801f866b3 -->
## Show data stream preset list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset",
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
            "id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/dataStreamPreset`

`HEAD /api/dataStreamPreset`


<!-- END_0b4fd875b346dbe345c23d1801f866b3 -->

<!-- START_3dda0a43b3eb27bef79c680ee7482a24 -->
## Get specified data stream preset

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0",
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
        "id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
        "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
        "name": "E-monsite | Blog",
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
    }
}
```

### HTTP Request
`GET /api/dataStreamPreset/{dataStreamPresetId}`

`HEAD /api/dataStreamPreset/{dataStreamPresetId}`


<!-- END_3dda0a43b3eb27bef79c680ee7482a24 -->

<!-- START_fcb8c326abb10a330133ecb6e0c6fb5c -->
## Create and store new data stream preset

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_decoder_id"="d648d0ff-2d41-392a-a2b6-faa6dbfdcb0e" \
    -d "name"="Minus iusto similique" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "d648d0ff-2d41-392a-a2b6-faa6dbfdcb0e",
        "name": "Minus iusto similique"
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
`POST /api/dataStreamPreset`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_decoder_id | string |  required  | UUID Valid data_stream_decoder id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_fcb8c326abb10a330133ecb6e0c6fb5c -->

<!-- START_16ee649a259d09a1980a4bc4af7c80fe -->
## Update a data stream preset

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_decoder_id"="b7c15ad0-6d79-362d-984b-23500feae451" \
    -d "name"="Necessitatibus voluptatem quidem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "b7c15ad0-6d79-362d-984b-23500feae451",
        "name": "Necessitatibus voluptatem quidem"
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
`PUT /api/dataStreamPreset/{dataStreamPresetId}`

`PATCH /api/dataStreamPreset/{dataStreamPresetId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_decoder_id | string |  required  | UUID Valid data_stream_decoder id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_16ee649a259d09a1980a4bc4af7c80fe -->

<!-- START_c65fa9da0dc112404e228609c4670716 -->
## Delete specified data stream preset

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0",
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
`DELETE /api/dataStreamPreset/{dataStreamPresetId}`


<!-- END_c65fa9da0dc112404e228609c4670716 -->

#DataStreamPresetField
<!-- START_75862ed35d114fa77a5e61218c4da260 -->
## Data stream preset data stream preset field list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0/dataStreamPresetField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0/dataStreamPresetField",
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
            "id": "76952b58-5bf4-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "rating_avg",
            "path": "rating_avg",
            "versioned": false,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "title",
            "path": "title",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cba20-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc15a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc34e-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc650-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9ccec0-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        }
    ],
    "meta": {
        "pagination": {
            "total": 11,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 2,
            "links": {
                "next": "https:\/\/emsearch.ryan.ems-dev.net\/api\/dataStreamPreset\/737441b0-57ea-11e7-907b-a6006ad3dba0\/dataStreamPresetField?page=2"
            }
        }
    }
}
```

### HTTP Request
`GET /api/dataStreamPreset/{dataStreamPresetId}/dataStreamPresetField`

`HEAD /api/dataStreamPreset/{dataStreamPresetId}/dataStreamPresetField`


<!-- END_75862ed35d114fa77a5e61218c4da260 -->

<!-- START_6f15b3cda4cc937a021b5fb91f58e027 -->
## Show data stream preset field list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField",
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
            "id": "76952b58-5bf4-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "rating_avg",
            "path": "rating_avg",
            "versioned": false,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "title",
            "path": "title",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cba20-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc15a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc34e-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc650-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "eb9ccec0-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        }
    ],
    "meta": {
        "pagination": {
            "total": 11,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 2,
            "links": {
                "next": "https:\/\/emsearch.ryan.ems-dev.net\/api\/dataStreamPresetField?page=2"
            }
        }
    }
}
```

### HTTP Request
`GET /api/dataStreamPresetField`

`HEAD /api/dataStreamPresetField`


<!-- END_6f15b3cda4cc937a021b5fb91f58e027 -->

<!-- START_bc03b2e88441ee42adadace0caf20741 -->
## Get specified data stream preset field

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField/eb9cb642-5bf3-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField/eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
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
        "id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
        "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
        "name": "title",
        "path": "title",
        "versioned": true,
        "searchable": true,
        "to_retrieve": true,
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
    }
}
```

### HTTP Request
`GET /api/dataStreamPresetField/{dataStreamPresetFieldId}`

`HEAD /api/dataStreamPresetField/{dataStreamPresetFieldId}`


<!-- END_bc03b2e88441ee42adadace0caf20741 -->

<!-- START_c21283e0310a4b81f281adbe1933001b -->
## Create and store new data stream preset field

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_preset_id"="9b3b4305-9f73-31e8-8c95-1768be3a91d2" \
    -d "name"="Qui explicabo et" \
    -d "path"="Sit ea distinctio" \
    -d "versioned"="1" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField",
    "method": "POST",
    "data": {
        "data_stream_preset_id": "9b3b4305-9f73-31e8-8c95-1768be3a91d2",
        "name": "Qui explicabo et",
        "path": "Sit ea distinctio",
        "versioned": true,
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
`POST /api/dataStreamPresetField`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_preset_id | string |  required  | UUID Valid data_stream_preset id
    name | string |  required  | Minimum: `1` Maximum: `200`
    path | string |  required  | Minimum: `1` Maximum: `1000`
    versioned | boolean |  required  | 
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_c21283e0310a4b81f281adbe1933001b -->

<!-- START_f764c10ff69335d8a10eb0ba1d2e41c0 -->
## Update a data stream preset field

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField/eb9cb642-5bf3-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_preset_id"="84d502c8-217a-3ea3-8a24-2a0d67689962" \
    -d "name"="Qui sit nostrum" \
    -d "path"="Saepe inventore sit" \
    -d "versioned"="1" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField/eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "data_stream_preset_id": "84d502c8-217a-3ea3-8a24-2a0d67689962",
        "name": "Qui sit nostrum",
        "path": "Saepe inventore sit",
        "versioned": true,
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
`PUT /api/dataStreamPresetField/{dataStreamPresetFieldId}`

`PATCH /api/dataStreamPresetField/{dataStreamPresetFieldId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_preset_id | string |  required  | UUID Valid data_stream_preset id
    name | string |  required  | Minimum: `1` Maximum: `200`
    path | string |  required  | Minimum: `1` Maximum: `1000`
    versioned | boolean |  required  | 
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_f764c10ff69335d8a10eb0ba1d2e41c0 -->

<!-- START_bcaded0d531e779f9cf880757f234fab -->
## Delete specified data stream preset field

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField/eb9cb642-5bf3-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPresetField/eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
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
`DELETE /api/dataStreamPresetField/{dataStreamPresetFieldId}`


<!-- END_bcaded0d531e779f9cf880757f234fab -->

#I18nLang
<!-- START_c4cb0bd14e699c53142a32038ed2546c -->
## Data stream i18n lang list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671/i18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671/i18nLang",
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
            "id": "en",
            "description": "English"
        },
        {
            "id": "fr",
            "description": "French"
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
`GET /api/dataStream/{dataStreamId}/i18nLang`

`HEAD /api/dataStream/{dataStreamId}/i18nLang`


<!-- END_c4cb0bd14e699c53142a32038ed2546c -->

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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang/en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en",
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
        "id": "en",
        "description": "English"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/i18nLang" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "id"="Delectus a recusandae" \
    -d "description"="Voluptas alias magni" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang",
    "method": "POST",
    "data": {
        "id": "Delectus a recusandae",
        "description": "Voluptas alias magni"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/i18nLang/en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "description"="Est ducimus id" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en",
    "method": "PUT",
    "data": {
        "description": "Est ducimus id"
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
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/i18nLang/en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en",
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
        "id": "41abdec2-1389-11e7-93ae-92361f002671",
        "user_group_id": "Developer",
        "name": "John Doe",
        "email": "john.doe@domain.tld",
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
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
    "url": "https://emsearch.ryan.ems-dev.net/api/me/notification?read_status=unread?read_status=read",
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/read" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/read",
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/unread" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/me/notification/{notificationId}/unread",
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
    "url": "https://emsearch.ryan.ems-dev.net/api/me/project?user_role_id=Owner?user_role_id=Administrator",
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project?user_role_id=Owner" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project?user_role_id=Owner?user_role_id=Administrator",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
        "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
        "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
        "name": "John Smith Sample Project 1",
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
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
    -d "search_engine_id"="5d378982-faaa-32d3-a283-f5e51e14c4c4" \
    -d "data_stream_id"="ab78b4f6-32ca-3218-82b1-7ab316991382" \
    -d "name"="Et nobis pariatur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "search_engine_id": "5d378982-faaa-32d3-a283-f5e51e14c4c4",
        "data_stream_id": "ab78b4f6-32ca-3218-82b1-7ab316991382",
        "name": "Et nobis pariatur"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_engine_id"="922fe037-9be6-3a94-b9a1-6081f19090a0" \
    -d "data_stream_id"="78a5e3c1-34c9-3016-ab99-7aa8d573e5a4" \
    -d "name"="Cumque non laboriosam" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "search_engine_id": "922fe037-9be6-3a94-b9a1-6081f19090a0",
        "data_stream_id": "78a5e3c1-34c9-3016-ab99-7aa8d573e5a4",
        "name": "Cumque non laboriosam"
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

<!-- START_5422def9f3ee3793fdd3b81ad0bce1b0 -->
## Search engine project list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671/project" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671/project",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchEngine" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchEngine",
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
            "class_name": "AlgoliaSearchEngine",
            "created_at": "2017-09-14 13:08:24",
            "updated_at": "2017-09-14 13:08:24",
            "projects_count": 3
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671",
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
        "class_name": "AlgoliaSearchEngine",
        "created_at": "2017-09-14 13:08:24",
        "updated_at": "2017-09-14 13:08:24",
        "projects_count": 3
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/searchEngine" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Temporibus magnam ut" \
    -d "class_name"="Cum qui laudantium" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchEngine",
    "method": "POST",
    "data": {
        "name": "Temporibus magnam ut",
        "class_name": "Cum qui laudantium"
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
    class_name | string |  required  | 

<!-- END_015a6f5a15d1264cadd2a7585faf54ac -->

<!-- START_799a20e4e8308abe543bbd9509f1d445 -->
## Update a search engine

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "name"="Doloribus a ut" \
    -d "class_name"="Adipisci possimus qui" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "name": "Doloribus a ut",
        "class_name": "Adipisci possimus qui"
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
    class_name | string |  required  | 

<!-- END_799a20e4e8308abe543bbd9509f1d445 -->

<!-- START_1f959d663af6a541ba1b38647d63575b -->
## Delete specified search engine

<aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchEngine/ee87e3b2-1388-11e7-93ae-92361f002671",
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
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/search?query_string=site internet&amp;i18n_lang_id=fr&amp;page=1&amp;limit=5?query_string=Fugiat dolores officiisi18n_lang_id=Vero beatae idpage=1319307462limit=661139543",
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
            "total": 12,
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
    page | integer |  optional  | Minimum: `1`
    limit | integer |  optional  | Minimum: `1`

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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35",
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

<!-- START_4ddd0123679f1005b211d72ba061d315 -->
## Show search use case list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCase" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35",
            "search_use_case_fields_count": 3
        },
        {
            "id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project Default Search Use Case",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35",
            "search_use_case_fields_count": 3
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
`GET /api/searchUseCase`

`HEAD /api/searchUseCase`


<!-- END_4ddd0123679f1005b211d72ba061d315 -->

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
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35",
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
    -d "project_id"="3cf5f07e-62a4-38cf-942b-978f9ac2cf17" \
    -d "name"="Asperiores earum eos" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase",
    "method": "POST",
    "data": {
        "project_id": "3cf5f07e-62a4-38cf-942b-978f9ac2cf17",
        "name": "Asperiores earum eos"
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
    -d "project_id"="d05c5b68-90d6-3a10-a592-fb620906ff4b" \
    -d "name"="Hic porro voluptates" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "project_id": "d05c5b68-90d6-3a10-a592-fb620906ff4b",
        "name": "Hic porro voluptates"
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
<!-- START_c10e20e0c546865046b2a65c41f13ddc -->
## Show search use case field list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCaseField",
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
            "search_use_case_id": "37f79df8-707c-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "145ca4a6-60af-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_id": "37f79df8-707c-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "145ca730-60af-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_id": "37f79df8-707c-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "145cade8-60af-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36116fa6-5c0d-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36117334-5c0d-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36118072-5c0d-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/searchUseCaseField`

`HEAD /api/searchUseCaseField`


<!-- END_c10e20e0c546865046b2a65c41f13ddc -->

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
        "searchable": 1,
        "to_retrieve": 1,
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
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
    -d "search_use_case_id"="040a6032-9240-3544-8014-93ce33cbd33e" \
    -d "data_stream_field_id"="02e67467-0d4a-35b1-b728-10ac4324520f" \
    -d "name"="Reprehenderit assumenda voluptatem" \
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
        "search_use_case_id": "040a6032-9240-3544-8014-93ce33cbd33e",
        "data_stream_field_id": "02e67467-0d4a-35b1-b728-10ac4324520f",
        "name": "Reprehenderit assumenda voluptatem",
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
    -d "search_use_case_id"="425f593b-dd82-3219-afcd-4bdeb58ff842" \
    -d "data_stream_field_id"="cc8b7dc1-5fa8-3c8d-9569-37fdadbadac2" \
    -d "name"="Qui explicabo aut" \
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
        "search_use_case_id": "425f593b-dd82-3219-afcd-4bdeb58ff842",
        "data_stream_field_id": "cc8b7dc1-5fa8-3c8d-9569-37fdadbadac2",
        "name": "Qui explicabo aut",
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
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36117334-5c0d-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36118072-5c0d-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35",
            "search_use_case_preset_fields_count": 3
        },
        {
            "id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35",
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
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35",
        "search_use_case_preset_fields_count": 3
    }
}
```

### HTTP Request
`GET /api/searchUseCasePreset/{searchUseCasePresetId}`

`HEAD /api/searchUseCasePreset/{searchUseCasePresetId}`


<!-- END_8ebcce24204dfb4e69f2beb73bdda1e9 -->

<!-- START_883bc6e3e63a11905951a3a5ca3e9f32 -->
## Create and store new search use case preset

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_preset_id"="e537dfec-3b82-3197-8d1a-98aab4ddbfff" \
    -d "name"="Vero dolor necessitatibus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset",
    "method": "POST",
    "data": {
        "data_stream_preset_id": "e537dfec-3b82-3197-8d1a-98aab4ddbfff",
        "name": "Vero dolor necessitatibus"
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
`POST /api/searchUseCasePreset`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_preset_id | string |  required  | UUID Valid data_stream_preset id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_883bc6e3e63a11905951a3a5ca3e9f32 -->

<!-- START_1f3a89fe8c57b99c3c528428a6df674d -->
## Update a search use case preset

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_preset_id"="4dc80582-cc72-32ca-9ab8-915b0a5d3cb7" \
    -d "name"="Libero qui eum" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34",
    "method": "PUT",
    "data": {
        "data_stream_preset_id": "4dc80582-cc72-32ca-9ab8-915b0a5d3cb7",
        "name": "Libero qui eum"
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
`PUT /api/searchUseCasePreset/{searchUseCasePresetId}`

`PATCH /api/searchUseCasePreset/{searchUseCasePresetId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    data_stream_preset_id | string |  required  | UUID Valid data_stream_preset id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_1f3a89fe8c57b99c3c528428a6df674d -->

<!-- START_9d5e4e7d94fb438485b92bc2b48480fb -->
## Delete specified search use case preset

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34",
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
`DELETE /api/searchUseCasePreset/{searchUseCasePresetId}`


<!-- END_9d5e4e7d94fb438485b92bc2b48480fb -->

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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35",
            "search_use_case_preset_fields_count": 0
        },
        {
            "id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35",
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
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "name": "image_url",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
        "searchable": 1,
        "to_retrieve": 1,
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
    }
}
```

### HTTP Request
`GET /api/searchUseCasePresetField/{searchUseCasePresetId},{dataStreamPresetFieldId}`

`HEAD /api/searchUseCasePresetField/{searchUseCasePresetId},{dataStreamPresetFieldId}`


<!-- END_6814d4579253211626d4f9e34d697b18 -->

<!-- START_43365ad3d855704a0fdd33badd2a2d8c -->
## Create and store new search use case preset field

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_preset_id"="c6a4dab3-bbeb-3179-b61c-088d62e93e58" \
    -d "data_stream_preset_field_id"="f679d4a1-4eca-312a-905d-01c62dbd2f4f" \
    -d "name"="Ut perferendis ut" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField",
    "method": "POST",
    "data": {
        "search_use_case_preset_id": "c6a4dab3-bbeb-3179-b61c-088d62e93e58",
        "data_stream_preset_field_id": "f679d4a1-4eca-312a-905d-01c62dbd2f4f",
        "name": "Ut perferendis ut",
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
`POST /api/searchUseCasePresetField`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_preset_id | string |  required  | UUID Valid search_use_case_preset id
    data_stream_preset_field_id | string |  required  | UUID Valid data_stream_preset_field id
    name | string |  required  | Minimum: `1` Maximum: `200`
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_43365ad3d855704a0fdd33badd2a2d8c -->

<!-- START_1b343aff4ee0aea3816cd487a3e4132d -->
## Update a specified search use case preset field

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField/516f0252-7767-11e7-b5a5-be2e44b06b34,eb9cb642-5bf3-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_preset_id"="28371f95-8c72-328c-b616-3e2b7d93dbf8" \
    -d "data_stream_preset_field_id"="6aacbace-6f88-3a9d-b295-26110973645a" \
    -d "name"="Hic et autem" \
    -d "searchable"="1" \
    -d "to_retrieve"="1" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField/516f0252-7767-11e7-b5a5-be2e44b06b34,eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "search_use_case_preset_id": "28371f95-8c72-328c-b616-3e2b7d93dbf8",
        "data_stream_preset_field_id": "6aacbace-6f88-3a9d-b295-26110973645a",
        "name": "Hic et autem",
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
`PUT /api/searchUseCasePresetField/{searchUseCasePresetId},{dataStreamPresetFieldId}`

`PATCH /api/searchUseCasePresetField/{searchUseCasePresetId},{dataStreamPresetFieldId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_preset_id | string |  required  | UUID Valid search_use_case_preset id
    data_stream_preset_field_id | string |  required  | UUID Valid data_stream_preset_field id
    name | string |  required  | Minimum: `1` Maximum: `200`
    searchable | boolean |  required  | 
    to_retrieve | boolean |  required  | 

<!-- END_1b343aff4ee0aea3816cd487a3e4132d -->

<!-- START_4b5a0cdf0053d670ab0dabb2b746b499 -->
## Delete specified search use case preset field

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField/516f0252-7767-11e7-b5a5-be2e44b06b34,eb9cb642-5bf3-11e7-907b-a6006ad3dba0" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePresetField/516f0252-7767-11e7-b5a5-be2e44b06b34,eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
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
`DELETE /api/searchUseCasePresetField/{searchUseCasePresetId},{dataStreamPresetFieldId}`


<!-- END_4b5a0cdf0053d670ab0dabb2b746b499 -->

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
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "searchable": 1,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": 0,
            "to_retrieve": 1,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
<!-- START_bfc41d85f90ecc0fcd7613be812fb092 -->
## Sync item list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncItem" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncItem",
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
            "item_id": "4f72bc631fdb000000005224",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "80bce7901713e6ce067b458b3cd6fedc",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc631fdb000000005224",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "item_signature": "2aa41d49c19a1539c0e754368ab4ba5e",
            "created_at": "2017-09-15 12:03:59",
            "updated_at": "2017-09-15 12:03:59"
        },
        {
            "item_id": "4f72bc63f307000000002fc7",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "a105ea325f43bed324be09412d9c84a6",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc63f307000000002fc7",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "item_signature": "840d7825db1b1e73e868ed663d295dd3",
            "created_at": "2017-09-15 12:03:59",
            "updated_at": "2017-09-15 12:03:59"
        },
        {
            "item_id": "4f72bc640e6800000000aa73",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "6b72932de7dda8f1dc8cd643364893e1",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc640e6800000000aa73",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "item_signature": "a8d1631cfe746ed663934603ce683542",
            "created_at": "2017-09-15 12:03:59",
            "updated_at": "2017-09-15 12:03:59"
        },
        {
            "item_id": "4f72bc641f5f00000000ab92",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "2832ee61c4da00a50b1b40088b8b5f1e",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc641f5f00000000ab92",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "item_signature": "e088b3ffd2c6a817f220dd447fb10f41",
            "created_at": "2017-09-15 12:03:59",
            "updated_at": "2017-09-15 12:03:59"
        },
        {
            "item_id": "4f72bc643160000000000cea",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "1e66e961fe69f7b35c230ce0be26e869",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc643160000000000cea",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "item_signature": "840a9922d290d5af5b843a8738339920",
            "created_at": "2017-09-15 12:03:59",
            "updated_at": "2017-09-15 12:03:59"
        }
    ],
    "meta": {
        "pagination": {
            "total": 1474,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 148,
            "links": {
                "next": "https:\/\/emsearch.ryan.ems-dev.net\/api\/syncItem?page=2"
            }
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
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
    "data": []
}
```

### HTTP Request
`GET /api/syncItem/{syncItemId},{projectId}`

`HEAD /api/syncItem/{syncItemId},{projectId}`


<!-- END_7f0ee008d31d890ef106fa3127e34832 -->

<!-- START_74b1efd11947903d579544c5a8f8d736 -->
## Create and store new sync item

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncItem" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "item_id"="Pariatur nihil quam" \
    -d "project_id"="1799a618-f613-3a21-bba1-6bb442f05224" \
    -d "item_signature"="2e5682b05c8f203ea512b16b459e4bca" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncItem",
    "method": "POST",
    "data": {
        "item_id": "Pariatur nihil quam",
        "project_id": "1799a618-f613-3a21-bba1-6bb442f05224",
        "item_signature": "2e5682b05c8f203ea512b16b459e4bca"
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
`POST /api/syncItem`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    item_id | string |  required  | Maximum: `191`
    project_id | string |  required  | UUID Valid project id
    item_signature | md5 |  optional  | Must have the size of `32`

<!-- END_74b1efd11947903d579544c5a8f8d736 -->

<!-- START_ccdd2259f6805f129675e8e5b5badf35 -->
## Update a specified sync item

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "item_id"="Voluptas alias magni" \
    -d "project_id"="c593131b-8039-3a6f-9e36-dbcb8ac7874a" \
    -d "item_signature"="650965f4cf101a20cd66e39093e8ec6d" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "item_id": "Voluptas alias magni",
        "project_id": "c593131b-8039-3a6f-9e36-dbcb8ac7874a",
        "item_signature": "650965f4cf101a20cd66e39093e8ec6d"
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
`PUT /api/syncItem/{syncItemId},{projectId}`

`PATCH /api/syncItem/{syncItemId},{projectId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    item_id | string |  required  | Maximum: `191`
    project_id | string |  required  | UUID Valid project id
    item_signature | md5 |  optional  | Must have the size of `32`

<!-- END_ccdd2259f6805f129675e8e5b5badf35 -->

<!-- START_fc56a7ca15466f45ebcd851891e7bad0 -->
## Delete specified sync item

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncItem/a37eda90-1f56-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
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
`DELETE /api/syncItem/{syncItemId},{projectId}`


<!-- END_fc56a7ca15466f45ebcd851891e7bad0 -->

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
    "data": [
        {
            "item_id": "4f72bc631fdb000000005224",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "80bce7901713e6ce067b458b3cd6fedc",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc63f307000000002fc7",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "a105ea325f43bed324be09412d9c84a6",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc640e6800000000aa73",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "6b72932de7dda8f1dc8cd643364893e1",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc641f5f00000000ab92",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "2832ee61c4da00a50b1b40088b8b5f1e",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc643160000000000cea",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "1e66e961fe69f7b35c230ce0be26e869",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc6afc5000000000fe1f",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "7c28d4099ac14c9726c6115766ae0a77",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc6b00ce00000000c233",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "7218e40ac31ebc2b480391dd6b33fe33",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc6b2303000000002949",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "5d3a4ec490d42fef155d4576f96a8f3d",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc6b3d3e000000006ca1",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "85180bc33703520dff63edd261052370",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        },
        {
            "item_id": "4f72bc6b4914000000008380",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "48e0e365ef7463b0ef9b12a7195f89aa",
            "created_at": "2017-09-15 12:03:57",
            "updated_at": "2017-09-15 12:03:57"
        }
    ],
    "meta": {
        "pagination": {
            "total": 737,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 74,
            "links": {
                "next": "https:\/\/emsearch.ryan.ems-dev.net\/api\/project\/1bcc7efc-138c-11e7-93ae-92361f002671\/syncItem?page=2"
            }
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

You can specify a GET parameter `root` (return only root tasks if true, children only if false) to filter results.<br />
Filter results with `sync_task_status_id` GET parameter.
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTask?root=1" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask?root=1?root=1sync_task_status_id=InProgressplanned_before=1985-08-22planned_after=1986-11-02",
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
            "sync_task_status_id": "Complete",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-09-14 13:18:35",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-15 12:04:00",
            "sync_task_logs_count": 3,
            "children_sync_tasks_count": 4
        },
        {
            "id": "f542c0e4-729e-11e7-8cf7-a6006ad3dba0",
            "sync_task_id": null,
            "sync_task_type_id": "Main",
            "sync_task_status_id": "Complete",
            "created_by_user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-09-14 13:28:35",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-15 12:04:00",
            "sync_task_logs_count": 2,
            "children_sync_tasks_count": 4
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

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    root | boolean |  optional  | 
    sync_task_status_id | string |  optional  | Valid sync_task_status id `Planned`, `InProgress` or `Complete`
    planned_before | date |  optional  | 
    planned_after | date |  optional  | 

<!-- END_2978e0998f660697ab1a780503cb443f -->

<!-- START_f9f5013ec23ba437ac7ebb90bcde561a -->
## Get specified sync task

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671",
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
        "sync_task_status_id": "Complete",
        "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
        "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
        "planned_at": "2017-09-14 13:18:35",
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-15 12:04:00",
        "sync_task_logs_count": 3,
        "children_sync_tasks_count": 4
    }
}
```

### HTTP Request
`GET /api/syncTask/{syncTaskId}`

`HEAD /api/syncTask/{syncTaskId}`


<!-- END_f9f5013ec23ba437ac7ebb90bcde561a -->

<!-- START_c00f44d24befccf340076e86ede207db -->
## Create and store new sync task

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncTask" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_id"="d194212b-91b3-36da-9088-953d5c919b43" \
    -d "sync_task_type_id"="Nobis eum voluptatibus" \
    -d "sync_task_status_id"="Maxime nesciunt velit" \
    -d "created_by_user_id"="cd369851-fa07-3c8a-ba97-a73ade9c1a9a" \
    -d "project_id"="2b2078e3-fc5a-3e2e-8c36-f1fa0d1a65e5" \
    -d "planned_at"="Saturday, 16-Sep-17 13:38:57 UTC" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask",
    "method": "POST",
    "data": {
        "sync_task_id": "d194212b-91b3-36da-9088-953d5c919b43",
        "sync_task_type_id": "Nobis eum voluptatibus",
        "sync_task_status_id": "Maxime nesciunt velit",
        "created_by_user_id": "cd369851-fa07-3c8a-ba97-a73ade9c1a9a",
        "project_id": "2b2078e3-fc5a-3e2e-8c36-f1fa0d1a65e5",
        "planned_at": "Saturday, 16-Sep-17 13:38:57 UTC"
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
`POST /api/syncTask`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sync_task_id | string |  optional  | UUID Valid sync_task id
    sync_task_type_id | string |  required  | Maximum: `50` Valid sync_task_type id
    sync_task_status_id | string |  required  | Maximum: `50` Valid sync_task_status id
    created_by_user_id | string |  required  | UUID Valid user id
    project_id | string |  required  | UUID Valid project id
    planned_at | date |  optional  | Must be a date after: `Friday, 15-Sep-17 13:38:57 UTC`

<!-- END_c00f44d24befccf340076e86ede207db -->

<!-- START_1b3e83a4b13167e7e09dccea3632267b -->
## Update a specified sync task

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_id"="49cefd9f-e492-33f1-b05c-bdd316783f13" \
    -d "sync_task_type_id"="Doloribus voluptas minima" \
    -d "sync_task_status_id"="Quae sunt harum" \
    -d "created_by_user_id"="e7c50693-00a1-327a-9412-23b4c40a45c8" \
    -d "project_id"="d7ab6eb8-2c0c-3fdb-8c96-547660f1061e" \
    -d "planned_at"="Saturday, 16-Sep-17 13:38:57 UTC" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "sync_task_id": "49cefd9f-e492-33f1-b05c-bdd316783f13",
        "sync_task_type_id": "Doloribus voluptas minima",
        "sync_task_status_id": "Quae sunt harum",
        "created_by_user_id": "e7c50693-00a1-327a-9412-23b4c40a45c8",
        "project_id": "d7ab6eb8-2c0c-3fdb-8c96-547660f1061e",
        "planned_at": "Saturday, 16-Sep-17 13:38:57 UTC"
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
`PUT /api/syncTask/{syncTaskId}`

`PATCH /api/syncTask/{syncTaskId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    sync_task_id | string |  optional  | UUID Valid sync_task id
    sync_task_type_id | string |  required  | Maximum: `50` Valid sync_task_type id
    sync_task_status_id | string |  required  | Maximum: `50` Valid sync_task_status id
    created_by_user_id | string |  required  | UUID Valid user id
    project_id | string |  required  | UUID Valid project id
    planned_at | date |  optional  | Must be a date after: `Friday, 15-Sep-17 13:38:57 UTC`

<!-- END_1b3e83a4b13167e7e09dccea3632267b -->

<!-- START_a522c6bd9b12ed317700a9c24cc97009 -->
## Delete specified sync task

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671",
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
`DELETE /api/syncTask/{syncTaskId}`


<!-- END_a522c6bd9b12ed317700a9c24cc97009 -->

<!-- START_20836dbbef085a7abd5e5320a1d18a3c -->
## Sync task sync task children list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/children" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/children",
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
            "id": "09d4f6a0-41e4-45aa-a2e3-c2ae1edf692c",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamDownload",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-09-15 12:03:34",
            "updated_at": "2017-09-15 12:03:48",
            "sync_task_logs_count": 4,
            "children_sync_tasks_count": 0
        },
        {
            "id": "0bd05397-ab1f-4b36-a0fe-bc5047ec8ae6",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamPrepare",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-09-15 12:03:54",
            "updated_at": "2017-09-15 12:03:55",
            "sync_task_logs_count": 9,
            "children_sync_tasks_count": 0
        },
        {
            "id": "14a1ee3d-b279-4fdc-b9a7-98dd9b3c1861",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "ItemsInsertion",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-09-15 12:03:54",
            "updated_at": "2017-09-15 12:03:58",
            "sync_task_logs_count": 7,
            "children_sync_tasks_count": 0
        },
        {
            "id": "cb6347a6-5424-4ade-9fa4-071a993d24d0",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamCheck",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-09-15 12:03:48",
            "updated_at": "2017-09-15 12:03:54",
            "sync_task_logs_count": 3,
            "children_sync_tasks_count": 0
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
`GET /api/syncTask/{syncTaskId}/children`

`HEAD /api/syncTask/{syncTaskId}/children`


<!-- END_20836dbbef085a7abd5e5320a1d18a3c -->

<!-- START_8151bc8465cc13065e561f4910642cfc -->
## Project sync task list

You can specify a GET parameter `root` (return only root tasks if true, children only if false) to filter results
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncTask?root=1" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/syncTask?root=1?root=1",
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
            "sync_task_status_id": "Complete",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-09-14 13:18:35",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-15 12:04:00",
            "sync_task_logs_count": 3,
            "children_sync_tasks_count": 4
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/syncTaskLog?public=1" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask/8dbfd6e6-2055-11e7-93ae-92361f002671/syncTaskLog?public=1?public=1",
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
            "id": "59dfc80c-2784-4242-9be7-c7d261a5e566",
            "sync_task_status_id": "InProgress",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Sync. task started",
            "public": true,
            "created_at": "2017-09-15 12:03:34",
            "updated_at": "2017-09-15 12:03:34"
        },
        {
            "id": "8054b770-4ad4-4cb6-a095-1c80682a63fc",
            "sync_task_status_id": "Complete",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Sync. task complete",
            "public": true,
            "created_at": "2017-09-15 12:04:00",
            "updated_at": "2017-09-15 12:04:00"
        },
        {
            "id": "bfbf48da-210d-11e7-93ae-92361f002671",
            "sync_task_status_id": "Planned",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Synchronization planned.",
            "public": true,
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
            "sync_tasks_count": 10,
            "sync_task_logs_count": 10,
            "sync_task_status_versions_count": 2
        },
        {
            "id": "InProgress",
            "sync_tasks_count": 0,
            "sync_task_logs_count": 40,
            "sync_task_status_versions_count": 2
        },
        {
            "id": "Planned",
            "sync_tasks_count": 0,
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
        "sync_tasks_count": 0,
        "sync_task_logs_count": 1,
        "sync_task_status_versions_count": 2
    }
}
```

### HTTP Request
`GET /api/syncTaskStatus/{syncTaskStatusId}`

`HEAD /api/syncTaskStatus/{syncTaskStatusId}`


<!-- END_ef5bd46c31f4520ae31c481e3881f393 -->

<!-- START_865608943794edcdc236b6642fff30fc -->
## Create and store new sync task status

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "id"="Architecto quisquam officia" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus",
    "method": "POST",
    "data": {
        "id": "Architecto quisquam officia"
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
`POST /api/syncTaskStatus`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | Maximum: `50`

<!-- END_865608943794edcdc236b6642fff30fc -->

<!-- START_a6d6e808388935664374203de869239c -->
## Update a sync task status

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "id"="Sed non fugiat" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned",
    "method": "PUT",
    "data": {
        "id": "Sed non fugiat"
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
`PUT /api/syncTaskStatus/{syncTaskStatusId}`

`PATCH /api/syncTaskStatus/{syncTaskStatusId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | Maximum: `50`

<!-- END_a6d6e808388935664374203de869239c -->

<!-- START_4790614b56e09e19252d5442739e5325 -->
## Delete specified sync task status

The sync task status versions will be automatically deleted too.<br />
<aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatus/Planned",
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
`DELETE /api/syncTaskStatus/{syncTaskStatusId}`


<!-- END_4790614b56e09e19252d5442739e5325 -->

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
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_status_id": "Complete",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est terminée",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is in progress.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est en cours.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is planned.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en",
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
    "data": []
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_status_id"="Voluptas sunt et" \
    -d "i18n_lang_id"="Qui explicabo et" \
    -d "description"="Sit ea distinctio" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion",
    "method": "POST",
    "data": {
        "sync_task_status_id": "Voluptas sunt et",
        "i18n_lang_id": "Qui explicabo et",
        "description": "Sit ea distinctio"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_status_id"="Quaerat magnam nesciunt" \
    -d "i18n_lang_id"="Provident in qui" \
    -d "description"="Nihil quos exercitationem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en",
    "method": "PUT",
    "data": {
        "sync_task_status_id": "Quaerat magnam nesciunt",
        "i18n_lang_id": "Provident in qui",
        "description": "Nihil quos exercitationem"
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

<!-- START_cd4944ac5f5430e310e7ed4c8461168c -->
## Delete specified sync task status version

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en",
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
`DELETE /api/syncTaskStatusVersion/{syncTaskStatusId},{i18nLangId}`


<!-- END_cd4944ac5f5430e310e7ed4c8461168c -->

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
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
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
            "sync_tasks_count": 2,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "DataStreamDownload",
            "sync_tasks_count": 2,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "DataStreamPrepare",
            "sync_tasks_count": 2,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "ItemsDelete",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "ItemsInsertion",
            "sync_tasks_count": 2,
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

<!-- START_5b54d83d59104ba59570d00f4fd0eb76 -->
## Create and store new sync task type

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncTaskType" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "id"="Possimus tenetur fugit" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskType",
    "method": "POST",
    "data": {
        "id": "Possimus tenetur fugit"
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
`POST /api/syncTaskType`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | Maximum: `50`

<!-- END_5b54d83d59104ba59570d00f4fd0eb76 -->

<!-- START_b890446685aa9562b1096a5794052243 -->
## Update a sync task type

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncTaskType/Main" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "id"="Minus fuga modi" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskType/Main",
    "method": "PUT",
    "data": {
        "id": "Minus fuga modi"
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
`PUT /api/syncTaskType/{syncTaskTypeId}`

`PATCH /api/syncTaskType/{syncTaskTypeId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | string |  required  | Maximum: `50`

<!-- END_b890446685aa9562b1096a5794052243 -->

<!-- START_4b168827b6eee93ab4bfe928f8db2db0 -->
## Delete specified sync task type

The sync task type versions will be automatically deleted too.<br />
<aside class="warning">Avoid using this feature ! Check foreign keys constraints to remove dependent resources properly before.</aside>

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/syncTaskType/Main" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskType/Main",
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
`DELETE /api/syncTaskType/{syncTaskTypeId}`


<!-- END_4b168827b6eee93ab4bfe928f8db2db0 -->

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
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "DataStreamCheck",
            "i18n_lang_id": "fr_FR",
            "description": "Comparaison et vérification des données téléchargées.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "fr_FR",
            "description": "Téléchargement des données fournies par l'url du flux de données.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "fr_FR",
            "description": "Ventilation des données pour la création, modification ou suppression.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "fr_FR",
            "description": "Suppression d'enregistrements.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "fr_FR",
            "description": "Création des nouveaux enregistrements.",
            "created_at": "2017-09-14 13:08:25",
            "updated_at": "2017-09-14 13:08:25"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en",
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
    "data": []
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_type_id"="Qui sunt sunt" \
    -d "i18n_lang_id"="Quaerat quo velit" \
    -d "description"="Mollitia accusantium alias" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion",
    "method": "POST",
    "data": {
        "sync_task_type_id": "Qui sunt sunt",
        "i18n_lang_id": "Quaerat quo velit",
        "description": "Mollitia accusantium alias"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_type_id"="Et ex quae" \
    -d "i18n_lang_id"="Doloribus ex quia" \
    -d "description"="Quis voluptas sint" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en",
    "method": "PUT",
    "data": {
        "sync_task_type_id": "Et ex quae",
        "i18n_lang_id": "Doloribus ex quia",
        "description": "Quis voluptas sint"
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

<!-- START_9f8c468a4ec17e82751e58da10327a64 -->
## Delete specified sync task type version

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en",
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
`DELETE /api/syncTaskTypeVersion/{syncTaskTypeId},{i18nLangId}`


<!-- END_9f8c468a4ec17e82751e58da10327a64 -->

<!-- START_23d45485a9001240593300c466ec2b0c -->
## I18n lang sync task type versions list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang/en/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en/syncTaskTypeVersion",
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
`GET /api/i18nLang/{i18nLangId}/syncTaskTypeVersion`

`HEAD /api/i18nLang/{i18nLangId}/syncTaskTypeVersion`


<!-- END_23d45485a9001240593300c466ec2b0c -->

#User
<!-- START_79bbe09b8f53b0948351390dffb959af -->
## User list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/user" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "509dd5c0-1389-11e7-93ae-92361f002671",
            "user_group_id": "Support",
            "name": "Alan Smithee",
            "email": "alan.smithee@domain.tld",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "605c7610-1389-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "John Smith",
            "email": "john.smith@domain.tld",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
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
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/user" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_group_id"="Developer" \
    -d "name"="Vero impedit fuga" \
    -d "email"="donnelly.marlene@example.net" \
    -d "password"="7RMA=:~QYns^^d:I$p&lt;" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user",
    "method": "POST",
    "data": {
        "user_group_id": "Developer",
        "name": "Vero impedit fuga",
        "email": "donnelly.marlene@example.net",
        "password": "7RMA=:~QYns^^d:I$p<"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_group_id"="End-User" \
    -d "name"="Et quae voluptas" \
    -d "email"="zwisoky@example.net" \
    -d "password"="/Y_B`4o0)4dR}/ZY" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_group_id": "End-User",
        "name": "Et quae voluptas",
        "email": "zwisoky@example.net",
        "password": "\/Y_B`4o0)4dR}\/ZY"
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
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/userGroup/End-User/user" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userGroup/End-User/user",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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

#UserGroup
<!-- START_6ee7257d4cfc462bf0f13e592e8d61fe -->
## Show User group list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/userGroup" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userGroup",
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
            "id": "Developer",
            "users_count": 1
        },
        {
            "id": "End-User",
            "users_count": 2
        },
        {
            "id": "Support",
            "users_count": 1
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
`GET /api/userGroup`

`HEAD /api/userGroup`


<!-- END_6ee7257d4cfc462bf0f13e592e8d61fe -->

<!-- START_d116f88abe6578a03098fbc385df3d15 -->
## Get specified User group

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/userGroup/End-User" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userGroup/End-User",
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
        "id": "End-User",
        "users_count": 2
    }
}
```

### HTTP Request
`GET /api/userGroup/{userGroupId}`

`HEAD /api/userGroup/{userGroupId}`


<!-- END_d116f88abe6578a03098fbc385df3d15 -->

#UserHasProject
<!-- START_6063f50ad85e45e2dded77d1e8c17367 -->
## User relationship between users and projects list

You can specify a GET parameter `user_role_id` to filter results.
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/userHasProject?user_role_id=Owner" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/userHasProject?user_role_id=Owner?user_role_id=Administrator",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/user/{userId}/userHasProject`

`HEAD /api/user/{userId}/userHasProject`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_role_id | string |  optional  | Valid user_role id `Owner` or `Administrator`

<!-- END_6063f50ad85e45e2dded77d1e8c17367 -->

<!-- START_a31b5a7f53442631d6ed56032f3c2fce -->
## Project relationship between users and projects list

You can specify a GET parameter `user_role_id` to filter results.
<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/userHasProject?user_role_id=Owner" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671/userHasProject?user_role_id=Owner?user_role_id=Administrator",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/project/{projectId}/userHasProject`

`HEAD /api/project/{projectId}/userHasProject`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_role_id | string |  optional  | Valid user_role id `Owner` or `Administrator`

<!-- END_a31b5a7f53442631d6ed56032f3c2fce -->

<!-- START_cf0313d53939313429ce6788fa95624c -->
## List of relationships between users and projects


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/userHasProject" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/userHasProject" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_id"="3bb6601c-88ec-3779-800c-7b4674cb287b" \
    -d "project_id"="d4f29ed4-a2b6-36da-b661-cc362e69e38d" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject",
    "method": "POST",
    "data": {
        "user_id": "3bb6601c-88ec-3779-800c-7b4674cb287b",
        "project_id": "d4f29ed4-a2b6-36da-b661-cc362e69e38d",
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "user_id"="fb9a5cc8-5fa0-3d76-ae09-c7c0bc851430" \
    -d "project_id"="29d8691c-e3f2-3eb4-a485-a9cae9a9ac80" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_id": "fb9a5cc8-5fa0-3d76-ae09-c7c0bc851430",
        "project_id": "29d8691c-e3f2-3eb4-a485-a9cae9a9ac80",
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
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
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

#Widget
<!-- START_570fdaef76ba7cae108716ec3eb02dfa -->
## Show widget list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>50</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/widget" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget",
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
            "id": "a2fb4304-781d-11e7-b5a5-be2e44b06b34",
            "search_use_case_id": "37f79df8-707c-11e7-8cf7-a6006ad3dba0",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "b070b438-781d-11e7-b5a5-be2e44b06b34",
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo Widget",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
`GET /api/widget`

`HEAD /api/widget`


<!-- END_570fdaef76ba7cae108716ec3eb02dfa -->

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
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
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
    -d "search_use_case_id"="a1f6cada-2363-3d5f-b756-ed2c6a04ab3d" \
    -d "name"="Accusamus velit repellat" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget",
    "method": "POST",
    "data": {
        "search_use_case_id": "a1f6cada-2363-3d5f-b756-ed2c6a04ab3d",
        "name": "Accusamus velit repellat"
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
    -d "search_use_case_id"="a23d8128-66ae-3029-9dae-9278d35295ce" \
    -d "name"="Dolorem earum sint" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34",
    "method": "PUT",
    "data": {
        "search_use_case_id": "a23d8128-66ae-3029-9dae-9278d35295ce",
        "name": "Dolorem earum sint"
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
        "created_at": "2017-09-14 13:08:35",
        "updated_at": "2017-09-14 13:08:35"
    }
}
```

### HTTP Request
`GET /api/widgetPreset/{widgetPresetId}`

`HEAD /api/widgetPreset/{widgetPresetId}`


<!-- END_fcd0c7112a22c2f60070949c9c1ca609 -->

<!-- START_87b06dc6d01ff36e94f722f9c87f32da -->
## Create and store new widget preset

> Example request:

```bash
curl -X POST "https://emsearch.ryan.ems-dev.net/api/widgetPreset" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_preset_id"="186b0e01-ac88-34ef-a846-7536ee1b7078" \
    -d "name"="Distinctio expedita aut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widgetPreset",
    "method": "POST",
    "data": {
        "search_use_case_preset_id": "186b0e01-ac88-34ef-a846-7536ee1b7078",
        "name": "Distinctio expedita aut"
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
`POST /api/widgetPreset`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_preset_id | string |  required  | UUID Valid search_use_case_preset id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_87b06dc6d01ff36e94f722f9c87f32da -->

<!-- START_8300711a40f6fc097b35d76179f2b2e6 -->
## Update a widget preset

> Example request:

```bash
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/widgetPreset/6be0a102-7769-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "search_use_case_preset_id"="0c32be30-6ee3-3c99-ab67-c91978d08c22" \
    -d "name"="Dolorum eum autem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widgetPreset/6be0a102-7769-11e7-b5a5-be2e44b06b34",
    "method": "PUT",
    "data": {
        "search_use_case_preset_id": "0c32be30-6ee3-3c99-ab67-c91978d08c22",
        "name": "Dolorum eum autem"
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
`PUT /api/widgetPreset/{widgetPresetId}`

`PATCH /api/widgetPreset/{widgetPresetId}`

#### Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    search_use_case_preset_id | string |  required  | UUID Valid search_use_case_preset id
    name | string |  required  | Minimum: `5` Maximum: `200`

<!-- END_8300711a40f6fc097b35d76179f2b2e6 -->

<!-- START_1cb16f9fcdec29634e4e1bee6b455259 -->
## Delete specified widget preset

> Example request:

```bash
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/widgetPreset/6be0a102-7769-11e7-b5a5-be2e44b06b34" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widgetPreset/6be0a102-7769-11e7-b5a5-be2e44b06b34",
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
`DELETE /api/widgetPreset/{widgetPresetId}`


<!-- END_1cb16f9fcdec29634e4e1bee6b455259 -->

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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
        },
        {
            "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-09-14 13:08:35",
            "updated_at": "2017-09-14 13:08:35"
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

