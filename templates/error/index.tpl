{extends file='index/index.tpl'}

{block name=slides}{/block}

{block name=extendedContent}
    {if $error_message}
        <p><strong>{$error_message}</strong></p>
    {/if}
{/block}