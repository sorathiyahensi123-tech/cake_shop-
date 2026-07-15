<?php
require_once('config.php');

$categories = [
    ['Engagement', 'engagement.jpg'],
    ['Bento Cake', 'bento_cake.jpg'],
    ['Baby Shower', 'baby_shower.jpg'],
    ['Sport', 'sport.jpg'],
    ['Festival', 'festival.jpg'],
    ['Tagged', 'tagged.jpg'],
    ['Reward', 'reward.jpg'],
    ['Anniversary', 'anniversary.jpg'],
    ['Travelling', 'travelling.jpg']
];

foreach ($categories as $cat) {
    $name = $cat[0];
    $image = $cat[1];
    
    // Check if category already exists
    $check = "SELECT * FROM cake_shop_category WHERE category_name = '$name'";
    $result = mysqli_query($conn, $check);
    
    if (mysqli_num_rows($result) == 0) {
        $insert = "INSERT INTO cake_shop_category (category_name, category_image) VALUES ('$name', '$image')";
        if (mysqli_query($conn, $insert)) {
            echo "Added category: $name\n";
        } else {
            echo "Error adding $name: " . mysqli_error($conn) . "\n";
        }
    } else {
        echo "Category $name already exists.\n";
    }
}
?>
