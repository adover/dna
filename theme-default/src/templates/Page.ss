<!doctype html>
<html class="no-js" lang="$ContentLocale">
<head>
    <% base_tag %>
    <title>$Title | $SiteConfig.Title</title>

    $MetaTags(false)
    <meta name="viewport" id="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=10.0,initial-scale=1.0" />

    <% include Adrexia/Brand/Favicons %>
    <% include MetaSharing Context=$Top %>
    <% require themedCSS('css/style') %>
</head>

<body data-spy="scroll" class="$ClassName">
    $BetterNavigator
    <% include SkipLinks %>
    <% include Header %>

    $Layout

    <% include Footer %>

    <% if SiteConfig.GACode %>
        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', '$SiteConfig.GACode']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
        </script>
    <% end_if %>

    <% require themedJavascript('js/script.min') %>

</body>
</html>
