{extends file='news/index.tpl'}

{block name=pageTitle}
    <div class="page-title">
        <h1>{$news.title}</h1>
    </div>
{/block}
{block name=content}
    {$news.content}
{/block}