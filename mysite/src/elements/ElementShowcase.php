<?php

namespace DNADesign\Elemental\Models;

use DNADesign\Blog\Model\DNABlog;
use SilverStripe\Blog\Model\BlogController;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\HTMLEditor\HtmlEditorField;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\View\ArrayData;
use UndefinedOffset\SortableGridField\Forms\GridFieldSortableRows;

/**
 * @package elemental
 * Returns an alternating list of content
 */
class ElementShowcase extends BaseElement
{
    private static $db = [
        // 'WhatToShow' => 'Enum("Work, Insights, All", "All")'
    ];

    private static $table_name = 'ElementShowcase';

    private static $singular_name = 'showcase block';

    private static $plural_name = 'showcase blocks';

    private static $description = 'Showcase block';

    public function getPosts()
    {
        $posts = DNABlog::get_posts(null);

        return $posts;
    }

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Showcase');
    }
}
