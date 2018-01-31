<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

class StaffMember extends DataObject {

    private static $db = [
        'Title' => 'Varchar(255)',
        'Content' => 'HTMLText',
        'Sort' => 'Int'
    ];

    private static $has_one = [
        'Link' => SiteTree::class,
    ];

    private static $summary_fields = [
        'getThumbnail'
    ];

    private static $default_sort = 'Sort ASC';

    private static $extensions = array(
        Versioned::class
    );

    private static $owns = [
        'Image'
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('Sort');
        $fields->removeByName('Stacks');
        $fields->removeByName('Link');

        $title = $fields->dataFieldByName('Title');
        $caption = $fields->dataFieldByName('Caption');
        $content = $fields->dataFieldByName('Content');

        $link = TreeDropdownField::create("LinkID", "Link", SiteTree::class);

        $image = $fields->dataFieldByName('Image');
        $fields->insertBefore('Title', $image);
        $fields->insertAfter('Title', $link);

        $title->setRightTitle("Set from file name if left empty");
        $link->setRightTitle("Optional");
        $caption->setRightTitle("Optional");
        $link->setRightTitle("Optional");
        $content->setRightTitle("Optional");

        return $fields;
    }

    /**
     * Set default Title from Image
     */
    public function onBeforeWrite()
    {
        if($this->Image() && $this->Image()->exists()) {
            $this->Title = $this->Image()->Title;
        }
        parent::onBeforeWrite();
    }

    /**
     * Get an image for display in a tiled gridfield
     * @return bool | Image
     */
    public function getThumbnail()
    {
        if (!$this->Image()->exists() ) {
            return false;
        }
        return $this->Image()->Fill(250,150);
    }

}
