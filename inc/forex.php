<?php 
// Fetch forex rates from API
function fetch_forex_rates($from, $to, $page = 1, $per_page = 10) {
    $api_base_url = 'https://www.nrb.org.np/api/forex/v1/rates';
    $request_url = add_query_arg(array(
        'from' => $from,
        'to' => $to,
        'page' => $page,
        'per_page' => $per_page
    ), $api_base_url);

    $response = wp_remote_get($request_url);

    if (is_wp_error($response)) {
        return array();
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);

    if (isset($data['data']['payload']) && is_array($data['data']['payload'])) {
        return $data['data']['payload'];
    }

    return array();
}