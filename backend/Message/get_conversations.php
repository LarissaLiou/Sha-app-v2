<?php
require_once __dir__."/../Defaults/connect.inc.php";
require_once __dir__."/../Defaults/utils.inc.php";
require_once __dir__."/../Defaults/validate.inc.php";

if (!verify_login($mysqli)){
    onError($mysqli,"Unauthorized");
}
$userId = $_SESSION['userid'];
$sql = "SELECT
  c.conversation_id as conversation_id,
  u.username as username,
    ud.profile_picture as profile_picture,
    m.sent_at as last_message_date,
    m.content as last_message

FROM
  conversations c
JOIN
  users u ON u.user_id = CASE
                            WHEN c.user1_id = ? THEN c.user2_id
                            WHEN c.user2_id = ? THEN c.user1_id
                         END
JOIN
    user_details ud ON ud.user_id = u.user_id
LEFT JOIN
  (SELECT 
    content,
    MAX(sent_at) as sent_at,
    conversation_id
    FROM
    messages
    ) m ON m.conversation_id = c.conversation_id 
WHERE
  c.user1_id = ? OR c.user2_id = ?
";
$conversations = executeSelect($mysqli, $sql, "iiii", [$userId, $userId,$userId,$userId]);
onSuccess($mysqli, true,["conversations"=>$conversations['data']]);

