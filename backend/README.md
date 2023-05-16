# Backend

haha websockets

## Json format

First, we need to specify our action, we can either read, write or authorize. We do that by value `auth`

```json
{
    'type': 'auth',
    ...
}
```

When you connect, you receive token, this token **must** be part of every message as `token`

Meaning, that this must be in every message:

```json
{
    'type': '...',
    'token': '...',
}
```

### Auth

In order to authenticate, you need to specify, if you are unit or user. You do that using parameter `as`.

Then you need to provide credentials.

#### Unit

If you are unit, you need to send your id and password. That will be findable at website *neco neco*.

```json
{
    'type': 'auth',
    'token': '...',
    'as': 'unit',
    'id': '37',
    'password': 'parkovar'
}
```

#### User

If you are user, you need to send your name and password

```json
{
    'type': 'auth',
    'token': '...',
    'as': 'user',
    'name': 'mrkvovy_dort',
    'password': 'rohliksmaslem'
}
```


