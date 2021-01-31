{*<form method="post" name="cart" id="cartfrm" action="{$BaseURL}cart{$Config.webPageFileType}">
    <input type="hidden" name="task" value="addtocart" />
    <input type="hidden" name="time" value="{$smarty.now}" />
    <input type="hidden" name="number" value="" />
    <input type="hidden" name="price" value="" />
</form>
<script language="javascript">
function addtocart(productId, productPrice)
{ldelim}
    $(cartfrm.number).val(productId);
    $(cartfrm.price).val(productPrice);
    $(cartfrm).submit();
{rdelim}
</script>*}
<section id="landing-registration">
    <div id="registration-block">
        <div class="registration-block-text">{$lang.site.lookAdvantageBonusPlus}</div>
        <div class="registration-block-form">
            <form>
                <div class="reg-field">
                    <input type="text" />
                </div>
                <div class="reg-field">
                    <input type="text" />
                </div>
                <div class="reg-button">
                    <a href="#" class="regi-button">{$lang.user.registration}</a>
                </div>
                <div class="clear"></div>
            </form>
        </div>
    </div>
</section>