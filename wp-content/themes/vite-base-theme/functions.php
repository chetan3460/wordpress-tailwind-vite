<?php


require_once __DIR__ . '/inc/core/init.php';







add_filter('wp_handle_upload', 'convert_image_to_webp_avif_on_upload');

function convert_image_to_webp_avif_on_upload($fileinfo)
{
    $filepath = $fileinfo['file'];
    $mime     = mime_content_type($filepath);

    if (!in_array($mime, ['image/jpeg', 'image/png'])) {
        return $fileinfo;
    }

    // Load source image
    $image = null;
    switch ($mime) {
        case 'image/jpeg':
            $image = @imagecreatefromjpeg($filepath);
            break;
        case 'image/png':
            $image = @imagecreatefrompng($filepath);
            break;
    }

    if (!$image) {
        error_log('Failed to load image: ' . $filepath);
        return $fileinfo;
    }

    $dir      = pathinfo($filepath, PATHINFO_DIRNAME);
    $filename = pathinfo($filepath, PATHINFO_FILENAME);

    // Create .webp
    if (function_exists('imagewebp')) {
        $webp_path = $dir . '/' . $filename . '.webp';
        imagewebp($image, $webp_path, 80);
    } else {
        error_log('imagewebp() not available');
    }

    // Create .avif (PHP 8.1+)
    if (function_exists('imageavif')) {
        $avif_path = $dir . '/' . $filename . '.avif';
        imageavif($image, $avif_path, 80);
    } else {
        error_log('imageavif() not available');
    }

    imagedestroy($image);

    return $fileinfo;
}

// Disable Gutenberg site-wide
add_filter('use_block_editor_for_post', '__return_false');
