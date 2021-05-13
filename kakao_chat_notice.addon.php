<?php

// *****************************
// * 카카오톡 알림 애드온
// * 제작자: Waterticket(admin@hoto.dev)
// * 문의: https://shop.hoto.dev
// *****************************


if(!defined('__XE__')) exit();


if($called_position == 'before_display_content' && Context::getResponseMethod() == 'HTML' && Context::get('module') != "admin" && !isCrawler()){
    $addon_info->image_url ? $addon_info->image_url : $addon_info->image_url = '/addons/kakao_chat_notice/kakao.png';
    $addon_info->target_url ? $addon_info->target_url : $addon_info->target_url = '/';
    $addon_info->up_effect ? $addon_info->up_effect : $addon_info->up_effect = 'Y';
    $addon_info->img_size_px ? $addon_info->img_size_px : $addon_info->img_size_px = 70;
    $addon_info->notice_memo ? $addon_info->notice_memo : $addon_info->notice_memo = '';
    $addon_info->top_pos ? $addon_info->top_pos : $addon_info->top_pos = 40;

    $style_tag = '#__kakaotalk_chat img{width:'.$addon_info->img_size_px.'px}#__kakaotalk_memo{position:relative;bottom:20px;border:1px solid gray;background-color:#f0f0f0;padding:8px;text-align:center;border-radius:5px;font-size:0.7em;}'.(($addon_info->up_effect == 'Y')?
    '#__kakaotalk_chat{position:fixed;bottom:-100px;right:20px;z-index:9999;opacity:0;transition:all 500ms;}#__kakaotalk_chat.on{bottom:'.$addon_info->top_pos.'px;opacity:1;transition:all 500ms;}':
    '#__kakaotalk_chat{position:fixed;bottom:'.$addon_info->top_pos.'px;right:20px;z-index:9999;opacity:1;}');

    $kakao_html = '<script>$(document).ready(function(){$("#__kakaotalk_chat").addClass("on");});</script><div id="__kakaotalk_chat">'.((!empty($addon_info->notice_memo))?'<div id="__kakaotalk_memo">'.$addon_info->notice_memo.'</div>':'').'<a href="'.$addon_info->target_url.'" target="_blank"><img src="'.$addon_info->image_url.'" title="KAKAOTALK 이동" /></a></div>';
    $kakao_html .= sprintf('<style>%s</style>', $style_tag);
    $output = $output.$kakao_html;
}