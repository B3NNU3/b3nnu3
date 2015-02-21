{strip}
    <div id="header">
    <div class="inner clearfix">
        <div class="logo fa-spin-hover">
            <a tabindex="1" href="http://www.b3nnu3.de" title="zur Startseite"><img src="/media/images/smile.png/"
                                                                                    alt="smile"></a>
        </div>
        <nav>
            {block name=mainMenu}
                <ul class="menu fa-ul">
                    {block name=mainMenuItem}
                        <li tabindex="10"><a title="about" class="about" href="/about/"><i class="fa-li fa fa-gamepad"></i>about</a>
                            {block name=mainMenuSub}
                                <ul class="sub-menu fa-ul">
                                    {block name=mainMenuSubItem}
                                        <li><span>Profile</span></li>
                                        <li><a tabindex="20" title="Xing" rel="external" href="http://www.xing.com/profile/Benjamin_Schnoor"><i class="fa-li fa fa-xing"></i>Xing</a></li>
                                        <li><a tabindex="30" title="Facebook" rel="external" href="https://www.facebook.com/b3nnu3"><i class="fa-li fa fa-facebook"></i>Facebook</a></li>
                                        <li><a tabindex="40" title="google +" rel="external" href="https://google.com/+BennueSchnoor_b3nnu3"><i class="fa-li fa fa-google-plus"></i>google +</a></li>
                                    {/block}
                                </ul>
                            {/block}
                        </li>
                    {/block}
                </ul>
            {/block}
        </nav>
    </div>
    </div>
{/strip}