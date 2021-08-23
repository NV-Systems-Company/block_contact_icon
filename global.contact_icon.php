<?php

/**
 * @Project NUKEVIET 4.x
 * @Author VINADES.,JSC <contact@vinades.vn>
 * @Copyright (C) 2014 VINADES.,JSC. All rights reserved
 * @License GNU/GPL version 2 or any later version
 * @Createdate Sun, 04 May 2014 12:41:32 GMT
 */

if (!defined('NV_MAINFILE')) {
    die('Stop!!!');
}

if (!nv_function_exists('nv_contact_icon')) {
    /**
     * nv_contact_icon_config()
     *
     * @param mixed $module
     * @param mixed $data_block
     * @param mixed $lang_block
     * @return
     */
    function nv_contact_icon_config($module, $data_block, $lang_block)
    {
        $html = '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">' . $lang_block['maps'] . ':</label>';
        $html .= '  <div class="col-sm-18"><input type="text" name="config_maps" class="form-control" value="' . $data_block['maps'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">' . $lang_block['phone'] . ':</label>';
        $html .= '  <div class="col-sm-18"><input type="text" name="config_phone" class="form-control" value="' . $data_block['phone'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">' . $lang_block['messenger'] . ':</label>';
        $html .= '  <div class="col-sm-18"><input type="text" name="config_messenger" class="form-control" value="' . $data_block['messenger'] . '"/></div>';
        $html .= '</div>';
        $html .= '<div class="form-group">';
        $html .= '  <label class="control-label col-sm-6">' . $lang_block['zalo'] . ':</label>';
        $html .= '  <div class="col-sm-18"><input type="text" name="config_zalo" class="form-control" value="' . $data_block['zalo'] . '"/></div>';
        $html .= '</div>';
        return $html;
    }

    /**
     * nv_contact_icon_submit()
     *
     * @param mixed $module
     * @param mixed $lang_block
     * @return
     */
    function nv_contact_icon_submit($module, $lang_block)
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config']['maps'] = $nv_Request->get_title('config_maps', 'post');
        $return['config']['phone'] = $nv_Request->get_title('config_phone', 'post');
        $return['config']['messenger'] = $nv_Request->get_title('config_messenger', 'post');
        $return['config']['zalo'] = $nv_Request->get_title('config_zalo', 'post');
        return $return;
    }

    /**
     * nv_contact_icon()
     *
     * @param mixed $block_config
     * @return
     */
    function nv_contact_icon($block_config)
    {
        global $global_config, $site_mods, $lang_global;

        if (file_exists(NV_ROOTDIR . '/themes/' . $global_config['module_theme'] . '/blocks/global.contact_icon.tpl')) {
            $block_theme = $global_config['module_theme'];
        } elseif (file_exists(NV_ROOTDIR . '/themes/' . $global_config['site_theme'] . '/blocks/global.contact_icon.tpl')) {
            $block_theme = $global_config['site_theme'];
        } else {
            $block_theme = 'default';
        }

        $xtpl = new XTemplate('global.contact_icon.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks');
        $xtpl->assign('NV_BASE_SITEURL', NV_BASE_SITEURL);
        $xtpl->assign('LANG', $lang_global);
        $xtpl->assign('BLOCK_THEME', $block_theme);
        $xtpl->assign('DATA', $block_config);
        
        if (!empty($block_config['maps'])) {
            $xtpl->parse('main.maps');
        }
        if (!empty($block_config['phone'])) {
            $xtpl->parse('main.phone');
        }
        if (!empty($block_config['messenger'])) {
            $xtpl->parse('main.messenger');
        }
        if (!empty($block_config['zalo'])) {
            $xtpl->parse('main.zalo');
        }
        $xtpl->parse('main');
        return $xtpl->text('main');
    }
}

if (defined('NV_SYSTEM')) {
    $content = nv_contact_icon($block_config);
}
