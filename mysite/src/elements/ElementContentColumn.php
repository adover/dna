<?php

namespace DNADesign\Elemental\Models;

use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
use SilverStripe\ORM\FieldType\DBField;

/**
 * @package elemental
 * To be used underneath list item
 */
class ElementContentColumn extends ElementContent
{
    private static $db = [
        'ColumnWidth' => 'Enum("2,3,4,5,6", "3")',
        'ColumnOffset' => 'Enum("0,1,2,3,4,5,6", "0")'
    ];

    private static $table_name = 'ElementContentColumn';

    private static $singular_name = 'column content block';

    private static $plural_name = 'column content blocks';

    private static $description = 'Column content block';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Content Column');
    }
}
