<?php

function kopokopo_subscriptions_list() {
    ?>
    <link type="text/css" href="<?php echo WP_PLUGIN_URL; ?>/kopokopo/css/style.css" rel="stylesheet" />
    <div class="wrap">
        <h2>Kopokopo Subscriptions</h2>
        <div class="tablenav top">
            <div class="alignleft actions">
                <a href="<?php echo admin_url('admin.php?page=kopokopo_transactions_list'); ?>">Kopokopo Transactions</a>
            </div>
            <br class="clear">
        </div>
        <?php
        global $wpdb;
        $table_name = $wpdb->prefix . "kopokopo_subscriptions";

        $rows = $wpdb->get_results("SELECT * from $table_name");
        ?>
        <table class='wp-list-table widefat fixed striped posts'>
            <tr>
                <th class="manage-column ss-list-width">First Name</th>
                <th class="manage-column ss-list-width">Last Name</th>
                <th class="manage-column ss-list-width">Start Date</th>
                <th class="manage-column ss-list-width">End Date</th>
            </tr>
            <?php foreach ($rows as $row) { ?>
                <tr>
                    <td class="manage-column ss-list-width"><?php echo $row->first_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->last_name; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->start_date; ?></td>
                    <td class="manage-column ss-list-width"><?php echo $row->end_date; ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <?php
}