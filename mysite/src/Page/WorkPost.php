<?php

use SilverStripe\Blog\Model\BlogPost;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\ORM\DataObject as DataObject;
use DNADesign\Elemental\Models\ElementalArea as ElementalArea;
use DNADesign\Elemental\Extensions\ElementalAreasExtension;

class WorkPost extends BlogPost
{
    private static $db = [
        'Project' => 'Varchar(255)',
        'Year' => 'Enum("2015,2016,2017,2018","2017")',
        'Client' => 'Varchar(255)',
        'Deliverable' => 'Varchar(255)'
    ];

    private static $table_name = 'WorkPost';

    private static $singular_name = 'Work post';

    private static $plural_name = 'Work post';

    private static $description = 'A piece of work which we have done.';

    private static $belongs_many_many = [
        'ElementShowcases' => 'ElementShowcase'
    ];

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
        $fields->addFieldToTab('Root.Main', TextField::create('Project', 'Project name'), 'Content');
        $fields->addFieldToTab('Root.Main', new DropdownField(
            'Year',
            'Year completed',
            $this->dbObject('Year')->enumValues()
        ), 'Content');
        $fields->addFieldToTab('Root.Main', TextField::create('Client', 'Client'), 'Content');
        $fields->addFieldToTab('Root.Main', TextField::create('Deliverable', 'Deliverable'), 'Content');

        return $fields;
    }
}
