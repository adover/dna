<header class="header header--fixed header--{$getThemeType()} <% if $getThemeType() != 'rainbow' %> theme-{$getThemeType()}--{$getTextColour().ColorName.LowerCase}<% end_if %>" role="banner">
    <div class="header-container">
        <a href="$BaseHref" class="header-logo">
            <% if $Brand.Logo %>
                $SVG($Top.getFileName($Brand.Logo.ID)).customBasePath($Top.getFileDir($Brand.Logo.ID)).size(89, 34).fill($getTextColour().Color)
            <% else %>
                $SVG('dna-logo').fill($getTextColour().Color)
            <% end_if %>
        </a>

        <button class="header-menutoggle" aria-expanded="false" aria-controls="main-menu" data-menu-toggle>
            <div class="header-menuicon">
                <span class="header-menuiconbar"></span>
                <span class="header-menuiconbar"></span>
                <span class="header-menuiconbar"></span>
                <span class="header-menuiconbar"></span>
            </div>
        </button>
    </div>

    <% include Menu %>
</header>
