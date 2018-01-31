<section class="member-list">
    <ul class="memberlist-optionlist">
        <li class="memberlist-option current"><a href="">All</a></li>
        <li class="memberlist-option"><a href="">Auckland</a></li>
        <li class="memberlist-option"><a href="">Wellington</a></li>
        <li class="memberlist-option"><a href="">Bears</a></li>
        <li class="memberlist-option"><a href="">Dogs</a></li>
    </ul>
    <div class="member-list">

        <% loop $Members %>
            <div class="member"<% if $HasBeard %> data-hasBeard="true"<% end_if %><% if $IsDog %> data-isDog="true"<% end_if %> data-office="$Office">
                <a href="#" class="member-open">
                    <span class="sr-only">Expand to view full profile.</span>
                </a>
                <button class="member-close icon-close">
                    <span class="sr-only">Close</span>
                </button>
                Blog image is $BlogProfileImageID - therefore unsure why it doesn't show
                <% if $BlogProfileImage %>
                    <div class="member-image">
                        $BlogProfileImage.ScaleWidth(180)
                    </div>
                <% end_if %>
                <h3>$FirstName $Surname</h3>
                <p>$JobTitle</p>
                <div class="member-details">
                    <p>$BlogProfileSummary</p>
                    <p class="member-linkedin">
                        <a href="$LinkedinURL">$LinkedinURL</a>
                    </p>
                    <button class="member-close">Close</button>
                </div>
            </div>

        <% end_loop %>
    </div>
</section>
