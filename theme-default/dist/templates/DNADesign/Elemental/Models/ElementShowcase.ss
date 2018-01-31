<section class="post-list">
    <ul class="posts">
        <% loop $Posts %>
            <% include SilverStripe\\Blog\\PostSummary Homepage='true' %>
        <% end_loop %>
    </ul>
    <% if  $Posts.ShowMoreLink %>
        <a rel="nofollow" class="button button__blog_show_more blog_show_more" href="$ShowMoreLink">Show more</a>
    <% end_if %>
</section>

