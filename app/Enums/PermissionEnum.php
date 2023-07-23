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
    case PERMISSIONS = "";

    #[Description("can show all data roles")] #[FeatureGroup("roles")]
    case ROLES_INDEX = "roles.index";
    #[Description("can show form edit data roles")] #[FeatureGroup("roles")]
    case ROLES_EDIT = "roles.edit";
    #[Description("can update data roles")] #[FeatureGroup("roles")]
    case ROLES_UPDATE = "roles.update";
}
