<?php

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Core\Config\Configurable;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Security\Permission;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Security;
use SilverStripe\SiteConfig\SiteConfig;


class IconLink extends DataObject {
    use Configurable;

    private static $table_name = 'IconLink';

    private static $db = [
        'Title' => 'Varchar(255)',
        'URL' => 'Varchar(255)',
        'Sort' => 'Int'
    ];

    private static $has_one = [
        'Icon' => File::class,
        'Parent' => SiteConfig::class
    ];

    private static $summary_fields = [
        'iconPreview' => 'Icon',
        'Title' => 'Title',
        'URL' => 'Link'
    ];

    /**
     * @return FieldList
     */
    public function getCMSFields() {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->addFieldsToTab('Root.Main', [
                $title = TextField::create('Title'),
                TextField::create('URL','URL'),
                $iconField = new UploadField('Icon', 'Icon'),
            ]);

            $iconField->getValidator()->setAllowedExtensions(array('svg'));
            $iconField->setFolderName('Uploads/icons');

            $fields->removeByName('ParentID');
            $fields->removeByName('Sort');

        });
        return parent::getCMSFields();
    }

    /**
     * Publish related objects & make sure urls have protocols
     */
    public function onBeforeWrite()
    {
        if($this->Icon() && $this->Icon()->exists()) {
            $this->Icon()->publishSingle();
        }

        if ($this->URL) {

            if(!$this->Title) {
                $this->Title = $this->URL;
            }

            $url = parse_url($this->URL);

            if(!isset($url['scheme'])) {
                $this->URL = 'http://' . $this->URL;
            }

        }

        parent::onBeforeWrite();

    }

    public function iconPreview() {
        if(!$this->Icon() || !$this->Icon()->exists()) {
            return false;
        }
        return DBField::create_field('HTMLVarchar', '<img height="20px" src="' . $this->Icon()->Link() . '" alt="" />');
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
