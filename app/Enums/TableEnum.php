<?php

namespace App\Enums;

use ArchTech\Enums\InvokableCases;

enum TableEnum: string
{
    use InvokableCases;

    case USERS = "users";
    case ROLES = "roles";
    case ROLE_USERS = "role_users";
    case PRODUCTS = "products";
    case MARKABLE_FAVORITES = "markable_favorites";
    case ORDERS = "orders";
    case ORDER_ITEMS = "order_items";
}