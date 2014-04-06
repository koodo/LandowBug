<table width='98%' align='center'>
  <tr class='header'>
    <td>
      <?php echo html::a(common::getSysURL() . helper::createLink('team', 'view', 'teamid=' . $team->tid), $team->tname); ?>
    </td>
  </tr>
  <tr>
      <td>
          账号：<?php echo $uname;?>
          密码：<?php echo $password;?>
      </td>
  </tr>
</table>