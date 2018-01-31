<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\Security\Permission;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Security;
use SilverStripe\SiteConfig\SiteConfig;


class SiteLink extends DataObject {
    use Configurable;

    private static $table_name = 'SiteLink';

    private static $db = [
        'Title' => 'Varchar(255)',
        'Sort' => 'Int'
    ];

    private static $has_one = [
        'Link' => SiteTree::class,
        'Parent' => SiteConfig::class
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'Link.URLSegment' => 'URL Segment'
    ];

    public function getCMSFields() {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldsToTab('Root.Main', [
                $title = TextField::create('Title'),
                TreeDropdownField::create('LinkID','Link', SiteTree::class)
            ]);

            $title->setRightTitle('Optional: Navigation title will be used if left blank');

            $fields->removeByName('ParentID');
            $fields->removeByName('Sort');

        });
        return parent::getCMSFields();
    }

    /**
     * Set the title  to the menu title if no title exists
     */
    public function onBeforeWrite()
    {
        if(!$this->Title && $this->LinkID && $this->Link()->exists()) {
            $this->Title = $this->Link()->MenuTitle;
        }
        parent::onBeforeWrite();

    }

    /**
     * @param null $member
     * @param array $context
     * @return bool|int
     */
    public function canView($member = null, $context = [])
    {
        return $this->canEdit($member);
    }

    /**
     * @param null $member
     * @param array $context
     * @return bool|int
     */
    public function canEdit($member = null, $context = [])
    {
        if (!$member) {
            $member = Security::getCurrentUser();
        }

        return Permission::checkMember($member, "EDIT_SITECONFIG");
    }

    /**
     * @param null $member
     * @param array $context
     * @return bool|int
     */
    public function canCreate($member = null, $context = [])
    {
        return $this->canEdit($member);
    }

    /**
     * @param null $member
     * @param array $context
     * @return bool|int
     */
    public function canDelete($member = null, $context = [])
    {
        return $this->canEdit($member);
    }

}
