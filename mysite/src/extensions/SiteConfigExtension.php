<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RelationEditor;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataExtension;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;

/**
 * Adds new global settings.
 *
 * @package mysite
 */

class SiteConfigExtension extends DataExtension {

    private static $db = [
        'GACode' => 'Varchar(16)',
        'Copyright' => 'Varchar(255)',
        'EmailPlaceHolder' => 'Varchar(100)'
    ];

    private static $has_one = [
        'TermsPrivacyPolicy' => SiteTree::class
    ];

    private static $has_many = [
        'FooterLinks' => SiteLink::class,
        'SocialLinks' => IconLink::class
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {

        $fields->addFieldToTab(
            'Root.Main',
            $gaCode = TextField::create(
                'GACode',
                'Google Analytics account'
            )
        );
        $gaCode->setDescription(
            'Account number to be used all across the site (in the format <strong>UA-XXXXX-X</strong>)'
        );

        $this->owner->addSocialTab($fields);
        $this->owner->addFooterTab($fields);
    }

    /**
     * @param FieldList $fields
     */
    public function addSocialTab(FieldList $fields)
    {
        $socialGrid = new GridField (
            'SocialLinks',
            'Social Links',
            $this->owner->SocialLinks(),
            GridFieldConfig_RelationEditor::create()
        );

        $socialGrid->setModelClass('IconLink');

        $gridConfig = $socialGrid->getConfig();
        $gridConfig->addComponent(GridFieldOrderableRows::create('Sort'));

        $fields->addFieldToTab('Root.Social', $socialGrid);
    }

    /*
     * @param FieldList $fields
     */
    public function addFooterTab(FieldList $fields)
    {
        $siteLinkGrid = new GridField (
            'FooterLinks',
            'Footer Links',
            $this->owner->FooterLinks(),
            GridFieldConfig_RelationEditor::create()
        );

        $siteLinkGrid->setModelClass('SiteLink');

        $gridConfig = $siteLinkGrid->getConfig();
        $gridConfig->addComponent(GridFieldOrderableRows::create('Sort'));

        $fields->addFieldToTab('Root.Footer', $siteLinkGrid);
        $fields->addFieldToTab('Root.Footer', TreeDropdownField::create('TermsPrivacyPolicyID', 'Terms and Privacy Policy Link', SiteTree::class));
        $fields->addFieldToTab('Root.Footer', TextField::create('EmailPlaceHolder', 'Email placeholder'));
        $fields->addFieldToTab('Root.Footer', TextField::create('Copyright', 'Copyright text'));

    }

}
