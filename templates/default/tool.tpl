        <div class="ui-corner-top" id="fc_set_form_content">
            {if $page && $page.page_id}
            <h2>{translate('SEO Settings for page')} "{$page.menu_title}", ID {$page.page_id}</h2>
            {/if}
            <div style="float:right;margin-top:15px;margin-right:15px;">
                <h2>{translate('Helpful links')}</h2>
                <ul>
                    <li><a href="https://de.onpage.org/wiki/Canonical_Tag" target="_blank">https://de.onpage.org/wiki/Canonical_Tag</a> (DE)</li>
                    <li><a href="https://de.onpage.org/wiki/HTTP_Status_Code#Status_Code_301" target="_blank">https://de.onpage.org/wiki/HTTP_Status_Code#Status_Code_301</a> (DE)</li>
                    <li><a href="https://de.onpage.org/wiki/Noindex" target="_blank">https://de.onpage.org/wiki/Noindex</a> (DE)</li>
                    <li><a href="https://de.onpage.org/wiki/Nofollow" target="_blank">https://de.onpage.org/wiki/Nofollow</a> (DE)</li>
                    <li><a href="https://www.google.com/webmasters/tools/home" target="_blank">Google Search Console</a></li>
                </ul>

                {if $check}<br />
                <div id="seotool_check">
                    {translate('Please check the following issues')}:
                    <ul>
                    {foreach $check message}
                        <li> {$message}</li>
                    {/foreach}
                    </ul>
                </div><br /><br />{/if}

                <button class="submit" id="edit_robots">{translate('Edit robots.txt')}</button><br />
                <button class="submit" id="edit_htaccess">{translate('Edit .htaccess')}</button><br />
                <button class="submit" id="update_sitemap">{translate('Update sitemap.xml')}</button><br /><br />

                <img src="{$CAT_URL}/modules/seotool/search-engine-optimization.jpg" alt="Picture by pixabay.com" /><br /><br />

                <span style="font-size:10px">Images by <a href="http://pixabay.com">Pixabay.com</a><br />
                <a href="https://pixabay.com/de/suchmaschinenoptimierung-seo-google-715759/">search-engine-optimization.jpg by "geralt"</a><br />
                <a href="https://pixabay.com/de/seo-google-suche-motor-optimierung-896174/">icon.png by "Tumisu"</a>
                </span>

            </div>

            <form method="get" action="{$CAT_ADMIN_URL}/admintools/tool.php" style="float:left;margin-right:15px;">
                {if $page && $page.page_id}{translate('Change page')}{/if}
                <input type="hidden" name="tool" id="tool" value="seotool" />
                {$page_select}
                <input type="submit" name="changepage" id="changepage" value="{translate('Load settings')}" />
            </form>
            <br style="clear:left;" /><br />

            <div id="seotool_inner">
            {if $details_form}{$details_form}{/if}
            </div>
        </div>
    </div>