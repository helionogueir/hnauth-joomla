<?php defined('_JEXEC') or die('Restricted Access'); ?>
<form action="index.php?option=com_hnauth&view=credentials" method="post" id="adminForm" name="adminForm">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="2%"><?php echo JText::_('COM_HNAUTH_CREDENTIAL_ID'); ?></th>
                <th width="2%"><?php echo JHtml::_('grid.checkall'); ?></th>
                <th width="5%"><?php echo JText::_('COM_HNAUTH_CREDENTIAL_TEMPLATE'); ?></th>
                <th><?php echo JText::_('COM_HNAUTH_CREDENTIAL_AUTHNAME'); ?></th>
                <th><?php echo JText::_('COM_HNAUTH_CREDENTIAL_TITLE'); ?></th>
                <th><?php echo JText::_('COM_HNAUTH_CREDENTIAL_URI'); ?></th>
                <th><?php echo JText::_('COM_HNAUTH_CREDENTIAL_PUBLICKEY'); ?></th>
                <th><?php echo JText::_('COM_HNAUTH_CREDENTIAL_TTL'); ?></th>
                <th><?php echo JText::_('COM_HNAUTH_CREDENTIAL_ALGORITHM'); ?></th>
                <th width="5%"><?php echo JText::_('COM_HNAUTH_CREDENTIAL_PUBLISHED'); ?></th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php
                foreach ($this->items as $i => $row) :
                    $link = JRoute::_('index.php?option=com_hnauth&task=credential.edit&id=' . $row->id);
                ?>
                    <tr>
                        <td><?php echo $this->pagination->getRowOffset($i); ?></td>
                        <td><?php echo JHtml::_('grid.id', $i, $row->id); ?></td>
                        <td><a href="<?php echo $link; ?>"><?php echo $row->template; ?></a></td>
                        <td><a href="<?php echo $link; ?>"><?php echo $row->authname; ?></a></td>
                        <td><a href="<?php echo $link; ?>"><?php echo $row->title; ?></a></td>
                        <td><a href="<?php echo $row->uri; ?>" target="_blank"><?php echo $row->uri; ?></a></td>
                        <td><?php echo $row->publickey; ?></td>
                        <td><?php echo $row->ttl; ?></td>
                        <td><?php echo $row->algorithm; ?></td>
                        <td style="align:center;"><?php echo JHtml::_('jgrid.published', $row->published, $i, 'credentials.', true, 'cb'); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>

        <tfoot>
            <tr>
                <td colspan="6"><?php echo $this->pagination->getListFooter(); ?></td>
            </tr>
        </tfoot>
    </table>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
