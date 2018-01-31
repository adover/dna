<?php

namespace DNADesign\Elemental\Models;

use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Member;

/**
 * @package elemental
 * Returns a list of Members who are
 */
class ElementMemberList extends BaseElement
{
    private static $icon = 'elemental/images/content.svg';

    private static $table_name = 'MemberList';

    private static $title = 'Member list';

    private static $description = 'member list';

    private static $singular_name = 'member list';

    private static $plural_name = 'member lists';

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Member List');
    }

    public function getMembers()
    {
        $staff = Member::get()->filter('ShowOnWebsite', 1);

        return $staff;
    }

    public function getSummary()
    {
        return 'Returns a list of members';
    }
}
