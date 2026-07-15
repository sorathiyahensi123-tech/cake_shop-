<?php
$files = glob('*.php');
foreach($files as $file) {
    if($file == 'apply_styles.php') continue;
    $content = file_get_contents($file);
    
    // Attempt to update admin-custom.css linkage to bust cache
    $content = preg_replace('/href="css\/admin-custom\.css(\?v=\d+)?"/', 'href="css/admin-custom.css?v='.time().'"', $content);
    
    // Let's also enforce head inline style just in case! 
    // Wait, the cache buster is clean enough.
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}
echo "Global style cache buster applied.";
