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
    -d '{"email":"karim.elbadry2@gmail.com","password":"karim","name":"Karim Mahmoud","avatar":"dignissimos","vehicle":"Car."}'

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
    "avatar": "dignissimos",
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


