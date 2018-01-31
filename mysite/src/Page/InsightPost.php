<?php

use SilverStripe\Blog\Model\BlogPost;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataObject as DataObject;
use DNADesign\Elemental\Models\ElementalArea;
use DNADesign\Elemental\Extensions\ElementalAreasExtension;

class InsightPost extends BlogPost
{

    private static $table_name = 'InsightPost';

    private static $singular_name = 'Insight post';

    private static $plural_name = 'Insight post';

    private static $description = 'A piece of Insight which we have done.';

    private static $has_one = array(
        'ContentElements' => ElementalArea::class
    );

    private static $owns = array(
        'ContentElements'
    );

    private static $extensions = [
        ElementalAreasExtension::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeFieldFromTab('Root.Main', 'CustomSummary');

        return $fields;
    }
}
