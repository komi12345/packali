<?php

$adminViewsDir = 'resources/views/admin';
$files = [
    'analytics/index.blade.php',
    'clients/index.blade.php',
    'orders/create.blade.php',
    'orders/edit.blade.php',
    'orders/index.blade.php',
    'orders/show.blade.php',
    'packs/create.blade.php',
    'packs/edit.blade.php',
    'packs/show.blade.php',
    'promotions/create.blade.php',
    'promotions/edit.blade.php',
    'promotions/index.blade.php',
    'promotions/show.blade.php',
    'settings/edit_user.blade.php',
    'settings/index.blade.php'
];

foreach ($files as $file) {
    $filePath = $adminViewsDir . '/' . $file;
    
    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);
        
        // Replace the opening tag and header slot
        $content = preg_replace(
            '/<x-app-layout>\s*<x-slot name="header">\s*<h2[^>]*>(.*?)<\/h2>\s*<\/x-slot>/s',
            '<x-admin-layout>' . "\n" . '    <div class="mb-6">' . "\n" . '        <h2 class="font-semibold text-xl text-gray-800 leading-tight">$1</h2>' . "\n" . '    </div>',
            $content
        );
        
        // Replace the closing tag
        $content = str_replace('</x-app-layout>', '</x-admin-layout>', $content);
        
        // Remove the py-12 wrapper and adjust structure
        $content = preg_replace(
            '/<div class="py-12">\s*<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">/s',
            '<div class="max-w-7xl mx-auto">',
            $content
        );
        
        // Remove extra closing divs
        $content = preg_replace('/\s*<\/div>\s*<\/div>\s*<\/x-admin-layout>/', "\n" . '    </div>' . "\n" . '</x-admin-layout>', $content);
        
        file_put_contents($filePath, $content);
        echo "Updated: $file\n";
    }
}

echo "All admin views updated successfully!\n";
?>
