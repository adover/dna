<% require themedCSS('blog', 'blog') %>

<main role="main" id="main">
    <% if $Categories && not $CurrentCategory %>
    <section class="category-list">
         <ul>
            <li class="category category--current"><a href="#">All</a></li>
            <% loop $Categories %>
                <% if $BlogPosts.Count > 0 %>
                    <li class="category"><a href="$Link">$Title</a></li>
                <% end_if %>
            <% end_loop %>
        </ul>
    </section>
    <% end_if %>

    <section class="post-list post-list--$Title.LowerCase">
        <h1>
            <% if $ArchiveYear %>
                <%t SilverStripe\\Blog\\Model\\Blog.Archive 'Archive' %>:
                <% if $ArchiveDay %>
                    $ArchiveDate.Nice
                <% else_if $ArchiveMonth %>
                    $ArchiveDate.format('F, Y')
                <% else %>
                    $ArchiveDate.format('Y')
                <% end_if %>
            <% else_if $CurrentTag %>
                <%t SilverStripe\\Blog\\Model\\Blog.Tag 'Tag' %>: $CurrentTag.Title
            <% else_if $CurrentCategory %>
                <%t SilverStripe\\Blog\\Model\\Blog.Category 'Category' %>: $CurrentCategory.Title
            <% else %>
                $Title
            <% end_if %>
        </h1>

        <% if $Posts %>
            <% loop $Posts %>
                <% include SilverStripe\\Blog\\PostSummary %>
            <% end_loop %>
            <% if  $Posts.ShowMoreLink %>
                <div class="blog_grid_button_holder">
                    <a rel="nofollow" class="button button__blog_show_more blog_show_more" href="$ShowMoreLink">Show more</a>
                </div>
            <% end_if %>
        <% else %>
            <p><%t SilverStripe\\Blog\\Model\\Blog.NoPosts 'There are no posts' %></p>
        <% end_if %>
    </section>
</main>
