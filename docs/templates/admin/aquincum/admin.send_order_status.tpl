<style type="text/css">
div#main_row
{ldelim}
  padding: 15px;
  border: 2px solid #89B9DC;
  width: 500px;
{rdelim}

div#art_row
{ldelim}
  padding-bottom: 10px;
{rdelim}

div#button_row
{ldelim}
  padding-top: 10px;
{rdelim}

table.error
{ldelim}
  border: 1px solid red;
  padding: 0;
  margin: 10px 0 20px 0;
  border-collapse:collapse;
  border-spacing:0px;
{rdelim}

table.error td.head
{ldelim}
  background: red;
  color: #FFF;
{rdelim}

table.error td.main
{ldelim}
  color: red;
{rdelim}
</style>

<center>
<div id="main_row">
  <div id="art_row">{$lang.admin.youCanSendStatusLetter}</div>
  {include file="admin.errors.tpl"}
  <div id="form_row">
    <form method="post" action="" name="sendstatus">
    <input type="hidden" name="task" value="send">
    <table>
      <tr>
        <td>{$lang.admin.statusLetter}</td>
        <td>{html_options name=letter_id options=$lettersArray}</td>
      </tr>
    </table>
    </form>
  </div>
  <div id="button_row"><input type="submit" class="button" value="{$lang.admin.sendButton}" onclick="document.forms['sendstatus'].submit();" /></div>
</div>
</center>