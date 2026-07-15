<?php
$aos_css = '    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">'."\n";
$aos_js = '    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>'."\n".'    <script>AOS.init({duration: 800, once: true});</script>'."\n";

$files = glob("*.php");
foreach ($files as $f) {
    if ($f == 'add_aos.php') continue;
    
    $content = file_get_contents($f);
    if (strpos($content, '</head>') === false) {
        continue;
    }
    
    $orig_content = $content;
    
    if (strpos($content, 'aos.css') === false) {
        $content = str_replace('</head>', $aos_css . '</head>', $content);
    }
    
    if (strpos($content, 'aos.js') === false) {
        $content = str_replace('</body>', $aos_js . '</body>', $content);
    }

    // Regex to replace class="..."
    $content = preg_replace_callback('/class="([^"]*)"/', function($matches) {
        $classes = explode(' ', $matches[1]);
        $aos_attrs = [];
        $new_classes = [];
        
        foreach ($classes as $c) {
            if ($c == 'animate-fade-in-up' || $c == 'animate-slide-in-up') {
                $aos_attrs['data-aos'] = 'fade-up';
            } elseif ($c == 'animate-fade-in-left') {
                $aos_attrs['data-aos'] = 'fade-left';
            } elseif ($c == 'animate-fade-in-right') {
                $aos_attrs['data-aos'] = 'fade-right';
            } elseif ($c == 'animate-bounce-in') {
                $aos_attrs['data-aos'] = 'zoom-in';
            } elseif (strpos($c, 'animate-delay-') === 0) {
                $parts = explode('-', $c);
                $delay = intval(end($parts)) * 100;
                $aos_attrs['data-aos-delay'] = (string)$delay;
            } else {
                if (!empty($c)) {
                    $new_classes[] = $c;
                }
            }
        }
        
        $res = 'class="' . implode(' ', $new_classes) . '"';
        foreach ($aos_attrs as $k => $v) {
            $res .= " $k=\"$v\"";
        }
        return $res;
    }, $content);
    
    if ($content !== $orig_content) {
        file_put_contents($f, $content);
        echo "Updated $f\n";
    }
}
?>
