{strip}<!DOCTYPE html>
<html lang="de">
{include file="index/head.tpl"}
<body>
{block name=includeHeader}
    {include file="index/header.tpl"}
{/block}
{block name=body}
    <div id="body">
        {block name=mainCol}
            <div id="main">
                {block name=slides}
                    <ul class="rslides">
                        <li><img src="/media/images/schwerin_dom_am_see.png/" alt="Scherin - Blick auf den Dom"></li>
                        <li><img src="/media/images/3d_grins.jpg/" alt="Grins die Wand an!"></li>
                        <li><img src="/media/images/wallpaper.jpg/" alt="Mix it up"></li>
                    </ul>
                {/block}
                {block name=mainContent}
                    <div class="page-title">
                        <h1>{$title}</h1>
                    </div>
                    <div class="content">
                        <article>
                            {block name=Content}
                                {$content|strip}
                            {/block}
                            {block name=extendedContent}{/block}
                        </article>
                    </div>
                {/block}
            </div>
        {/block}
    </div>
{/block}
{block name=includeFooter}
    {include file="index/footer.tpl"}
{/block}
{block name=before_body_ends}{/block}
</body>
</html>
{/strip}