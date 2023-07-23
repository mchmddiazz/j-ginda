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
}
