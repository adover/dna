<?php

namespace DNADesign\Extensions;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLTextField;
use SilverStripe\ORM\DataExtension;

/**
 * Add extra options to the Member, to allow for showing them all on the front end
 *
 * @package brand
 */

class MemberExtension extends DataExtension
{

    private static $db = array(
        'ShowOnWebsite' => 'Boolean',
        'JobTitle' => 'Varchar(100)',
        'Office' => 'Enum("Auckland, Wellington")',
        'Department' => 'Enum("Development, UX/Design, CX, Client Services, Senior")',
        'HasBeard' => 'Boolean',
        'IsDog' => 'Boolean',
        'LinkedinURL' => 'Varchar(255)'
    );

    /**
     * {@inheritdoc}
     *
     * Ensure BlogProfileImage is published
     */
    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if ($this->owner->BlogProfileImage()->exists() && !$this->owner->BlogProfileImage()->isPublished()) {
            $this->owner->BlogProfileImage()->publishSingle();
        }
    }
}
