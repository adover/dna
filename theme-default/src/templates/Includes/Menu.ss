<div class="menu">
	<div class="menu-container">
        <nav class="menu-nav" role="navigation" id="main-menu" aria-hidden="true" data-menu>
            <h2 class="sr-only">Main navigation</h2>
            <ul class="menu-list">
                <% loop Menu(1) %>
                    <li class="$LinkingMode menu-item">
                        <a href="$Link" class="$LinkingMode menu-link <% if $LinkingMode = current %> menu-item-selected<% end_if %>">
                            {$MenuTitle.XML}.
                        </a>
                    </li>
                <% end_loop %>
            </ul>

            <p class="menu-tagline">Problem solved.</p>
	    </nav>
    </div>
</div>
