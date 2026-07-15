<?php
$js = "
function surpriseMe(btn) {
    if(btn) {
        let oldHTML = btn.innerHTML;
        btn.innerHTML = '<i class=\"fas fa-spinner fa-spin mr-2\"></i> Picking...';
    }
    setTimeout(() => {
        window.location.href = 'shop.php?surprise=1';
    }, 600);
}
";
file_put_contents('js/interactive.js', $js, FILE_APPEND);
echo "JS Appended!";
?>
