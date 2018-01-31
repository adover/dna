<li class="post
<% if $MultipleOf(3) %> post--rowheight1
<% else_if $Even %> post--rowheight2
<% else %> post--rowheight3<% end_if %>
"


<% if $Categories.exists %> data-category="[<% loop $Categories %>$Title<% if not Last %>,<% end_if %><% end_loop %>]"<% end_if %>>
    <% if $MultipleOf(3) %>
    <a href="$Link">
        $FeaturedImage.FillMax(370, 250)
    </a>
    <% else_if $Even %>
	<a href="$Link">
		$FeaturedImage.FillMax(370, 370)
	</a>
    <% end_if %>

    <div class="post-content">
        <% include TopMeta Homepage=$Homepage %>
        <h2>
            <a href="$Link">
                <% if $MenuTitle %>$MenuTitle
                <% else %>$Title<% end_if %>
            </a>
        </h2>
        <a href="$Link">
            <span class="sr-only"><%t SilverStripe\\Blog\\Model\\Blog.ReadMoreAbout "Read more about '{title}'..." title=$Title %></span>Click me
        </a>
    </div>
</li>
