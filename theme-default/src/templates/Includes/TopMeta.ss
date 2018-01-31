<% if $ClassName='InsightPost' && $Homepage='true' %>
    <p class="post-meta">Insight<% if $Categories.exists %> &mdash; $Categories.First.Title<% end_if %></p>
<% else_if $ClassName='InsightPost' %>
    <p class="post-meta"><% if $Categories.exists %>
        <% loop $Categories %>
            <a href="$Link" title="$Title">$Title</a><% if not Last %>, <% else %><% end_if %>
        <% end_loop %>
    <% end_if %>
    <% if $Categories.exists && $Credits %>
        &mdash;
    <% end_if %>
    <% if $Credits %>
        <% loop $Credits %>
            <% if not $First && not $Last %>, <% end_if %>
            <% if not $First && $Last %> <%t SilverStripe\\Blog\\Model\\Blog.AND "and" %> <% end_if %>
            <% if $URLSegment && not $Up.ProfilesDisabled %>
                <a href="$URL">$Name.XML</a>
            <% else %>
                $Name.XML
            <% end_if %>
        <% end_loop %>
    <% end_if %>
    </p>
<% else_if $ClassName='WorkPost' %>
    <p class="post-meta">$Client &mdash; $Deliverable</p>
<% end_if %>
