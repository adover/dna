<% with $SiteConfig %>
    <footer class="footer" role="contentinfo">
        <div class="container">
            <h2 class="sr-only">Footer</h2>
                <% if $FooterLinks %>
                    <div class="footer-nav">
                        <ul class="list list--unstyled">
                            <% loop $FooterLinks %>
                                <li><a href="$Link.Link()">{$Title.XML}.</a></li>
                             <% end_loop %>
                        </ul>
                    </div>
                <% end_if %>
                    <div class="columns">
                        <div class="column">
                            <% include FooterSignup %>
                        </div>
                        <div class="column">
                            <% if $SocialLinks %>
                                <div class="footer-social" role="complementary">
                                  <ul class="list list--unstyled">
                                      <% loop $SocialLinks %>
                                          <li>
                                              <a href="$URL" class="footer-social-link" target="_blank">
                                                  <span class="sr-only">$Title</span>
                                                  <% if $Icon %>
                                                      $SVG($Top.getFileName($Icon.ID)).customBasePath($Top.getFileDir($Icon.ID)).size(50, 50).fill('#fff')
                                                  <% end_if %>
                                              </a>
                                          </li>
                                      <% end_loop %>
                                  </ul>
                                </div>
                            <% end_if %>
                        </div>
                    </div>
                    <div class="footer-copyright">
                        <% if $TermsPrivacyPolicy %>
                            <a href="$TermsPrivacyPolicy.Link()">Terms and Privacy</a>
                            <span class="footer-pipe">&nbsp;|&nbsp;</span>
                        <% end_if %>
                        <% if $Copyright %>
                            <span class="footer-copyrighttext">$Copyright</span>
                        <% else %>
                            <span class="footer-copyrighttext">DNA Design 2017.</span>
                        <% end_if %>
                    </div>
                </div>
            </div>
        </div>
    </footer>
<% end_with %>
