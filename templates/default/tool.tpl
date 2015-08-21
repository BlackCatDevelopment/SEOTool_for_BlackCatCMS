        <div class="ui-corner-top" id="fc_set_form_content">
            {if $page && $page.page_id}
            <h2>{translate('SEO Settings for page')} "{$page.menu_title}", ID {$page.page_id}</h2>
            {/if}
            <div style="float:right;margin-top:15px;margin-right:15px;">
                <form method="get" action="{$CAT_ADMIN_URL}/admintools/tool.php">
                    {if $page && $page.page_id}{translate('Change page')}{/if}
                    <input type="hidden" name="tool" id="tool" value="seotool" />
                    {$page_select}
                    <input type="submit" name="changepage" id="changepage" value="{translate('Load settings')}" />
                </form>

                <h2>{translate('Helpful links')}</h2>
                <ul>
                    <li><a href="https://de.onpage.org/wiki/Canonical_Tag" target="_blank">https://de.onpage.org/wiki/Canonical_Tag</a> (DE)</li>
                    <li><a href="https://de.onpage.org/wiki/HTTP_Status_Code#Status_Code_301" target="_blank">https://de.onpage.org/wiki/HTTP_Status_Code#Status_Code_301</a> (DE)</li>
                    <li><a href="https://de.onpage.org/wiki/Noindex" target="_blank">https://de.onpage.org/wiki/Noindex</a> (DE)</li>
                    <li><a href="https://de.onpage.org/wiki/Nofollow" target="_blank">https://de.onpage.org/wiki/Nofollow</a> (DE)</li>
                    <li><a href="https://www.google.com/webmasters/tools/home" target="_blank">Google Search Console</a></li>
                </ul>

                {if $check}<br />
                {translate('Please check the following issues')}:
                <ul>
                {foreach $check message}
                    <li> {$message}</li>
                {/foreach}
                </ul>{/if}
            </div>
            {if $details_form}{$details_form}{/if}
        </div>
    </div>