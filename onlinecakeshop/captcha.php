<?php
session_start();

// Generate random captcha code
$chars = '0123456789';
$captcha_code = substr(str_shuffle($chars), 0, 6);

// Set captcha code in session
$_SESSION['captcha_code'] = $captcha_code;

// Start SVG output
header("Content-type: image/svg+xml");
echo '<?xml version="1.0" encoding="utf-8"?>';
?>
<svg xmlns="http://www.w3.org/2000/svg" width="120" height="40">
    <rect width="120" height="40" fill="#f4f4f4" stroke="#ccc" stroke-width="1" />
    <?php
    // Draw random lines to obscure the text
    for($i=0; $i<8; $i++) {
        $x1 = rand(0, 120);
        $y1 = rand(0, 40);
        $x2 = rand(0, 120);
        $y2 = rand(0, 40);
        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        echo '<line x1="'.$x1.'" y1="'.$y1.'" x2="'.$x2.'" y2="'.$y2.'" stroke="'.$color.'" stroke-width="'.rand(1,2).'" />';
    }
    
    // Draw random circles
    for($i=0; $i<20; $i++) {
        $cx = rand(0, 120);
        $cy = rand(0, 40);
        $r = rand(1, 3);
        $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        echo '<circle cx="'.$cx.'" cy="'.$cy.'" r="'.$r.'" fill="'.$color.'" opacity="0.5" />';
    }

    // Draw the captcha text with random rotations
    for ($i = 0; $i < 6; $i++) {
        $x = 12 + ($i * 16);
        $y = rand(22, 30);
        $rotate = rand(-25, 25);
        echo '<text x="'.$x.'" y="'.$y.'" font-family="monospace, Arial" font-size="22" font-weight="bold" fill="#333333" transform="rotate('.$rotate.' '.$x.','.$y.')">'.$captcha_code[$i].'</text>';
    }
    ?>
</svg>
