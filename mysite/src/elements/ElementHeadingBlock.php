<?php

namespace DNADesign\Elemental\Models;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * @package elemental
 */
class ElementHeadingBlock extends ElementContent
{
    private static $icon = 'elemental/images/content.svg';

    private static $db = array(
        'Text' => 'Text',
        'Alignment' => 'Enum("Left, Centre, Right","Centre")',
        'Heading' => 'Enum("H1, H2, H3","H1")'
    );

    private static $table_name = 'IntroTextElement';

    private static $title = 'Intro Text Block';

    private static $description = 'Intro text block';

    private static $singular_name = 'intro text block';

    private static $plural_name = 'intro text blocks';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Intro Text');
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->removeByName('HTML');

        return $fields;
    }

    public function getSummary()
    {
        return DBField::create_field('Text', $this->Text)->Summary(20);
    }
}
