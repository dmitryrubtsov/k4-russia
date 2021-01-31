<header id="header">
    <div class="head-content">
        <div class="head-table">
            <div class="head-column-text">
                {foreach from=$HeadText item=curr name="advantage"}
                        <p class="text">
                            {$curr.text}
                        </p>
                {/foreach}
            </div>
            <div class="head-column-contacts">
                {if $Config.headerPhone}
                    <p class="phone"><span>{if $Config.headerPhoneCode}{$Config.headerPhoneCode}{/if}</span>{$Config.headerPhone}</p>
                {/if}
                {if $Config.adress}
                    <p class="where"><a href="#">{$Config.adress}</a></p>
                {/if}
            </div>
        </div>
        <nav id="top-nav">
            <ul>
                <li class="active"><a href="{$HOST}articles--o-kompanii-15.html">о компании</a></li>
                <li><a href="{$HOST}articles--uslugi-16.html">услуги</a></li>
                <li><a href="{$HOST}projects.html">наши проекты</a></li>
                <li><a href="{$HOST}articles--informacija-sro-18.html">информация сро</a></li>
                <li><a href="{$HOST}contacts.html">контакты</a></li>
                <div class="clearfix"></div>
            </ul>
        </nav>
    </div>
    <div class="logo">
        <a href="{$HOST}"></a>
    </div>
</header>