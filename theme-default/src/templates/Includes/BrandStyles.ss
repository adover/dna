<style>
<% loop $getPalatte() %>
	.theme-background--{$Title.Lowercase} {
		background-color: $Color;
		<% if $Top.Brand.getContrast($Color) == 'light' %>color: #000;<% else %>color: #fff;<% end_if %>
	}

	.theme-text--{$Title.Lowercase} {
		color: $Color;
	}
<% end_loop %>
</style>