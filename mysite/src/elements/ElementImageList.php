<?php

namespace DNADesign\Elemental;

use Axllent\TiledGridField\TiledGridField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\View\Requirements;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

class ElementImageList extends BaseElement
{

    private static $icon = 'mysite/images/icons/imagelist.svg';

    private static $db = [
        'Display' => 'Enum("Stacked, Grid, Carousel", "Stacked")',
        'FeatureFirstImage' => 'Boolean',
        'FullScreen' => 'Boolean'
    ];

    private static $many_many = [
        'Images' => 'ImageItem'
    ];

    private static $owns = [
        'Images'
    ];

    private static $table_name = 'ImageListElement';

    private static $title = 'Image List';

    private static $description = 'Used for carousels, stacks, & grids';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Image List Text');
    }

    public function getCMSFields()
    {
        Requirements::javascript('mysite/js/imagelistelement.js');

        $fields = parent::getCMSFields();

        $fields->removeByName('Images');
        $fields->removeByName('Settings');

        $fields->replaceField(
            'Display',
            $type = OptionSetField::create(
                'Display',
                'Display',
                $this->dbObject('Display')->enumValues()
            )
        );

        $type->addExtraClass('inline-short-list');

        $imageGrid = TiledGridField::create(
            'Images',
            'Image',
            $this->owner->Images(),
            $gridConfig = GridFieldConfig_RelationEditor::create()
        );

        $imageGrid->setModelClass('ImageItem');
        $gridConfig->addComponent(GridFieldOrderableRows::create('Sort'))
            ->addComponent(new GridFieldDeleteAction());

        $fields->addFieldToTab('Root.Main', $imageGrid);

        return $fields;
    }

    /**
     * @return DBField
     */
    public function getSummary()
    {
        $displaySuffix = $this->Display === 'Stacked' ? ' images': ' of images';
        $count = $this->Images()->Count();
        $suffix = $count === 1 ? 'image': 'images';
        $summary = $this->Display ? $this->Display . $displaySuffix . '<br />': '';

        return DBField::create_field('HTMLText', $summary . ' <span class="el-meta">Contains ' . $count . ' ' . $suffix . '</span>');
    }

    public function getImages()
    {
        return $this->Images();
    }
}
