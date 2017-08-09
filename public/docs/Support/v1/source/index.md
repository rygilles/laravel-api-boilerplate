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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "605d712c-1934-11e7-93ae-92361f002671",
            "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
            "name": "Mickey Mouse Sample Project Data Stream",
            "feed_url": "https:\/\/www.e-monsite.com\/blog\/do\/datastream\/",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
        "created_at": "2017-08-07 13:27:06",
        "updated_at": "2017-08-07 13:27:06"
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
    -d "data_stream_decoder_id"="c2179aad-92de-30a0-8c78-777d3c8ee932" \
    -d "name"="Perferendis quod dolorem" \
    -d "feed_url"="http://ratke.com/et-quam-maxime-alias-tempora" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "c2179aad-92de-30a0-8c78-777d3c8ee932",
        "name": "Perferendis quod dolorem",
        "feed_url": "http:\/\/ratke.com\/et-quam-maxime-alias-tempora"
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
    -d "data_stream_decoder_id"="6c72c8e2-c72f-3e0d-a8c2-df3a151e4f9e" \
    -d "name"="Maxime fugiat adipisci" \
    -d "feed_url"="http://www.hayes.com/autem-laudantium-dolorum-veritatis-nostrum-quibusdam-voluptate" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "6c72c8e2-c72f-3e0d-a8c2-df3a151e4f9e",
        "name": "Maxime fugiat adipisci",
        "feed_url": "http:\/\/www.hayes.com\/autem-laudantium-dolorum-veritatis-nostrum-quibusdam-voluptate"
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

<!-- START_6c118c8a40f2e0a928a0b386584f151b -->
## I18n lang data streams list


