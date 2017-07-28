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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "605d712c-1934-11e7-93ae-92361f002671",
            "data_stream_decoder_id": "53fd5290-5a4c-11e7-907b-a6006ad3dba0",
            "name": "Mickey Mouse Sample Project Data Stream",
            "feed_url": "https:\/\/www.e-monsite.com\/blog\/do\/datastream\/",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27"
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
    -d "data_stream_decoder_id"="b5ddfbc1-b394-33ab-abdb-8c0b7bd281e9" \
    -d "name"="Quia aperiam quia" \
    -d "feed_url"="https://www.koss.org/expedita-tenetur-non-quidem-cupiditate-assumenda-qui-rem" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "b5ddfbc1-b394-33ab-abdb-8c0b7bd281e9",
        "name": "Quia aperiam quia",
        "feed_url": "https:\/\/www.koss.org\/expedita-tenetur-non-quidem-cupiditate-assumenda-qui-rem"
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
    -d "data_stream_decoder_id"="b9711872-6325-37ca-9420-d89fc36b4921" \
    -d "name"="Mollitia voluptatem a" \
    -d "feed_url"="http://kerluke.com/" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStream/605d712c-1934-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "b9711872-6325-37ca-9420-d89fc36b4921",
        "name": "Mollitia voluptatem a",
        "feed_url": "http:\/\/kerluke.com\/"
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
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
        "created_at": "2017-07-28 10:10:24",
        "updated_at": "2017-07-28 10:10:24"
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
    -d "name"="Odio iusto nisi" \
    -d "class_name"="Odio iusto nisi" \
    -d "file_mime_type"="A qui maiores" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder",
    "method": "POST",
    "data": {
        "name": "Odio iusto nisi",
        "class_name": "Odio iusto nisi",
        "file_mime_type": "A qui maiores"
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
    -d "name"="Animi voluptatibus minus" \
    -d "class_name"="Molestias vitae et" \
    -d "file_mime_type"="Et et quae" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamDecoder/53fd5290-5a4c-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "name": "Animi voluptatibus minus",
        "class_name": "Molestias vitae et",
        "file_mime_type": "Et et quae"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145ca730-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145ca848-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145ca9ba-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145cac44-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145cad20-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145cade8-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145caeb0-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145cb13a-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "145cb27a-60af-11e7-907b-a6006ad3dba0",
            "data_stream_id": "56278dc8-1934-11e7-93ae-92361f002671",
            "name": "rating_count",
            "path": "rating_count",
            "versioned": false,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27"
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
    -d "data_stream_id"="76453ec8-f23e-39ce-9ac8-2ccbd602a2f7" \
    -d "name"="Ducimus laudantium praesentium" \
    -d "path"="Aliquam dolorem aliquam" \
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
        "data_stream_id": "76453ec8-f23e-39ce-9ac8-2ccbd602a2f7",
        "name": "Ducimus laudantium praesentium",
        "path": "Aliquam dolorem aliquam",
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
    -d "data_stream_id"="ff0c14b2-4a54-3d4e-addb-8d8cf311f71d" \
    -d "name"="Aperiam temporibus sed" \
    -d "path"="Pariatur nihil quam" \
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
        "data_stream_id": "ff0c14b2-4a54-3d4e-addb-8d8cf311f71d",
        "name": "Aperiam temporibus sed",
        "path": "Pariatur nihil quam",
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "en",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "fr",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
    -d "data_stream_id"="153ec92d-c136-3da9-b7d0-6a06406dbb93" \
    -d "i18n_lang_id"="Repellendus labore repellat" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang",
    "method": "POST",
    "data": {
        "data_stream_id": "153ec92d-c136-3da9-b7d0-6a06406dbb93",
        "i18n_lang_id": "Repellendus labore repellat"
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
    -d "data_stream_id"="819b9b16-4023-33f3-9aae-d762801951df" \
    -d "i18n_lang_id"="Qui est cumque" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamHasI18nLang/605d712c-1934-11e7-93ae-92361f002671,en_US",
    "method": "PUT",
    "data": {
        "data_stream_id": "819b9b16-4023-33f3-9aae-d762801951df",
        "i18n_lang_id": "Qui est cumque"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "i18n_lang_id": "fr",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27"
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
    -d "data_stream_decoder_id"="31c1e831-b1ff-31d8-bfb7-5075cbb52ac8" \
    -d "name"="Fugit sapiente aut" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset",
    "method": "POST",
    "data": {
        "data_stream_decoder_id": "31c1e831-b1ff-31d8-bfb7-5075cbb52ac8",
        "name": "Fugit sapiente aut"
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
    -d "data_stream_decoder_id"="0db1faf3-3eae-378d-be80-8c4673911258" \
    -d "name"="Soluta facilis quasi" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/dataStreamPreset/737441b0-57ea-11e7-907b-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "data_stream_decoder_id": "0db1faf3-3eae-378d-be80-8c4673911258",
        "name": "Soluta facilis quasi"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "title",
            "path": "title",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cba20-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc15a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc34e-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc650-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9ccec0-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cb642-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "title",
            "path": "title",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cba20-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "content",
            "path": "content",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc15a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_keywords",
            "path": "seo_keywords",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc34e-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_description",
            "path": "seo_description",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc4ca-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "tags",
            "path": "tags",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc650-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "breadcrumb",
            "path": "breadcrumb",
            "versioned": true,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc7c2-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "url",
            "path": "url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9cc92a-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "seo_image_url",
            "path": "seo_image_url",
            "versioned": true,
            "searchable": false,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "eb9ccec0-5bf3-11e7-907b-a6006ad3dba0",
            "data_stream_preset_id": "737441b0-57ea-11e7-907b-a6006ad3dba0",
            "name": "author",
            "path": "author",
            "versioned": false,
            "searchable": true,
            "to_retrieve": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27"
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
    -d "data_stream_preset_id"="bed16137-0d3a-3ad4-8ff7-74b60c5c62f3" \
    -d "name"="Non omnis nam" \
    -d "path"="Sed id id" \
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
        "data_stream_preset_id": "bed16137-0d3a-3ad4-8ff7-74b60c5c62f3",
        "name": "Non omnis nam",
        "path": "Sed id id",
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
    -d "data_stream_preset_id"="106449f2-377c-34ef-a701-f3ebba8996f4" \
    -d "name"="Temporibus doloribus veritatis" \
    -d "path"="Quaerat cumque architecto" \
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
        "data_stream_preset_id": "106449f2-377c-34ef-a701-f3ebba8996f4",
        "name": "Temporibus doloribus veritatis",
        "path": "Quaerat cumque architecto",
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27"
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
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671/project?user_role_id=Owner?user_role_id=Owner",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27"
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
    -d "search_engine_id"="2063af03-89c4-3dd1-9f67-2c4064e80f91" \
    -d "data_stream_id"="6ca6f0d9-bbb9-3fc6-8c2d-cbf2152e5d9a" \
    -d "name"="Eos eveniet at" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project",
    "method": "POST",
    "data": {
        "search_engine_id": "2063af03-89c4-3dd1-9f67-2c4064e80f91",
        "data_stream_id": "6ca6f0d9-bbb9-3fc6-8c2d-cbf2152e5d9a",
        "name": "Eos eveniet at"
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
    -d "search_engine_id"="a4fa0135-fdad-37fb-9094-0b15b64d7a4c" \
    -d "data_stream_id"="cb1a1493-8fc3-3363-82bd-80b5b3262cff" \
    -d "name"="Tempore exercitationem eligendi" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/project/1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "search_engine_id": "a4fa0135-fdad-37fb-9094-0b15b64d7a4c",
        "data_stream_id": "cb1a1493-8fc3-3363-82bd-80b5b3262cff",
        "name": "Tempore exercitationem eligendi"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": null,
            "name": "John Smith Sample Project 2",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "search_engine_id": "ee87e3b2-1388-11e7-93ae-92361f002671",
            "data_stream_id": "605d712c-1934-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24",
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
        "created_at": "2017-07-28 10:10:24",
        "updated_at": "2017-07-28 10:10:24",
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27",
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27",
            "search_use_case_fields_count": 2
        },
        {
            "id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "name": "Mickey Mouse Sample Project Default Search Use Case",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27",
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27",
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
    -d "project_id"="e732567c-eeea-3a63-a830-12ceb94126fd" \
    -d "name"="Quia et voluptas" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase",
    "method": "POST",
    "data": {
        "project_id": "e732567c-eeea-3a63-a830-12ceb94126fd",
        "name": "Quia et voluptas"
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
    -d "project_id"="d3c6b99e-2e6d-3ce4-96f5-c4f52ced6eb1" \
    -d "name"="Repellendus voluptatem ex" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
    "method": "PUT",
    "data": {
        "project_id": "d3c6b99e-2e6d-3ce4-96f5-c4f52ced6eb1",
        "name": "Repellendus voluptatem ex"
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
    "url": "https://emsearch.ryan.ems-dev.net/api/searchUseCase/dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0/search?query_string=site&amp;i18n_lang_id=fr&amp;page=1&amp;limit=5?query_string=Quia et porroi18n_lang_id=In illo porropage=2157290limit=2071",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "search_use_case_id": "37f79df8-707c-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "145ca730-60af-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36116fa6-5c0d-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36117334-5c0d-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
    "data": [
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36116fa6-5c0d-11e7-907b-a6006ad3dba0",
            "name": "title",
            "searchable": "1",
            "to_retrieve": "1",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        }
    ]
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
    -d "search_use_case_id"="5f613177-6fc4-3696-a704-350726307858" \
    -d "data_stream_field_id"="367432bf-4fdd-38ea-9001-284f3df79b49" \
    -d "name"="Quam minus asperiores" \
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
        "search_use_case_id": "5f613177-6fc4-3696-a704-350726307858",
        "data_stream_field_id": "367432bf-4fdd-38ea-9001-284f3df79b49",
        "name": "Quam minus asperiores",
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
    -d "search_use_case_id"="f882464e-fbcd-342c-972a-6f628ac8bba1" \
    -d "data_stream_field_id"="1ad0bb76-50c0-32e0-957b-2c60641c6665" \
    -d "name"="Sint ipsam autem" \
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
        "search_use_case_id": "f882464e-fbcd-342c-972a-6f628ac8bba1",
        "data_stream_field_id": "1ad0bb76-50c0-32e0-957b-2c60641c6665",
        "name": "Sint ipsam autem",
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "search_use_case_id": "dc5bfd4c-711e-11e7-8cf7-a6006ad3dba0",
            "data_stream_field_id": "36117334-5c0d-11e7-907b-a6006ad3dba0",
            "name": "content",
            "searchable": "0",
            "to_retrieve": "1",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc63f307000000002fc7",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "a105ea325f43bed324be09412d9c84a6",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc640e6800000000aa73",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "6b72932de7dda8f1dc8cd643364893e1",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc641f5f00000000ab92",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "2832ee61c4da00a50b1b40088b8b5f1e",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc643160000000000cea",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "1e66e961fe69f7b35c230ce0be26e869",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6afc5000000000fe1f",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "7c28d4099ac14c9726c6115766ae0a77",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b00ce00000000c233",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "7218e40ac31ebc2b480391dd6b33fe33",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b2303000000002949",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "5d3a4ec490d42fef155d4576f96a8f3d",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b3d3e000000006ca1",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "85180bc33703520dff63edd261052370",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b4914000000008380",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "48e0e365ef7463b0ef9b12a7195f89aa",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        }
    ],
    "meta": {
        "pagination": {
            "total": 733,
            "count": 10,
            "per_page": 10,
            "current_page": 1,
            "total_pages": 74,
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
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc63f307000000002fc7",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "a105ea325f43bed324be09412d9c84a6",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc640e6800000000aa73",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "6b72932de7dda8f1dc8cd643364893e1",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc641f5f00000000ab92",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "2832ee61c4da00a50b1b40088b8b5f1e",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc643160000000000cea",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "1e66e961fe69f7b35c230ce0be26e869",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6afc5000000000fe1f",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "7c28d4099ac14c9726c6115766ae0a77",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b00ce00000000c233",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "7218e40ac31ebc2b480391dd6b33fe33",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b2303000000002949",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "5d3a4ec490d42fef155d4576f96a8f3d",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b3d3e000000006ca1",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "85180bc33703520dff63edd261052370",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        },
        {
            "item_id": "4f72bc6b4914000000008380",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "item_signature": "48e0e365ef7463b0ef9b12a7195f89aa",
            "created_at": "2017-07-28 10:22:46",
            "updated_at": "2017-07-28 10:22:46"
        }
    ],
    "meta": {
        "pagination": {
            "total": 733,
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
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTask?root=1?root=1sync_task_status_id=Plannedplanned_before=1974-12-17planned_after=1974-12-17",
    "method": "GET",
    "headers": {
        "Accept": "application/json",
        "Authentication" : "Bearer xxx"
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
            "planned_at": "2017-07-28 10:20:27",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:22:48",
            "sync_task_logs_count": 3,
            "children_sync_tasks_count": 4
        },
        {
            "id": "f542c0e4-729e-11e7-8cf7-a6006ad3dba0",
            "sync_task_id": null,
            "sync_task_type_id": "Main",
            "sync_task_status_id": "Planned",
            "created_by_user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-07-28 10:30:27",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27",
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
        "sync_task_status_id": "Complete",
        "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
        "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
        "planned_at": "2017-07-28 10:20:27",
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:22:48",
        "sync_task_logs_count": 3,
        "children_sync_tasks_count": 4
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
    "data": [
        {
            "id": "44fa8d59-dd24-4729-99ef-dfa8186ce509",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamDownload",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-07-28 10:22:32",
            "updated_at": "2017-07-28 10:22:44",
            "sync_task_logs_count": 4,
            "children_sync_tasks_count": 0
        },
        {
            "id": "4a9cebba-478f-454a-b295-1d4cde08b612",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamPrepare",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-07-28 10:22:44",
            "updated_at": "2017-07-28 10:22:45",
            "sync_task_logs_count": 9,
            "children_sync_tasks_count": 0
        },
        {
            "id": "63cd40b8-bb04-443b-a5aa-fe85e33aa6ff",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "DataStreamCheck",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-07-28 10:22:44",
            "updated_at": "2017-07-28 10:22:44",
            "sync_task_logs_count": 3,
            "children_sync_tasks_count": 0
        },
        {
            "id": "db965a8b-9d95-4a89-9a79-dee1c62cd1e3",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "sync_task_type_id": "ItemsInsertion",
            "sync_task_status_id": "Complete",
            "created_by_user_id": null,
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": null,
            "created_at": "2017-07-28 10:22:44",
            "updated_at": "2017-07-28 10:22:47",
            "sync_task_logs_count": 7,
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
            "sync_task_status_id": "Complete",
            "created_by_user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "planned_at": "2017-07-28 10:20:27",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:22:48",
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
            "id": "53dd5304-4dac-4ca2-8ae7-c7c90f852f58",
            "sync_task_status_id": "InProgress",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Sync. task started",
            "public": true,
            "created_at": "2017-07-28 10:22:32",
            "updated_at": "2017-07-28 10:22:32"
        },
        {
            "id": "bfbf48da-210d-11e7-93ae-92361f002671",
            "sync_task_status_id": "Planned",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Synchronization planned.",
            "public": true,
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "c0d3f8ae-740f-42f4-8c90-8f1546b0ded9",
            "sync_task_status_id": "Complete",
            "sync_task_id": "8dbfd6e6-2055-11e7-93ae-92361f002671",
            "entry": "Sync. task complete",
            "public": true,
            "created_at": "2017-07-28 10:22:48",
            "updated_at": "2017-07-28 10:22:48"
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
            "sync_tasks_count": 5,
            "sync_task_logs_count": 5,
            "sync_task_status_versions_count": 2
        },
        {
            "id": "InProgress",
            "sync_tasks_count": 0,
            "sync_task_logs_count": 20,
            "sync_task_status_versions_count": 2
        },
        {
            "id": "Planned",
            "sync_tasks_count": 1,
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
        "sync_tasks_count": 1,
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_status_id": "Complete",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est terminée",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is in progress.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_status_id": "InProgress",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est en cours.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "en_US",
            "description": "Items synchronization is planned.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
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
    -d "sync_task_status_id"="Provident voluptates quos" \
    -d "i18n_lang_id"="Quam voluptatibus placeat" \
    -d "description"="Iusto tenetur dignissimos" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion",
    "method": "POST",
    "data": {
        "sync_task_status_id": "Provident voluptates quos",
        "i18n_lang_id": "Quam voluptatibus placeat",
        "description": "Iusto tenetur dignissimos"
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
    -d "sync_task_status_id"="Fugit sapiente aut" \
    -d "i18n_lang_id"="Ea provident officia" \
    -d "description"="Temporibus molestiae voluptas" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskStatusVersion/Planned,en_US",
    "method": "PUT",
    "data": {
        "sync_task_status_id": "Fugit sapiente aut",
        "i18n_lang_id": "Ea provident officia",
        "description": "Temporibus molestiae voluptas"
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_status_id": "Planned",
            "i18n_lang_id": "fr_FR",
            "description": "La synchronisation des items est plannifiée",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
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
            "sync_tasks_count": 1,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "DataStreamDownload",
            "sync_tasks_count": 1,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "DataStreamPrepare",
            "sync_tasks_count": 1,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "ItemsDelete",
            "sync_tasks_count": 0,
            "sync_task_type_versions_count": 2
        },
        {
            "id": "ItemsInsertion",
            "sync_tasks_count": 1,
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "DataStreamCheck",
            "i18n_lang_id": "fr_FR",
            "description": "Comparaison et vérification des données téléchargées.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "fr_FR",
            "description": "Téléchargement des données fournies par l'url du flux de données.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "fr_FR",
            "description": "Ventilation des données pour la création, modification ou suppression.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "fr_FR",
            "description": "Suppression d'enregistrements.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "fr_FR",
            "description": "Création des nouveaux enregistrements.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
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
    -d "sync_task_type_id"="Sit blanditiis molestiae" \
    -d "i18n_lang_id"="Quaerat quo velit" \
    -d "description"="Libero qui minima" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion",
    "method": "POST",
    "data": {
        "sync_task_type_id": "Sit blanditiis molestiae",
        "i18n_lang_id": "Quaerat quo velit",
        "description": "Libero qui minima"
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
    -d "sync_task_type_id"="Sequi eum voluptatem" \
    -d "i18n_lang_id"="Qui aut quaerat" \
    -d "description"="Est qui quo" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/syncTaskTypeVersion/Main,en_US",
    "method": "PUT",
    "data": {
        "sync_task_type_id": "Sequi eum voluptatem",
        "i18n_lang_id": "Qui aut quaerat",
        "description": "Est qui quo"
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
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "DataStreamDownload",
            "i18n_lang_id": "en_US",
            "description": "Downloading the provided data feed url of the data stream.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "DataStreamPrepare",
            "i18n_lang_id": "en_US",
            "description": "Data breakdown for creation, edition or deletion.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "ItemsDelete",
            "i18n_lang_id": "en_US",
            "description": "Deleting records.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "ItemsInsertion",
            "i18n_lang_id": "en_US",
            "description": "Creating new records.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "ItemsUpdate",
            "i18n_lang_id": "en_US",
            "description": "Updating records.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
        },
        {
            "sync_task_type_id": "Main",
            "i18n_lang_id": "en_US",
            "description": "Main task who rules and manage subtasks.",
            "created_at": "2017-07-28 10:10:24",
            "updated_at": "2017-07-28 10:10:24"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "509dd5c0-1389-11e7-93ae-92361f002671",
            "user_group_id": "Support",
            "name": "Alan Smithee",
            "email": "alan.smithee@domain.tld",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "605c7610-1389-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "John Smith",
            "email": "john.smith@domain.tld",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
        "created_at": "2017-07-28 10:10:27",
        "updated_at": "2017-07-28 10:10:27"
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
    -d "name"="Excepturi illo sed" \
    -d "email"="elbert33@example.com" \
    -d "password"="xtwhd#MynvaXa}:CN" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user",
    "method": "POST",
    "data": {
        "user_group_id": "End-User",
        "name": "Excepturi illo sed",
        "email": "elbert33@example.com",
        "password": "xtwhd#MynvaXa}:CN"
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
    -d "user_group_id"="Developer" \
    -d "name"="Et pariatur placeat" \
    -d "email"="damien.beier@example.org" \
    -d "password"="&amp;o&amp;}b&amp;eVQVv&#039;(&#039;dY#N%0" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/user/605c7610-1389-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_group_id": "Developer",
        "name": "Et pariatur placeat",
        "email": "damien.beier@example.org",
        "password": "&o&}b&eVQVv'('dY#N%0"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "id": "82b5da82-138c-11e7-93ae-92361f002671",
            "user_group_id": "End-User",
            "name": "Mickey Mouse",
            "email": "mickey.mouse@domain.tld",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "b6860dd2-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "user_id": "605c7610-1389-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "1bcc7efc-138c-11e7-93ae-92361f002671",
            "user_role_id": "Administrator",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
        },
        {
            "user_id": "82b5da82-138c-11e7-93ae-92361f002671",
            "project_id": "c4b5d93c-138c-11e7-93ae-92361f002671",
            "user_role_id": "Owner",
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
            "created_at": "2017-07-28 10:10:27",
            "updated_at": "2017-07-28 10:10:27"
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
    -d "user_id"="404fe5f7-f386-3a46-8d8e-367dcebe55ec" \
    -d "project_id"="9055b790-83e1-30b2-8f34-b7ad0d7eef57" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject",
    "method": "POST",
    "data": {
        "user_id": "404fe5f7-f386-3a46-8d8e-367dcebe55ec",
        "project_id": "9055b790-83e1-30b2-8f34-b7ad0d7eef57",
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
    -d "user_id"="9e63deb2-fa00-3722-b255-e9164f8858fa" \
    -d "project_id"="4caf48c8-fbf1-30ae-844d-7e6283aababc" \
    -d "user_role_id"="Owner" \

```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://emsearch.ryan.ems-dev.net/api/userHasProject/605c7610-1389-11e7-93ae-92361f002671,1bcc7efc-138c-11e7-93ae-92361f002671",
    "method": "PUT",
    "data": {
        "user_id": "9e63deb2-fa00-3722-b255-e9164f8858fa",
        "project_id": "4caf48c8-fbf1-30ae-844d-7e6283aababc",
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

