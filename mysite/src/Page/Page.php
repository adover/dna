<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TextareaField;

class Page extends SiteTree
{

    private static $icon = 'mysite/images/icons/page.svg';

    private static $db = [
        "Intro" => "Text",
        "ImageField" => "DBFile('image/supported')"
    ];

    private static $has_one = [
        'SharingImage' => Image::class
    ];

    private static $owns = [
        'SharingImage'
    ];

    private static $extensions = [
        "BrandDataObjectExtension"
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $htmlField = TextareaField::create("Intro", "Intro");
        $fields->addFieldToTab('Root.Main', $htmlField, 'Content');

        $fields->addFieldToTab('Root.Theme', $upload = UploadField::create('SharingImage', 'Sharing Image'));
        $upload->setRightTitle('Used by Social Media and when this page appears within listings. For best results, use an image of 1200 x 630 pixels. It will be resized as appropriate');
        $upload->setAllowedFileCategories('image/supported');

        return $fields;
    }

    public function getClassNameCSSSafe() {
        return strtolower(str_replace('\\', '-', $this->ClassName));
    }
}
