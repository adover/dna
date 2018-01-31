<?php

namespace DNADesign\Website\Page;

use DNADesign\Elemental\Extensions\ElementalAreasExtension;
use DNADesign\Elemental\Models\ElementalArea;

class ContentElementPage extends Page
{
    private static $icon = 'mysite/images/icons/blocks.svg';

    private static $has_one = array(
        'ContentElements' => ElementalArea::class
    );

    private static $owns = array(
        'ContentElements'
    );

    private static $extensions = [
        ElementalAreasExtension::class
    ];

}
