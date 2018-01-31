<div class="imagelist <% if $Style %>imagelist--$CssStyle<% end_if %>">
	<% if $Display = 'Carousel' %>
		<% include Slick Items=$Images() %>
	<% else_if $Display = 'Grid' %>
		<% include ImageGrid Items=$Images() %>
	<% else %>
		<% include ImageStack Items=$Images() %>
	<% end_if %>
</div>
