{strip}<!DOCTYPE html>
<html lang="de">
{include file="default/pages/head.tpl"}
<body>
{block name="includeHeader"}
    {include file="default/pages/header.tpl"}
{/block}
<section>
    
    {$blocks|var_dump}

</section>
{block name="includeFooter"}
    {include file="default/pages/footer.tpl"}
{/block}
</body>
</html>
{/strip}