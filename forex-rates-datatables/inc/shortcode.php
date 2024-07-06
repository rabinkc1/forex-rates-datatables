<?php 
// Shortcode to display forex rates using DataTables
function forex_rates_shortcode($atts) {
    $atts = shortcode_atts(array(
        'from' => date('Y-m-d', strtotime('-1 month')),
        'to' => date('Y-m-d'),
        'per_page' => 10,
    ), $atts);

    $from = sanitize_text_field($atts['from']);
    $to = sanitize_text_field($atts['to']);
    $per_page = intval($atts['per_page']);

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $rates = fetch_forex_rates($from, $to, $page, $per_page);

    ob_start();
    ?>
    <table id="forex-rates-table" class="display">
        <thead>
            <tr>
                <th>Date</th>
                <th>Currency</th>
                <th>Unit</th>
                <th>Buy</th>
                <th>Sell</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rates as $rate) : ?>
                <?php foreach ($rate['rates'] as $currency) : ?>
                    <tr>
                        <td><?php echo esc_html($rate['date']); ?></td>
                        <td><?php echo esc_html($currency['currency']['name']) . ' (' . esc_html($currency['currency']['ISO3']) . ')'; ?></td>
                        <td><?php echo esc_html($currency['unit']); ?></td>
                        <td><?php echo esc_html($currency['buy']); ?></td>
                        <td><?php echo esc_html($currency['sell']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        jQuery(document).ready(function($) {
            $('#forex-rates-table').DataTable({
                "paging": true,
                "lengthChange": true,
                "pageLength": <?php echo $per_page; ?>,
                "searching": true,
                "info": true,
                "ordering": true,
                "responsive": true,
                "language": {
                    "paginate": {
                        "previous": "&laquo;",
                        "next": "&raquo;"
                    }
                }
            });
        });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('forex_rates', 'forex_rates_shortcode');
