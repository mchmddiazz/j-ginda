<?php

namespace App\Enums;

use App\Enums\MetaProperties\Description;
use App\Enums\MetaProperties\FeatureGroup;
use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Meta\Meta;
use ArchTech\Enums\Metadata;
use ArchTech\Enums\Values;

#[Meta(Description::class, FeatureGroup::class)]
enum PermissionEnum: string
{
    use InvokableCases;
    use Values;
    use Metadata;

    #[Description("can show all data permissions")] #[FeatureGroup("permissions")]
    case PERMISSIONS_INDEX = "permissions.index";

    #[Description("can show all data roles")] #[FeatureGroup("roles")]
    case ROLES_INDEX = "roles.index";
    #[Description("can show form edit data roles")] #[FeatureGroup("roles")]
    case ROLES_EDIT = "roles.edit";
    #[Description("can update data roles")] #[FeatureGroup("roles")]
    case ROLES_UPDATE = "roles.update";


    #[Description("can show all data about us")] #[FeatureGroup("about us")]
    case ABOUT_US_INDEX = "about.us.index";
    #[Description("can show form add new data about us")] #[FeatureGroup("about us")]
    case ABOUT_US_CREATE = "about.us.create";
    #[Description("can add new data about us")] #[FeatureGroup("about us")]
    case ABOUT_US_STORE = "about.us.store";
    #[Description("can show form edit data about us")] #[FeatureGroup("about us")]
    case ABOUT_US_EDIT = "about.us.edit";
    #[Description("can update data about us")] #[FeatureGroup("about us")]
    case ABOUT_US_UPDATE = "about.us.update";
    #[Description("can delete data about us")] #[FeatureGroup("about us")]
    case ABOUT_US_DESTROY = "about.us.destroy";


    #[Description("can show all data user")] #[FeatureGroup("users")]
    case USERS_INDEX = "users.index";
    #[Description("can show form add new data user")] #[FeatureGroup("users")]
    case USERS_CREATE = "users.create";
    #[Description("can add new data user")] #[FeatureGroup("users")]
    case USERS_STORE = "users.store";
    #[Description("can show form edit data user")] #[FeatureGroup("users")]
    case USERS_EDIT = "users.edit";
    #[Description("can update data user")] #[FeatureGroup("users")]
    case USERS_UPDATE = "users.update";
    #[Description("can delete data user")] #[FeatureGroup("users")]
    case USERS_DESTROY = "users.destroy";


    #[Description("can show all data product from admin")] #[FeatureGroup("admin products")]
    case ADMIN_PRODUCTS_INDEX = "admin.products.index";
    #[Description("can add new data product from admin")] #[FeatureGroup("admin products")]
    case ADMIN_PRODUCTS_STORE = "admin.products.store";
    #[Description("can show form edit data product from admin")] #[FeatureGroup("admin products")]
    case ADMIN_PRODUCTS_EDIT = "admin.products.edit";
    #[Description("can update data product from admin")] #[FeatureGroup("admin products")]
    case ADMIN_PRODUCTS_UPDATE = "admin.products.update";
    #[Description("can delete data product from admin")] #[FeatureGroup("admin products")]
    case ADMIN_PRODUCTS_DESTROY = "admin.products.destroy";
    #[Description("can show all data product low quantity from admin")] #[FeatureGroup("admin products")]
    case ADMIN_PRODUCTS_LOW_QUANTITY = "admin.products.low.quantity";


    #[Description("can add request production")] #[FeatureGroup("request production")]
    case ADMIN_REQUEST_PRODUCTION_STORE = "admin.request.production.store";
    #[Description("can show list request production")] #[FeatureGroup("request production")]
    case ADMIN_REQUEST_PRODUCTION_INDEX = "admin.request.production.index";
    #[Description("can confirm production done for request production")] #[FeatureGroup("request production")]
    case ADMIN_REQUEST_PRODUCTION_UPDATE = "admin.request.production.update";

}
