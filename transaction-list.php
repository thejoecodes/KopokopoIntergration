<?php

function kopokopo_transactions_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/kopokopo/css/style.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Kopokopo Transactions</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=kopokopo_subscriptions_list'); ?>">Kopokopo Subscriptions</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "kopokopo_transactions";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">First Name</th>
                <th class="manage-column ss-list-width">Last Name</th>
                <th class="manage-column ss-list-width">Phone Number</th>
                <th class="manage-column ss-list-width">Reference ID</th>
                <th class="manage-column ss-list-width">Amount</th>
                <th class="manage-column ss-list-width">Transaction date</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->first_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->last_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->sender_phone; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->transaction_reference; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->amount; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->transaction_timestamp; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}