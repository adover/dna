<section class="banner-container container">
    <% if $File %>
    $File
    <% end_if %>
    <div class="banner">
        <% if $Title && $ShowTitle %>
            <h2 class="banner-title">$Title</h2>
        <% end_if %>
        $Content
        <% if $CallToActionLink.Page.Link %>
            <div class="banner-ctawrapper">
            <% with $CallToActionLink %>
                <a href="{$Page.Link}" class="banner-cta"
                    <% if $TargetBlank %>target="_blank"<% end_if %>
                    <% if $Description %>title="{$Description.ATT}"<% end_if %>>
                    {$Text.XML}
                </a>
            <% end_with %>
            </div>
        <% end_if %>
    </div>
</section>
