<% with $Context %>

	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@dna_nz">

    <meta property="og:type" content="article" />
    <meta property="og:title" content="$Title | $SiteConfig.Title" />
	<meta name="twitter:title" content="$Title">

    <% if $Intro %>
        <meta property="og:description" content="$Intro.LimitCharacters(100)" />
		<meta name="twitter:description" content="$Intro.LimitCharacters(100)">
    <% else %>
        <meta property="og:description" content="$Content.LimitCharacters(100)" />
		<meta name="twitter:description" content="$Content.LimitCharacters(100)">
    <% end_if %>

    <% if $SharingImage && $SharingImage.exists %>
        <meta property="og:image" content="$SharingImage.AbsoluteURL" />
		<meta name="twitter:image" content="$SharingImage.AbsoluteURL">
    <% else_if $Level(1).SharingImage  && $Level(1).SharingImage.exists %>
        <meta property="og:image" content="$Level(1).SharingImage.AbsoluteURL" />
		<meta name="twitter:image" content="$Level(1).SharingImage.AbsoluteURL">
    <% else %>
		<meta property="og:image" content="$Brand.SharingImage.AbsoluteURL">
		<meta name="twitter:image" content="$Brand.SharingImage.AbsoluteURL">
    <% end_if %>
<% end_with %>
