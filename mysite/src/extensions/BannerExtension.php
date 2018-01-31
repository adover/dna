<?php

namespace DNADesign\Elemental\Extensions;

use SilverStripe\AssetAdmin\Forms\DropdownField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLTextField;
use SilverStripe\ORM\DataExtension;

/**
 * Add extra options to the Banner, to allow for showing them all on the front end
 *
 * @package brand
 */

class BannerExtension extends DataExtension
{

    private static $db = array(
        'Style' => 'Enum("Fluid, Fixed","Fluid")',
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldToTab(
            'Root',
            DropdownField::create(
                'Style',
                'Style',
                $this->dbObject('Style')->enumValues()
            )
        );
    }
}
