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
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#Authentication


APIs for Authentication drivers
<!-- START_a925a8d22b3615f12fca79456d286859 -->
## Get a JWT via given credentials.

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"karim.elbadry2@gmail.com","password":"karim"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "karim.elbadry2@gmail.com",
    "password": "karim"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The Email of the Driver.
        `password` | string |  required  | The Password of the Driver.
    
<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_19ff1b6f8ce19d3c444e9b518e8f7160 -->
## Log the user out (Invalidate the token).

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/logout`


<!-- END_19ff1b6f8ce19d3c444e9b518e8f7160 -->

<!-- START_994af8f47e3039ba6d6d67c09dd9e415 -->
## Refresh a token.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/refresh`


<!-- END_994af8f47e3039ba6d6d67c09dd9e415 -->

<!-- START_a47210337df3b4ba0df697c115ba0c1e -->
## Get the authenticated Driver.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/auth/me" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"karim.elbadry2@gmail.com","password":"karim"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/auth/me"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "karim.elbadry2@gmail.com",
    "password": "karim"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/me`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | The Email of the Driver.
        `password` | string |  required  | The Password of the Driver.
    
<!-- END_a47210337df3b4ba0df697c115ba0c1e -->

#general


<!-- START_b89b3ee371a505980da4803b591163ce -->
## Update driver&#039;s info.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/driver/info/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"karim.elbadry2@gmail.com","password":"karim","name":"Karim Mahmoud","avatar":"occaecati","vehicle":"Car."}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/driver/info/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "karim.elbadry2@gmail.com",
    "password": "karim",
    "name": "Karim Mahmoud",
    "avatar": "occaecati",
    "vehicle": "Car."
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/driver/info/update`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  optional  | The Email of the Driver.
        `password` | string |  optional  | The Password of the Driver.
        `name` | string |  optional  | The Password of the Driver.
        `avatar` | string |  optional  | The Password of the Driver.
        `vehicle` | enum |  optional  | The Password of the Driver Values ["Car", "Bicycle", "Van", "Motorcycle", "None"].
    
<!-- END_b89b3ee371a505980da4803b591163ce -->

<!-- START_2111a6c9994161338dd660c048995168 -->
## Update Driver&#039;s Location.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/driver/location/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"lat":"30.044420","long":"31.235712"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/driver/location/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "lat": "30.044420",
    "long": "31.235712"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/driver/location/update`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `lat` | long |  required  | The Latitude of the Driver.
        `long` | long |  required  | The Longitude of the Driver.
    
<!-- END_2111a6c9994161338dd660c048995168 -->

<!-- START_73f6f5c1023cafbe8728c9e214794062 -->
## Update Driver&#039;s Availability.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/driver/status/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"available":true}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/driver/status/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "available": true
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/driver/status/update`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `available` | boolean |  required  | Change the driver's availability status.
    
<!-- END_73f6f5c1023cafbe8728c9e214794062 -->

<!-- START_101ae5f3c8ee19464dd615f1817449ff -->
## Update Tasks status.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/task/1/status/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"status":"Waiting"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/task/1/status/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "Waiting"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/task/{DriverPackage}/status/update`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | The ID of the Package.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `status` | Enum |  optional  | (Waiting,Approved,Rejected,Delivering,Delivered) default(gets all).
    
<!-- END_101ae5f3c8ee19464dd615f1817449ff -->

<!-- START_89ef996cda3c3587f8cc15df8329a27b -->
## Get Tasks.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/task/all?start_date=MM%2FDD%2FYYYY&end_date=MM%2FDD%2FYYYY&limit=10&sort_by=id&sort_type=ASC&status=Waiting&search=nesciunt" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/task/all"
);

let params = {
    "start_date": "MM/DD/YYYY",
    "end_date": "MM/DD/YYYY",
    "limit": "10",
    "sort_by": "id",
    "sort_type": "ASC",
    "status": "Waiting",
    "search": "nesciunt",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "status": "Authorization Token not found"
}
```

### HTTP Request
`GET api/task/all`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `start_date` |  optional  | Date default(no start date).
    `end_date` |  optional  | Date default(no end date).
    `limit` |  optional  | Integer the number of results u want default(unlimited).
    `sort_by` |  optional  | Enum (id, created_at) default(id).
    `sort_type` |  optional  | Enum (ASC, DESC) default(id).
    `status` |  optional  | Enum (Waiting,Approved,Rejected,Delivering,Delivered) default(gets all).
    `search` |  optional  | string search for a package.

<!-- END_89ef996cda3c3587f8cc15df8329a27b -->


