<?php

namespace App;

enum Permission: int
{
    case Read = 0;
    case Write = 1;
}
