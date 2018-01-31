<?php

use SilverStripe\Forms\FieldList;
use Heyday\ColorPalette\Fields\ColorPaletteField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\View\ArrayData;
use UncleCheese\DisplayLogic\FormFieldWrapper;


/**
 * Add branding to pages (or dataobjects with a "Content" field)
 *
 * @package brand
 */

class BrandDataObjectExtension extends DataExtension
{

    private static $db = array(
        'Type' => "Enum('Colour, Rainbow','Colour')",
        'Colour' => 'Varchar(255)',
        'ApplyTo' => "Enum('Background, Text','Background')"
    );

    public function updateCMSFields(FieldList $fields)
    {

        $brand = $this->owner->getBrand();

        if ($brand) {

            $fields->addFieldToTab(
                "Root.Theme",
                $type = OptionSetField::create(
                    "Type", "Type",
                    $this->owner->dbObject('Type')->enumValues()
                )
            );

            $type->addExtraClass('inline-short-list');

            $fields->addFieldToTab(
                "Root.Theme",
                $color = FormFieldWrapper::create(
                    ColorPaletteField::create(
                    "Colour", "Colour", $brand->getFullPalette()
                ))
            );

            $fields->addFieldToTab('Root.Theme', $apply =  OptionSetField::create(
                'ApplyTo',
                'Apply To',
                $this->owner->dbObject('ApplyTo')->enumValues()
            ));

            $apply->addExtraClass('inline-short-list');

            $color->hideUnless("Type")->isEqualTo("Colour");
        }
    }

    /**
     * Template method to retrieve text colours
     * @return bool|ArrayData
     */
    public function getTextColour() {
        $brand = $this->owner->getBrand();

        if(!$brand) {
            return false;
        }

        $colorName = $this->owner->Colour ? $this->owner->Colour : $brand->DefaultColor;
        $colour = $brand->getHex($colorName);
        $contrast = $brand->getContrast($colour) === 'light' ? '#000' : '#fff';

        $text = $contrast;

        if($this->getThemeType() === 'text') {
            $text = $colour;
        }

        return ArrayData::create([
            'Color' => $text,
            'ColorName' => $colorName
        ]);
    }

    /**
     * A theme can either be a background colour, and text colour, or rainbow
     * These are stored across 2 db fields, so this is a simple method to retrieve the final type
     * @return string
     */
    public function getThemeType () {
        if($this->owner->Type === 'Rainbow') {
            return 'rainbow';
        }

        if ($this->owner->ApplyTo === 'Text') {
            return 'text';
        }

        return 'background';

    }

    /**
     * Return the palatte for template use
     * @return ArrayList
     */
    public function getPalatte() {
        $result = ArrayList::create();
        $brand = $this->owner->getBrand();

        if(!$brand) {
            return false;
        }

        $palatte =  $brand->owner->getFullPalette();

        foreach($palatte as $key => $value) {
            $result->push(
                ArrayData::create([
                    'Title' => $key,
                    'Color' => $value
            ]));
        }

        return $result;
    }
}
