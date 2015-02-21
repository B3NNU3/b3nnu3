{if !isset($level) }{assign var="level" value="menu"}{/if}
<nav>
    <strong class="title">Kategorien</strong>
    <ul class="{$level} fa-ul">
        <li>
            <a href="/news/category/e-commerce"><i class="fa-li fa fa-cart-plus"></i>E-Commerce</a>
        </li>
        <li>
            <a href="/news/category/privat"><i class="fa-li fa fa-user"></i>Privates</a>
        </li>
        <li>
            <a href="/news/category/webdeveloper"><i class="fa-li fa fa-code"></i>Webdeveloper</a>
        </li>
        <li>
            <a href="/news/category/zeug"><i class="fa-li fa fa-rebel"></i>Zeug</a>
        </li>
    </ul>
</nav>