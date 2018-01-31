<?php

use SilverStripe\CMS\Controllers\ContentController;

use SilverStripe\Assets\File;

class PageController extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * array (
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * );
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [

    ];

    protected function init()
    {
        parent::init();
        // You can include any CSS or JS required by your project here.
        // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
    }

    /**
     * Get the name of a file sans extension
     * @param String/Int $fileId
     * @return String || bool
     */
    public function getFileName($fileId) {
        $file = File::get()->byID($fileId);
        if(!$file) {
            return false;
        }
        return explode('.' . $file->getExtension(), $file->Name)[0];
    }

    /**
     * Get the directory of a file sans filename
     * @param $fileID | - The ID of a file
     * @return
     */
    /**
     * @param String/Int $fileId  - The ID of a file
     * @return String || bool
     */
    public function getFileDir($fileId) {
        $file = File::get()->byID($fileId);
        if(!$file) {
            return false;
        }
        $filename = explode($file->Name, $file->getURL())[0];
        $shortPath = explode('assets', $filename)[1];

        return 'assets' . $shortPath;
    }
}
