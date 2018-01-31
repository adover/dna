<?php

namespace DNADesign\Blog\Model;

use SilverStripe\Blog\Model\BlogController;

class DNABlogController extends BlogController
{
    public function postsAll()
    {
        return $this->renderWith(array('Blog_posts', 'Page'), array('Posts' => DNABlog::get_posts('All', $this, null, 6)));
    }

    public function postsWork()
    {
        return $this->renderWith(array('Blog_posts', 'Page'), array('Posts' => DNABlog::get_posts('Work', $this, null, 6)));
    }

    public function postsInsights()
    {
        return $this->renderWith(array('Blog_posts', 'Page'), array('Posts' => DNABlog::get_posts('Insights', $this, null, 6)));
    }
}
