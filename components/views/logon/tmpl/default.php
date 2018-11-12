<?php defined('_JEXEC') or die('Restricted Access'); ?>
<br>
<div class="well">
    <form class ="form" id="form-hnauth-logon" name="form-hnauth-logon" method="post" action="#self" onsubmit="return false;">
        <div class="form-group">
            <label for="username"><?php echo JText::_('COM_HNAUTH_LOGON_USERNAME'); ?></label>
            <input type="text" class="form-control" id="username" id="username">
        </div>
        <div class="form-group">
            <label for="password"><?php echo JText::_('COM_HNAUTH_LOGON_PASSWORD'); ?></label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="button" class="btn btn-default"><?php echo JText::_('COM_HNAUTH_LOGON_SIGNIN'); ?></button>
    </form>
</div>