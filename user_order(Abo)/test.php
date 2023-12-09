<?php
require_once("../connect_server.php");

$sql = "SELECT user_order.*, campaign.*,organizer.*, ticket.qr_code, user.user_name, event_category.event_name AS event_category_name
FROM user_order
JOIN campaign ON campaign.id = user_order.event_id
JOIN ticket ON ticket.id = user_order.ticket_number
JOIN user ON user.id = user_order.user_id
JOIN event_category ON event_category.id = campaign.event_type_id
JOIN organizer ON organizer.id = campaign.merchant_id";

$result = mysqli_query($conn, $sql);
$row = $result->fetch_all(MYSQLI_ASSOC);
?>
<pre>
    <?php print_r($row); ?>
    
</pre>

<!--     Array
(
    [id] => 120
    [ticket_number] => 6
    [user_id] => 8
    [event_id] => 120
    [valid] => 0
    [event_name] => 新北野柳地質公園門票
    [start_date] => 2023-09-28 11:00:00
    [end_date] => 2023-09-28 14:00:00
    [event_type_id] => 8
    [address] => 新北市萬里區港東路167-1號
    [merchant_id] => 93
    [images] => 7-20
    [event_price] => 2200
    [qr_code] => 2147483647
    [user_name] => kenny
    [event_category_name] => 景點門票
    [organizer_id] => 93
) -->

<!--     Array
(
    [id] => 47
    [ticket_number] => 22
    [user_id] => 43
    [event_id] => 47
    [valid] => 0
    [event_name] => 板橋新北耶誕城
    [start_date] => 2023-07-17 10:00:00
    [end_date] => 2023-07-17 13:00:00
    [event_type_id] => 3
    [address] => 新北市市民廣場、板橋車站站前廣場、萬坪公園、府中商圈
    [merchant_id] => 37
    [images] => 3-7
    [event_price] => 3750
    [qr_code] => 2147483647
    [user_name] => Jack
    [event_category_name] => 快閃期間限定活動
    [organizer_name] => 新北市政府
) -->