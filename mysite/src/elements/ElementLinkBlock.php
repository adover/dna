<?php

namespace DNADesign\Elemental\Models;

use SilverStripe\CMS\Model\SiteTree as SiteTree;
use SilverStripe\Forms\TreeDropdownField;

/**
 * @package elemental
 * To be used underneath list item
 */
class ElementLinkblock extends BaseElement
{
    private static $table_name = 'ElementLinkblock';

    private static $singular_name = 'Link block';

    private static $plural_name = 'Link blocks';

    private static $description = 'Link block';

    private static $has_one = ['PageToLinkTo' => SiteTree::class];

    public function getCMSFields()
    {
        $fields = Parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TreeDropdownField::create('PageToLinkToID', 'Choose a page to show on the right:', SiteTree::class));

        return $fields;
    }

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Link block');
    }
}
