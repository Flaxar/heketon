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

### Auth

In order to authenticate, you need to specify, if you are unit or user. You do that using parameter `as`.

Then you need to provide credentials.

#### Unit

If you are unit, you need to send your id and password. That will be findable at website *neco neco*.

```json
{
    'type': 'auth',
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
    'as': 'user',
    'name': 'mrkvovy_dort',
    'password': 'rohliksmaslem'
}
```

### Adding

In order to add anytning, user **must** be admin. Then they must say what entity are they adding.

