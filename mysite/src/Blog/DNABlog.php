<?php

namespace DNADesign\Website\Blog;

use SilverStripe\Blog\Model\Blog;
use SilverStripe\Blog\Model\BlogPost;
use SilverStripe\Control\Controller;
use SilverStripe\Control\HTTP;
use SilverStripe\ORM\PaginatedList;

class DNABlog extends Blog
{
    private static $table_name = 'DNABlog';

    public function canCreate($member = null, $context = [])
    {
        return false;
    }

    public static function get_posts($type = null, $object = null, $excludeID = 0, $limit = 20, $start = 0)
    {

        $curr = Controller::curr();
        $joinTable = false;
        $joinCond = false;
        $tableStage = '';
        $action = 'posts_all';

        switch ($type) {
            case 'Work':
                $results = WorkPost::get();

                break;
            case 'Insights':
                $results = InsightPost::get();
                break;
            case 'All':
            default:
                $results = BlogPost::get();
                break;
        }

        $results = $results
            ->sort('PublishDate', 'DESC');

        $list = new PaginatedList($results, $curr->getRequest());

        $list->setPageLength($limit);

        if ($limit) {
            if ($list->MoreThanOnePage() && $list->NotLastPage()) {
                $list->ShowMoreLink = HTTP::setGetVar($list->getPaginationGetVar(), $list->getPageStart() + $list->getPageLength() + 1, $curr->Link($action));
            }
        }

        return $list;
    }

}
