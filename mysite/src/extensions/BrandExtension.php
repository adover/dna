<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use Heyday\ColorPalette\Fields\ColorPaletteField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\DataExtension;


/**
 * Add extra options to the branding admin
 *
 * @package brand
 */

class BrandExtension extends DataExtension {

    private static $db = array(
        'DefaultColor' => 'Varchar(255)',
        'ApplyTo' => "Enum('Background, Text','Background')"
    );

    private static $has_one = [
        'SharingImage' => Image::class
    ];


    public function updateCMSFields(FieldList $fields) {

        $fields->addFieldToTab('Root.Colours',
            LiteralField::create('HeaderLit', '<h3>Header</h3>')
        );
        $fields->addFieldToTab('Root.Colours',
            $header = ColorPaletteField::create('DefaultColor', 'Default colour', $this->owner->getFullPalette())
        );

        $header->setDescription("NOTE: This can be overridden on a per page basis");

        $fields->addFieldToTab('Root.Colours', $apply = OptionSetField::create(
            'ApplyTo',
            'Apply To',
            $this->owner->dbObject('ApplyTo')->enumValues()
        ));

        $apply->addExtraClass('inline-short-list');

        $fields->addFieldToTab('Root.Images', $upload = UploadField::create('SharingImage', 'Default Sharing Image'));
        $upload->setRightTitle('Default Image used by Social Media. For best results, use an image of 1200 x 630 pixels.');
        $upload->setFolderName('Uploads/brand');
        $upload->setAllowedFileCategories('image/supported');
    }


    // /**
    //  * Publish our dependent objects.
    //  */
    // public function onAfterWrite() {

    //     if($this->owner->SharingImage() && $this->owner->SharingImage()->exists()) {
    //         $this->owner->SharingImage()->publishSingle();
    //     }

    //     parent::onAfterWrite();
    // }
}
