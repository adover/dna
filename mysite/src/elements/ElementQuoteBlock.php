<?php

namespace DNADesign\Elemental\Models;

use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * @package elemental
 */
class ElementQuoteBlock extends ElementHeadingBlock
{
    private static $icon = 'elemental/images/content.svg';

    private static $db = [
        'TextFormat' => 'Enum("Serif, Sans-serif", "Serif")',
        'ShowCitation' => 'Boolean',
        'Citation' => 'Varchar(255)'
    ];

    private static $table_name = 'QuoteBlock';

    private static $title = 'Quote Block';

    private static $description = 'quote block';

    private static $singular_name = 'quote block';

    private static $plural_name = 'quote blocks';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Quote block');
    }

    public function getSummary()
    {
        return DBField::create_field('Text', $this->Text)->Summary(20);
    }
}
