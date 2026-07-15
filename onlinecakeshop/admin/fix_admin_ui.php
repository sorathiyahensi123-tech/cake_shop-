<?php
$files = glob('*.php');
$cssLink = "    <link rel=\"stylesheet\" href=\"css/admin-custom.css\">\n    <link href=\"https://unpkg.com/aos@2.3.1/dist/aos.css\" rel=\"stylesheet\">\n</head>";
$aosScript = "    <script src=\"https://unpkg.com/aos@2.3.1/dist/aos.js\"></script>\n    <script>AOS.init({duration: 800, once: true});</script>\n</body>";

foreach ($files as $file) {
    // Skip specific files
    if (in_array($file, ['fix_admin_ui.php', 'dashboard.php', 'index.php', 'login_check.php', 'logout.php', 'admin_signup.php', 'insert_admin.php', 'update_admin.php'])) {
        continue;
    }
    
    $content = file_get_contents($file);
    
    // Inject CSS
    if (strpos($content, 'admin-custom.css') === false) {
        $content = preg_replace('/<\/head>/i', $cssLink, $content);
    }
    
    // Inject AOS script
    if (strpos($content, 'aos.js') === false) {
        $content = preg_replace('/<\/body>/i', $aosScript, $content);
    }
    
    // Add "Reports" link to sidebar to match dashboard logic
    if (strpos($content, 'reports.php') === false && strpos($content, '<!-- wrapper  -->') !== false) {
        $reportsLink = "                            <li class=\"nav-item\">\n                                <a class=\"nav-link\" href=\"reports.php\"><i class=\"fas fa-chart-line\"></i>Reports <span class=\"badge badge-warning ml-2\">New</span></a>\n                            </li>\n                        </ul>\n                    </div>";
        $content = preg_replace('/<\/ul>\s*<\/div>/i', ltrim($reportsLink), $content);
    }
    
    // Add table-premium class to table overrides if any
    $content = str_replace('<div class="card">', '<div class="card table-premium">', $content);
    
    file_put_contents($file, $content);
    echo "Updated $file\n";
}
echo "Done.\n";
?>
