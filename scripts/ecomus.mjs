import {extractSnapshot} from './zip.mjs';import {cp,readFile,writeFile} from 'node:fs/promises';import path from 'node:path';import {root,phpJob} from './runtime.mjs';
const supplied='D:/per/wordpress/ecomus-240/Ecomus-Package';
await extractSnapshot(path.join(supplied,'ecomus.zip'),path.join(root,'wordpress/wp-content/themes'));
await extractSnapshot(path.join(supplied,'Plugins/ecomus-addons.zip'),path.join(root,'wordpress/wp-content/plugins'));
await cp(path.join(root,'theme'),path.join(root,'wordpress/wp-content/themes/nestora'),{recursive:true});
console.log((await phpJob(`<?php require '/wordpress/wp-load.php';wp_set_current_user(1);require_once ABSPATH.'wp-admin/includes/plugin.php';deactivate_plugins('foodu-core/foodu-core.php');$mods=get_option('theme_mods_nestora');switch_theme('nestora');update_option('template','ecomus');if(is_array($mods))update_option('theme_mods_nestora',$mods);update_option('ecomus_hide_admin_notice',true);echo wp_json_encode(['parent'=>wp_get_theme('nestora')->get('Template'),'products'=>wp_count_posts('product')->publish]);`,'ecomus')).text);
console.log((await phpJob(`<?php require '/wordpress/wp-load.php';require_once ABSPATH.'wp-admin/includes/plugin.php';$r=activate_plugin('ecomus-addons/ecomus-addons.php');echo is_wp_error($r)?$r->get_error_message():'Ecomus Addons activated';`,'addons')).text);
