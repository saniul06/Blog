<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">
<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style.css">
<?php
$query = 'select theme from tbl_theme';
$result = $db->select($query);
$data = $result->fetch_assoc();
if ($data['theme'] == 'green') {
    echo '<link rel="stylesheet" href="theme/green.css">';
} elseif ($data['theme'] == 'default') {
    echo '<link rel="stylesheet" href="theme/default.css">';
}
