<?php
$option = $row->option;
$value = $row->value;
global $post;
// Get WordPress' media upload URL
$upload_link = esc_url( get_upload_iframe_src( 'image', $post->ID ) );
$currentImageExists = false;
$currentImageSrc = [];
$currentImageId = '';
if($value)
{
    $currentImageId = $value;
    $currentImageSrc = wp_get_attachment_image_src($currentImageId, 'thumbnail' );
    $currentImageExists = is_array($currentImageSrc);
}
$upload_id = str_replace('[', '-', $option);
$upload_id = str_replace(']', '', $upload_id);

$html = '<div class="image-file-input" id="' . $upload_id . '">';
$html .= '<div class="custom-img-container">';
if ( $currentImageExists) :
    $html .= '<img src="' . $currentImageSrc[0] . '" alt="" style="max-width:100%;" />';
endif;
$html .= '</div>';

$html .= '<p class="hide-if-no-js">';
$html .= '<a class="upload-custom-img"';
$html .= 'href="' . $upload_link . '">';
$html .=  'Set image';
$html .= '</a>';
$html .= '</p>';

$html .= '<input class="custom-img-id" name="' . $option  . '" type="hidden" value="' . $currentImageId . '" />';
$html .= '</div>';
echo $html;
