<?php

namespace App\User;

enum Role: string
{
    case Admin = 'admin';
    case User = 'user';
}
