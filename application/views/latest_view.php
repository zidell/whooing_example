<?php foreach ($entries as $key => $row): ?>
    <tr>
        <td>
            <?php echo substr($row['entry_date'], 0, 4).'-'.substr($row['entry_date'], 4, 2).'-'.substr($row['entry_date'], 6, 2); ?>
        </td>
        <td>
            <?php echo $row['item']; ?>
        </td>
        <td>
            <?php echo number_format($row['money']); ?>
        </td>
        <td>
            <span class="label label-default"><?php echo $accounts[$row['l_account']][$row['l_account_id']]['title']; ?></span>
        </td>
        <td>
            <span class="label label-default"><?php echo $accounts[$row['r_account']][$row['r_account_id']]['title']; ?></span>
        </td>
    </tr>
<?php endforeach ?>