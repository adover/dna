<div class="pure-g">
	<div class="pure-u">
        <h1>$Title</h1>
        <% if $Intro %>
        <p>$Intro</p>
        <% end_if %>
        <% loop $ContentElements %>
            $Me
        <% end_loop %>
	</div>
</div>