<aside class="notice">Pagination limit must be a value between <code>1</code> and <code>20</code>, default is <code>10</code>.</aside>

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/i18nLang/en_US/dataStream" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/i18nLang/en_US/dataStream",
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
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
        "created_at": "2017-08-07 13:27:05",
        "updated_at": "2017-08-07 13:27:05"
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
    -d "name"="Consequatur doloremque sit" \
    -d "class_name"="Nemo dolores consequatur" \
    -d "file_mime_type"="Magnam sapiente perferendis" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder",
    "method": "POST",
    "data": {
        "name": "Consequatur doloremque sit",
        "class_name": "Nemo dolores consequatur",
        "file_mime_type": "Magnam sapiente perferendis"
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
    -d "name"="Ut illum optio" \
    -d "class_name"="Saepe itaque deserunt" \
    -d "file_mime_type"="Cupiditate eligendi minus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "name": "Ut illum optio",
        "class_name": "Saepe itaque deserunt",
        "file_mime_type": "Cupiditate eligendi minus"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145ca730-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145ca848-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145ca9ba-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145cac44-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145cad20-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145cade8-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145caeb0-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145cb13a-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "145cb27a-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "rating_count",
            "path": "rating_count",
            "versioned": false,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
        "created_at": "2017-08-07 13:27:06",
        "updated_at": "2017-08-07 13:27:06"
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
    -d "data_stream_id"="8f7be844-6012-3a91-9cec-3a1065104408" \
    -d "name"="Repudiandae et et" \
    -d "path"="Maxime ratione quaerat" \
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
        "data_stream_id": "8f7be844-6012-3a91-9cec-3a1065104408",
        "name": "Repudiandae et et",
        "path": "Maxime ratione quaerat",
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
    -d "data_stream_id"="7607054d-3e82-3036-9b3e-9d37f953843b" \
    -d "name"="Eius incidunt natus" \
    -d "path"="Quia in ducimus" \
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
        "data_stream_id": "7607054d-3e82-3036-9b3e-9d37f953843b",
        "name": "Eius incidunt natus",
        "path": "Quia in ducimus",
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
*

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
 *


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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "en",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "fr",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
curl -X GET "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en_US",
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
    -d "data_stream_id"="cb80c594-f711-3f6f-86fd-9af091ca903d" \
    -d "i18n_lang_id"="Eveniet rerum illo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang",
    "method": "POST",
    "data": {
        "data_stream_id": "cb80c594-f711-3f6f-86fd-9af091ca903d",
        "i18n_lang_id": "Eveniet rerum illo"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "data_stream_id"="a27e5b76-b4f5-344b-9049-2dc6daa66b13" \
    -d "i18n_lang_id"="Mollitia accusantium alias" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en_US",
    "method": "PUT",
    "data": {
        "data_stream_id": "a27e5b76-b4f5-344b-9049-2dc6daa66b13",
        "i18n_lang_id": "Mollitia accusantium alias"
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
curl -X DELETE "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en_US",
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "fr",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07"
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
    -d "data_stream_decoder_id"="61da2b2a-f060-3827-b201-53fc1548bab3" \
    -d "name"="Nam officia possimus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "61da2b2a-f060-3827-b201-53fc1548bab3",
        "name": "Nam officia possimus"
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
    -d "data_stream_decoder_id"="d50259a4-5b86-3ca1-bcf6-9bab5dab2c10" \
    -d "name"="Atque minus doloremque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "d50259a4-5b86-3ca1-bcf6-9bab5dab2c10",
        "name": "Atque minus doloremque"
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
*

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
 *


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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "title",
            "path": "title",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cba20-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc15a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc34e-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc650-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9ccec0-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "title",
            "path": "title",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cba20-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc15a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc34e-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc650-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "eb9ccec0-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07"
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
    -d "data_stream_preset_id"="3e48c91a-9af5-38d1-bc95-bee4016976c9" \
    -d "name"="Maiores quae voluptas" \
    -d "path"="Aut repudiandae dicta" \
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
        "data_stream_preset_id": "3e48c91a-9af5-38d1-bc95-bee4016976c9",
        "name": "Maiores quae voluptas",
        "path": "Aut repudiandae dicta",
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
    -d "data_stream_preset_id"="88dcbacf-cece-39a8-8d3d-e0b86652dedf" \
    -d "name"="Sed non fugiat" \
    -d "path"="Possimus illo possimus" \
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
        "data_stream_preset_id": "88dcbacf-cece-39a8-8d3d-e0b86652dedf",
        "name": "Sed non fugiat",
        "path": "Possimus illo possimus",
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
*

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
        "id": "41abdec2-1389-11e7-93ae-92361f002671",
        "user_group_id": "Developer",
        "name": "John Doe",
        "email": "john.doe@domain.tld",
        "created_at": "2017-08-07 13:27:06",
        "updated_at": "2017-08-07 13:27:06"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
        "created_at": "2017-08-07 13:27:06",
        "updated_at": "2017-08-07 13:27:06"
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
    -d "search_engine_id"="7a9165fc-f0c7-3104-851e-160faa961876" \
    -d "data_stream_id"="8b39f6fa-4f34-389f-b097-300c59c5a55f" \
    -d "name"="Sit ea distinctio" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "search_engine_id": "7a9165fc-f0c7-3104-851e-160faa961876",
        "data_stream_id": "8b39f6fa-4f34-389f-b097-300c59c5a55f",
        "name": "Sit ea distinctio"
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
    -d "search_engine_id"="14c151e2-321a-34d9-8b55-831292fbe3e9" \
    -d "data_stream_id"="8052adf9-25e6-36b2-a2e2-4b052d07c32f" \
    -d "name"="Perferendis nam consequatur" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "search_engine_id": "14c151e2-321a-34d9-8b55-831292fbe3e9",
        "data_stream_id": "8052adf9-25e6-36b2-a2e2-4b052d07c32f",
        "name": "Perferendis nam consequatur"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05",
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
        "created_at": "2017-08-07 13:27:05",
        "updated_at": "2017-08-07 13:27:05",
        "projects_count": 3
    }
}
```

### HTTP Request
`GET /api/searchEngine/{searchEngineId}`

`HEAD /api/searchEngine/{searchEngineId}`


<!-- END_2722bd2e446fc75e00b2f6449ed3d886 -->

#SearchUseCase
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
            "search_use_case_fields_count": 2
        },
        {
            "id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project Default Search Use Case",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
            "search_use_case_fields_count": 2
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
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07",
        "search_use_case_fields_count": 2
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
    -d "project_id"="3462ed22-a3f5-3700-865a-e76622db66aa" \
    -d "name"="Aperiam autem vel" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase",
    "method": "POST",
    "data": {
        "project_id": "3462ed22-a3f5-3700-865a-e76622db66aa",
        "name": "Aperiam autem vel"
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
    -d "project_id"="abca7ad0-d6c8-3709-9abc-4b08f9635c40" \
    -d "name"="Qui aut quaerat" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "project_id": "abca7ad0-d6c8-3709-9abc-4b08f9635c40",
        "name": "Qui aut quaerat"
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

<!-- START_4b5e9ae73571f33c511b43a1f61a4ec0 -->
## Perform search with the specified search use case

> Example request:

```bash
curl -X GET "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/search?query_string=site&i18n_lang_id=fr&page=1&limit=5" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/search?query_string=site&amp;i18n_lang_id=fr&amp;page=1&amp;limit=5?query_string=Mollitia iste suscipiti18n_lang_id=Et quasi quipage=7limit=74319",
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
            "item_id": "4f72bc822430000000006688",
            "title_fr": "Site de location de salle [Site du mercredi]",
            "content_fr": "Le site sélectionné cette semaine est particulier puisqu&#39;il s&#39;agit d&#39;un site créé par nos soins afin de proposer à la location notre salle de conférence et notre salle de réunion dans nos nouveaux locaux à Amiens. Le site est très simple : il propose des informations et des photos des deux salles en location. En plus de cela, une page d&#39;accueil permet de présenter le lieu et les services, et une page de réservation permet, avec le module de création de formulaire de contact, de faire une demande de réservation.\r\n\r\nCe site permet de se rendre compte à quel point l&#39;outil E-monsite est adapté pour la création de site de location de salle de conférence ou de réunion, et, de manière générale, à des sites vitrines. Je ne ferais pas la liste des points positifs et négatifs cette semaine, ce ne serait forcément pas objectif (puis j&#39;ai un peu peur de la réaction de notre webdesigner en chef, Pascal !). Je vous laisse en commentaire donner votre avis sur ce site de location de salle à Amiens.\r\n\r\nURL : http:\/\/www.carrelamartine.fr\/"
        },
        {
            "item_id": "4f72bc81ddf9000000002dc0",
            "title_fr": "Site du mercredi : le site officiel de Edu Falaschi",
            "content_fr": "Comme chaque semaine, nous sélectionnons un site créé sur E-monsite qui a retenu notre attention. C&#39;est l&#39;occasion de découvrir un site, de voir ce qu&#39;il est possible de faire avec l&#39;outil mais aussi de s&#39;inspirer des techniques utilisées et de glaner quelques conseils que nous pouvons donner dans ce billet.\r\n\r\n\r\n\r\nLe site sélectionné cette semaine est le site officiel Français du chanteur\/musicien\/producteur brésilien Edu Falaschi. Il est le leader d&#39;un groupe de métal qui tourne à travers le monde. Vous ne le connaissez probablement pas, c&#39;est donc l&#39;occasion d&#39;une petite visite sur ce site pour découvrir son univers.\r\n\r\nLa réalisation de ce site est soignée et de nombreuses informations sont disponibles, ce qui en fait probablement une référence. On y découvre une biographie assez exhaustive, sa discographie, son actualité et on peut même écouter quelques extraits de morceaux et visualiser des vidéos.\r\n\r\nCe site est réalisé par un fan, qui a également réalisé le site du groupe Almah, dont Edu Falaschi est le leader, sélectionné il y a quelques mois dans cette rubrique.\r\n\r\n\r\n\tLes + : un beau design bien intégré, un contenu bien hiérarchisé, une mise en page propre, des médias (vidéos, mp3)\r\n\tLes - : une page d&#39;introduction pas très utile (pour l&#39;internaute comme pour le référencement), le premier élément du menu vertical intitulé \"sans titre\" en noir sur fond noir qui pourrait simplement ne pas être affiché, pas d&#39;utilisation de modules pour les sections agenda et news, une image d&#39;entête un peu trop haute.\r\n\r\n\r\nURL : http:\/\/www.edufalaschifrance.com\r\n\r\nLe site du mercredi est interactif, à vous à présent de donner votre avis en donnant vos points forts et vos points faibles sur ce site. N&#39;oubliez pas que seule la critique constructive permet de faire avancer les choses !"
        },
        {
            "item_id": "4f72bc819f04000000006a27",
            "title_fr": "Site du mercredi : annuaire de location de vacances",
            "content_fr": "E-location-vacances.com est un annuaire de sites de location de vacances. Les propriétaires de gîtes, appartements, villas, proposant la location saisonnière peuvent ainsi y référencer gratuitement leur site web afin de communiquer sur leur location de vacances et de mieux positionner leur site sur les résultats des moteurs de recherche.\r\n\r\nLe design du site a été particulièrement travaillé, tout comme son optimisation au référencement qui est la clé pour le succès d&#39;un tel site. Ainsi, le site est agréable à surfer. Le seul inconvénient est son manque de contenu dû à sa récente mise en ligne.\r\n\r\n\r\n\tURL : http:\/\/www.e-location-vacances.com\/\r\n\r\n\r\nNous avons aimé :\r\n\r\n\r\n\tLe design propre et agréable\r\n\tL&#39;optimisation au référencement des pages (liens internes, titres des pages, ...)\r\n\tLa hiérarchisation de l&#39;annuaire très claire\r\n\r\n\r\nNous avons moins aimé :\r\n\r\n\r\n\tIl manque un footer (pied de page) pour cloturer le site (et placer des liens pour le référencement !)\r\n\tPeu de contenu encore\r\n\tUn peu trop de couleurs dans l&#39;entête (en grande partie à cause de la carte de France)\r\n\tLargeur du site pas adapté à la majorité des résolutions (largeur conseillé pour une compatibilité maximale : 980px)\r\n\r\n\r\nInterview du webmater\r\n\r\n1) Pouvez-vous vous présenter en quelques ligne et nous dire comment est né votre projet web ?\r\n\r\nNotre projet de création d&#39;un portail sur les vacances en France nous est venu dans le but d&#39;aider les propriétaires de site de locations de vacances à référencer leurs sites sur un portail dédié aux locations de vacances.\r\n\r\n2) Quand et Comment avez vous découvert E-monsite ?\r\n\r\nNous avons découvert e-monsite il y 2 ans via une recherche sur le web.\r\n\r\n3) Quel niveau dans la création de site web aviez-vous au moment où vous avez créé votre site ?\r\n\r\nNotre niveau au début de la création de e-location-vacances.com était bon (à très bon) pour le référencement surtout. Le site est jeune mais devrait monter dans les résultat google avec un peu de travail au niveau du référencement.\r\n\r\n4) Quels conseils pourriez vous donner aux personnes qui découvrent l’outil ?\r\n\r\nUilisez e-monsite, car c&#39;est un outil très bon pour la création de site web en ligne.\r\n\r\nVotre avis sur e-location-vacances.com\r\n\r\nA présent, c&#39;est à vous de donner votre avis sur le site de la semaine dans les commentaires du billet ! Partagez votre expériences et vos conseils avec le webmaster et avec l&#39;ensemble de la communauté !"
        },
        {
            "item_id": "4f72bc80fe2400000000ec69",
            "title_fr": "Site du mercredi : création d'un site de home staging",
            "content_fr": "Envie de redonner un coup de jeune à votre intérieur ? Kazamya propose des prestations de home staging à Aix-en-Provence. Mais qu&#39;est-ce que le home staging ? \"le home staging consiste à redonner à votre habitat tout son potentiel et le rendre plus neutre afin qu&#39;il plaise au plus grand nombre car nous sommes tous différents !\". Ainsi, sur son site Internet, la jeune société Kazamia propose ses prestations dans ce domaine, ainsi qu&#39;en relooking de maison.\r\n\r\nLe site est simple mais très facile à surfer : les différentes sections sont accessibles facilement et l&#39;information donné sur chaque prestation et chaque formule semble claire et suffisante. Une évolution du site passerait peut être par la solution e-commerce en proposant les différentes prestations et bons cadeaux en commande directe...\r\n\r\nEn bref, ce site est un bel exemple de création de site internet fonctionnel sans être trop compliqué ni trop graphique.\r\n\r\nOn a aimé :\r\n\r\n\r\n\tDesign simple avec un effort de présentation du contenu des pages\r\n\tUne information sur la société, les prestations et les formules claire et complète\r\n\r\n\r\nOn a moins aimé :\r\n\r\n\r\n\tSite non optimisé pour le référencement : le contenu est en image sur certaines pages (non référençable par Google...), les titres pas optimisés (le title de la page d&#39;accueil devrait reprendre les mots clés essentiels de l&#39;activité, par exemple : \"Home staging et relooking à Aix-en-Provence avec Kazamya)\r\n\tLe fait qu&#39;il ne soit pas très clair où se situe l&#39;entreprise et où elle peut intervenir (le widget \"contact\" mériterait d&#39;être édité pour afficher plus d&#39;informations que le nom de la société et la ville pourrait être indiqué dans le bandeau d&#39;entête)\r\n\tLes catégories de pages utilisés comme des pages (ce n&#39;est pas problématique à l&#39;affichage, mais c&#39;est incohérent dans l&#39;utilisation d&#39;E-monsite)\r\n\tPas d&#39;informations sur la newsletter (que vais-je recevoir si j&#39;indique mon e-mail ?)\r\n\tLa page d&#39;accueil pourrait déjà présenter quelques réalisations (l&#39;internaute \"zappe\" rapidement, il faut retenir son attention !)\r\n\tLa page d&#39;introduction n&#39;est pas très utile, et nuit également au référencement\r\n\tTrop de mots en majuscule; le gras suffit pour mettre en valeur un mot ou une expression\r\n\r\n\r\nInterview d&#39;Alexandra, la \"webmiss\"\r\n\r\n1) Pouvez-vous vous présenter en quelques ligne et nous dire comment est né votre projet web ?\r\n\r\nMon projet de création du site s&#39;est fait avant de déclarer ma société. Je souhaitais avoir un site de présentation de la société, comme tout le monde. il faut suivre la tendance et je pense qu&#39;avoir un site fait plus professionnel.\r\n\r\n2) Quand et Comment avez vous découvert E-monsite ?\r\n\r\nJe cherchais comment faire un site sans payer un webmaster car je n&#39;avais pas le budget. Une amie s&#39;est fait son site sur e-monsite et me l&#39;a conseillé. Je me suis donc lancée d&#39;abord en version gratuite et quand j&#39;ai démarré mon activité, j&#39;ai pris la version pro afin d&#39;avoir une adresse facile à retenir et ne plus avoir de pub sur le site.\r\n\r\n3) Quel niveau dans la création de site web aviez-vous au moment où vous avez créé votre site ?\r\n\r\nJe n&#39;avais jamais fait de site avant, et je dois dire que c&#39;est plutôt simple (j&#39;avais acheté un logiciel de création de site et je peux vous dire que c&#39;est beaucoup plus compliqué, j&#39;ai abandonné). Sur e-monsite, j&#39;ai quand même eu recourt au service d&#39;aide par téléphone plusieurs fois mais j&#39;ai réussi à construire quelque chose de présentable. De plus, depuis la nouvelle version de e-monsite je trouve que c&#39;est encore plus accessible. Merci !\r\n\r\n4) Quels conseils pourriez vous donner aux personnes qui découvrent l’outil ?\r\n\r\nLe conseil que je donnerais aux nouveaux arrivants serait de prendre leur temps (il en faut pas mal) et de ne pas hésiter à appeler le sevice d&#39;aide en ligne. De plus, il faut, avant de se lancer, réfléchir à la présentation de son site, aux menus souhaités, au contenu... Pour ne pas avoir à faire trop de modifications par la suite. Mais ça vaut le coup!\r\n\r\nVotre avis\r\n\r\nEt vous, qu&#39;avez-vous pensé de ce site web ? Donnez votre avis dans les commentaires ci-dessous !"
        },
        {
            "item_id": "4f72bc80ae77000000000070",
            "title_fr": "Site du mercredi : un site de voyage",
            "content_fr": "Le site du mercredi, deuxième saison, deuxième épisode. Nous avons tenu compte de vos remarques de la semaine dernière et notre \"avis d&#39;expert\"sur le site sélectionné est de retour. Le site du mercredi reste néanmoins interactif : à vous d&#39;indiquer en commentaire votre avis sur le site après l&#39;avoir visité.\r\n\r\nFenêtre sur le monde\r\n\r\nLe site sélectionné cette semaine est une invitation au voyage. Très simple d&#39;aspect, il est néanmoins très bien conçu et bien fourni en contenu. La porte d&#39;entrée de la visite est le choix d&#39;un continent. Vous obtiendrez ainsi par exemple des carnets de voyage en Afrique, des événements culturels en Amérique du sud, des photos de l&#39;Asie, des vidéos voyage d&#39;Amérique du sud, des billets de blog sur l&#39;Europe et des liens vers des sites sur l&#39;Océanie. Le dépaysement est total, et il est certain que vous apprendrez beaucoup des cultures et des coutumes du monde !\r\n\r\nURL : http:\/\/www.fenetresurlemonde.fr\/\r\n\r\nOn a aimé :\r\n\r\n\r\n\tUn blog d&#39;actualité\r\n\tDes liens internes dans le contenu permettant d&#39;optimiser le référencement du site\r\n\tBeaucoup de contenu original\r\n\tUn espace membre permettant aux internautes de participer au site\r\n\tUtilisation des réseaux sociaux pour la promotion du site\r\n\r\n\r\nOn a moins aimé :\r\n\r\n\r\n\tLe design pourrait être un peu plus graphique, tout en restant sobre\r\n\tLa barre en bas \"wibiya\" qui n&#39;apporte pas grand chose\r\n\r\n\r\nInterview du webmaster : Sandra\r\n\r\nPouvez-vous vous présenter en quelques ligne et nous dire comment est né votre projet web ?\r\n\r\nJe suis Sandra, passionnée par les voyages, les échanges inter culturels et la connaissance des différentes cultures présentes sur cette planète.  J&#39;adore aussi l&#39;écriture du voyage que ce soit dans des blogs, des carnets de voyage ou des romans. Je fréquente assidument le festival des étonnants voyageurs à Saint Malo ou celui des carnettistes à Clermont Ferrand.\r\n\r\nQuand et Comment avez vous découvert E-monsite ?\r\n\r\nJ&#39;étais aux États Unis depuis 10 mois pour une expérience professionnelle de 12 mois. J&#39;y avais vécu énormément de choses que je voulais partager d&#39;où l&#39;idée de créer un blog pour garder une trace de mon aventure.\r\nEn faisant des recherches d&#39;outils de création j&#39;ai découvert e-monsite qui offre de nombreuses fonctionnalités, qui est très intuitif (...) Cet outil de création de site en ligne m&#39;a vite donné envie d&#39;aller plus loin que la création d&#39;un simple blog sur mon séjour car il rendait accessible la création d&#39;un site plus complexe de façon très conviviale. Je me suis donc amusée avec les différents outils d&#39;e-monsite et je me suis prise à mon jeu... En plus, le support d&#39;e-monsite est très réactif, le blog d&#39;Awelty assez vivant ce qui donne l&#39;impression d&#39;appartenir à une sorte de communauté.\r\n\r\nQuel niveau dans la création de site web aviez-vous au moment où vous avez créé votre site ?\r\n\r\nJ&#39;en étais au niveau 0 de la création et je le suis toujours car je n&#39;ai pas vraiment de connaissances techniques en la matière.\r\n\r\nQuels conseils pourriez vous donner aux personnes qui découvrent l’outil ?\r\n\r\nLes outils sont très intuitifs donc je leur dirais de se lancer, de s&#39;amuser et de laisser parler leur imagination !\r\n\r\nDonnez votre avis sur Fenêtre sur le monde\r\n\r\nLe site du mercredi est interactif : partagez votre avis constructif sur ce site, donnez vos conseils de webmaster avisé. Bref : à vous de dire ce que vous pensez du site Fenêtre sur le monde en laissant un commentaire ci-dessous."
        }
    ],
    "meta": {
        "pagination": {
            "total": 261,
            "count": 5,
            "per_page": 5,
            "current_page": 1,
            "total_pages": 53
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
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_id": "37f79df8-707c-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "145ca730-60af-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36116fa6-5c0d-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36117334-5c0d-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
        "searchable": "1",
        "to_retrieve": "1",
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07"
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
    -d "search_use_case_id"="8300794c-5558-39d8-9f69-8a28fea1181f" \
    -d "data_stream_field_id"="a47a511b-fc20-376f-871f-e99e250a67c6" \
    -d "name"="Delectus fuga quae" \
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
        "search_use_case_id": "8300794c-5558-39d8-9f69-8a28fea1181f",
        "data_stream_field_id": "a47a511b-fc20-376f-871f-e99e250a67c6",
        "name": "Delectus fuga quae",
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
    -d "search_use_case_id"="1ba68397-5cff-397a-afa5-529b416d516d" \
    -d "data_stream_field_id"="13e22b76-a798-3add-8ed7-f4d27aa65da2" \
    -d "name"="Et non veritatis" \
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
        "search_use_case_id": "1ba68397-5cff-397a-afa5-529b416d516d",
        "data_stream_field_id": "13e22b76-a798-3add-8ed7-f4d27aa65da2",
        "name": "Et non veritatis",
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36117334-5c0d-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
            "search_use_case_preset_fields_count": 3
        },
        {
            "id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
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
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07",
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
    -d "data_stream_preset_id"="f498e578-8e64-3555-998b-a15bccd99a84" \
    -d "name"="Inventore corrupti nemo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset",
    "method": "POST",
    "data": {
        "data_stream_preset_id": "f498e578-8e64-3555-998b-a15bccd99a84",
        "name": "Inventore corrupti nemo"
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
    -d "data_stream_preset_id"="aa1d2f43-48e5-382d-b362-690db4d23206" \
    -d "name"="Suscipit quam recusandae" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCasePreset/516f0252-7767-11e7-b5a5-be2e44b06b34",
    "method": "PUT",
    "data": {
        "data_stream_preset_id": "aa1d2f43-48e5-382d-b362-690db4d23206",
        "name": "Suscipit quam recusandae"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
            "search_use_case_preset_fields_count": 0
        },
        {
            "id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_preset_id": "d3c73a6c-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "name": "image_url",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07"
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
    -d "search_use_case_preset_id"="85e9aba2-6c13-3759-9a9e-f27c73b16d46" \
    -d "data_stream_preset_field_id"="d2c361e5-a833-3c45-abf3-3b4984ecaa2e" \
    -d "name"="Quis voluptas quo" \
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
        "search_use_case_preset_id": "85e9aba2-6c13-3759-9a9e-f27c73b16d46",
        "data_stream_preset_field_id": "d2c361e5-a833-3c45-abf3-3b4984ecaa2e",
        "name": "Quis voluptas quo",
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
    -d "search_use_case_preset_id"="fb2365ee-328e-3e28-ab84-f6dcaf8ebd82" \
    -d "data_stream_preset_field_id"="f080d997-bbf1-388e-86eb-907b9e3a1a28" \
    -d "name"="Consequatur et assumenda" \
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
        "search_use_case_preset_id": "fb2365ee-328e-3e28-ab84-f6dcaf8ebd82",
        "data_stream_preset_field_id": "f080d997-bbf1-388e-86eb-907b9e3a1a28",
        "name": "Consequatur et assumenda",
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
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "data_stream_preset_field_id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "name": "url",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask?root=1?root=1sync_task_status_id=Plannedplanned_before=1974-12-18planned_after=1974-12-18",
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
            "planned_at": "2017-08-07 13:37:07",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
            "sync_task_logs_count": 1,
            "children_sync_tasks_count": 0
        },
        {
            "id": "f542c0e4-729e-11e7-8cf7-a6006ad3dba0",
            "sync_task_id": null,
            "sync_task_type_id": "Main",
            "sync_task_status_id": "Planned",
            "created_by_user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-08-07 13:47:07",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
            "sync_task_logs_count": 0,
            "children_sync_tasks_count": 0
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
        "sync_task_status_id": "Planned",
        "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
        "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
        "planned_at": "2017-08-07 13:37:07",
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07",
        "sync_task_logs_count": 1,
        "children_sync_tasks_count": 0
    }
}
```

### HTTP Request
`GET /api/syncTask/{syncTaskId}`

`HEAD /api/syncTask/{syncTaskId}`


<!-- END_f9f5013ec23ba437ac7ebb90bcde561a -->

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
`GET /api/syncTask/{syncTaskId}/children`

`HEAD /api/syncTask/{syncTaskId}/children`


<!-- END_20836dbbef085a7abd5e5320a1d18a3c -->

<!-- START_8151bc8465cc13065e561f4910642cfc -->
## Project sync task list

You can specify a GET parameter `root` (return only root tasks if true, children only if false) to filter results.
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
            "sync_task_status_id": "Planned",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-08-07 13:37:07",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07",
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
            "id": "bfbf48da-210d-11e7-93ae-92361f002671",
            "sync_task_status_id": "Planned",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Synchronization planned.",
            "public": true,
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_status_id": "Complete",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est terminée",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is in progress.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est en cours.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is planned.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_status_id"="Voluptas maxime maiores" \
    -d "i18n_lang_id"="Voluptas est sit" \
    -d "description"="Praesentium illum minus" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion",
    "method": "POST",
    "data": {
        "sync_task_status_id": "Voluptas maxime maiores",
        "i18n_lang_id": "Voluptas est sit",
        "description": "Praesentium illum minus"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_status_id"="Beatae omnis velit" \
    -d "i18n_lang_id"="Enim et doloremque" \
    -d "description"="Qui sed odio" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US",
    "method": "PUT",
    "data": {
        "sync_task_status_id": "Beatae omnis velit",
        "i18n_lang_id": "Enim et doloremque",
        "description": "Qui sed odio"
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "DataStreamCheck",
            "i18n_lang_id": "fr_FR",
            "description": "Comparaison et vérification des données téléchargées.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "fr_FR",
            "description": "Téléchargement des données fournies par l'url du flux de données.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "fr_FR",
            "description": "Ventilation des données pour la création, modification ou suppression.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "fr_FR",
            "description": "Suppression d'enregistrements.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "fr_FR",
            "description": "Création des nouveaux enregistrements.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
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
curl -X POST "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_type_id"="Voluptatem aliquam distinctio" \
    -d "i18n_lang_id"="Repellat et ut" \
    -d "description"="Dolorem et eius" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion",
    "method": "POST",
    "data": {
        "sync_task_type_id": "Voluptatem aliquam distinctio",
        "i18n_lang_id": "Repellat et ut",
        "description": "Dolorem et eius"
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
curl -X PUT "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US" \
-H "Accept: application/json" \
-H "Authentication: Bearer xxx"
 \
    -d "sync_task_type_id"="Quia et porro" \
    -d "i18n_lang_id"="Aut adipisci totam" \
    -d "description"="Velit sit porro" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US",
    "method": "PUT",
    "data": {
        "sync_task_type_id": "Quia et porro",
        "i18n_lang_id": "Aut adipisci totam",
        "description": "Velit sit porro"
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
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "ItemsUpdate",
            "i18n_lang_id": "en_US",
            "description": "Updating records.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
        },
        {
            "sync_task_type_id": "Main",
            "i18n_lang_id": "en_US",
            "description": "Main task who rules and manage subtasks.",
            "created_at": "2017-08-07 13:27:05",
            "updated_at": "2017-08-07 13:27:05"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "509dd5c0-1389-11e7-93ae-92361f002671",
            "user_group_id": "Support",
            "name": "Alan Smithee",
            "email": "alan.smithee@domain.tld",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "605c7610-1389-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "John Smith",
            "email": "john.smith@domain.tld",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
        "created_at": "2017-08-07 13:27:06",
        "updated_at": "2017-08-07 13:27:06"
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
    -d "user_group_id"="End-User" \
    -d "name"="Est modi et" \
    -d "email"="conner.beatty@example.org" \
    -d "password"="&lt;(R1&gt;wzBn[sN`k&#039;!F/" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user",
    "method": "POST",
    "data": {
        "user_group_id": "End-User",
        "name": "Est modi et",
        "email": "conner.beatty@example.org",
        "password": "<(R1>wzBn[sN`k'!F\/"
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
    -d "name"="Rerum incidunt omnis" \
    -d "email"="ullrich.alvis@example.org" \
    -d "password"="|N@G@y[YO6D" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_group_id": "End-User",
        "name": "Rerum incidunt omnis",
        "email": "ullrich.alvis@example.org",
        "password": "|N@G@y[YO6D"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
            "created_at": "2017-08-07 13:27:06",
            "updated_at": "2017-08-07 13:27:06"
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
    -d "user_id"="ce033e35-8142-3af7-b4ff-1fa4246bb19a" \
    -d "project_id"="81f43c29-57ca-3838-9ae1-3e2554787948" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject",
    "method": "POST",
    "data": {
        "user_id": "ce033e35-8142-3af7-b4ff-1fa4246bb19a",
        "project_id": "81f43c29-57ca-3838-9ae1-3e2554787948",
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
    -d "user_id"="03bb2e4d-c2ad-3b28-b869-473cf7250e77" \
    -d "project_id"="4598312f-b366-3510-afd4-fb8d32fcbb01" \
    -d "user_role_id"="Administrator" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_id": "03bb2e4d-c2ad-3b28-b869-473cf7250e77",
        "project_id": "4598312f-b366-3510-afd4-fb8d32fcbb01",
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "b070b438-781d-11e7-b5a5-be2e44b06b34",
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "name": "E-monsite | Blog - Photo Widget",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07"
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
    -d "search_use_case_id"="aa43490e-cd4c-398a-bb1e-d21a4c5eb395" \
    -d "name"="Quia laudantium recusandae" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget",
    "method": "POST",
    "data": {
        "search_use_case_id": "aa43490e-cd4c-398a-bb1e-d21a4c5eb395",
        "name": "Quia laudantium recusandae"
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
    -d "search_use_case_id"="100ffdef-ab64-33f5-a88d-03691c2934eb" \
    -d "name"="Numquam dolor voluptatem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widget/b070b438-781d-11e7-b5a5-be2e44b06b34",
    "method": "PUT",
    "data": {
        "search_use_case_id": "100ffdef-ab64-33f5-a88d-03691c2934eb",
        "name": "Numquam dolor voluptatem"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
        "created_at": "2017-08-07 13:27:07",
        "updated_at": "2017-08-07 13:27:07"
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
    -d "search_use_case_preset_id"="ceb723ab-b48b-361c-b880-e73d049c2729" \
    -d "name"="Est molestiae cumque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widgetPreset",
    "method": "POST",
    "data": {
        "search_use_case_preset_id": "ceb723ab-b48b-361c-b880-e73d049c2729",
        "name": "Est molestiae cumque"
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
    -d "search_use_case_preset_id"="2299b576-0727-3990-b108-228dfa7c5bf3" \
    -d "name"="Non hic soluta" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/widgetPreset/6be0a102-7769-11e7-b5a5-be2e44b06b34",
    "method": "PUT",
    "data": {
        "search_use_case_preset_id": "2299b576-0727-3990-b108-228dfa7c5bf3",
        "name": "Non hic soluta"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
        },
        {
            "id": "6be0a102-7769-11e7-b5a5-be2e44b06b34",
            "search_use_case_preset_id": "516f0252-7767-11e7-b5a5-be2e44b06b34",
            "name": "E-monsite | Blog - Summary Widget",
            "created_at": "2017-08-07 13:27:07",
            "updated_at": "2017-08-07 13:27:07"
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

