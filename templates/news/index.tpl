{extends file='index/index.tpl'}

{block name=slides}{/block}

{block name=mainContent}
    <div class="content two-column clearfix">
        <article class="left">
            {block name=pageTitle}
                <div class="page-title">
                    <h1>{$title}</h1>
                </div>
            {/block}
            {block name=content}
                {if is_array($news)}
                    {foreach from=$news item=item}
                        {assign var="readmore" value="<a href=\"/news/{$item.url_key}/\">[weiterlesen]</a>"}
                        <article id="article_{$item.id}">
                            <div class="news-title">
                                <h2><a href="/news/{$item.url_key}" title="{$item.title}">{$item.title}</a></h2>
                            </div>
                            {$item.content|truncate:350:" ... "|cat:$readmore}
                        </article>
                    {/foreach}
                {else}
                    Keine Passenden Artikel gefunden!
                {/if}
            {/block}
        </article>
        {block name="aside_right"}
            <aside class="right">
                <div class="widget">
                    {include file="news/categories.tpl"}
                </div>
            </aside>
        {/block}
    </div>
{/block}

