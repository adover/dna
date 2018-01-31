<% require themedCSS('blog', 'blog') %>

<section>
    <h1>$Title</h1>
    <% if $Intro %>
    <p>$Intro</p>
    <% end_if %>
    <% loop $ContentElements %>
        $Me
    <% end_loop %>
</section>
