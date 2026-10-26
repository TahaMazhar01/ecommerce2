<?php
if(!defined('ABSPATH'))exit;
add_action('after_setup_theme',function(){
 add_theme_support('woocommerce');add_theme_support('wc-product-gallery-zoom');add_theme_support('wc-product-gallery-slider');add_theme_support('wc-product-gallery-lightbox');add_theme_support('editor-styles');add_editor_style('assets/nestora.css');
 register_nav_menus(['nestora-main'=>'Nestora main navigation','nestora-footer'=>'Nestora footer navigation']);
 global $wp_filter;
 foreach($wp_filter as $hook=>$actions){if(!str_starts_with($hook,'woocommerce_'))continue;foreach($actions->callbacks as $priority=>$callbacks)foreach($callbacks as $callback){$fn=$callback['function'];if(is_string($fn)&&str_starts_with($fn,'foodu_'))remove_filter($hook,$fn,$priority);}}
 remove_filter('woocommerce_enqueue_styles','__return_false');
 if(function_exists('WC'))include WC()->plugin_path().'/includes/wc-template-hooks.php';
},100);
add_action('wp_enqueue_scripts',function(){
 foreach(['bootstrap','fontawesome','magnific-popup','swiper-bundle','foodu-animate','foodu-shop','foodu-validnavs','foodu-helper','foodu-main-style','foodu-unittest','foodu-style','foodu-fonts','foodu-color-schemes'] as $h)wp_dequeue_style($h);
 foreach(['bootstrap','appear','swiper-bundle','progress','isotope-pkgd','magnific-popup','count-to','nice-select','YTPlayer','gsap','ScrollTrigger','SplitText','foodu-validnavs','wow','loopcounter','foodu-main-script'] as $h)wp_dequeue_script($h);
 if(function_exists('WC')){
  wp_enqueue_style('nestora-woo-general',WC()->plugin_url().'/assets/css/woocommerce.css',[]);
  wp_enqueue_style('nestora-woo-layout',WC()->plugin_url().'/assets/css/woocommerce-layout.css',[]);
  wp_enqueue_style('nestora-woo-small',WC()->plugin_url().'/assets/css/woocommerce-smallscreen.css',[],'1.0','only screen and (max-width: 768px)');
 }
 wp_enqueue_style('nestora',get_stylesheet_directory_uri().'/assets/nestora.css',['nestora-woo-general','nestora-woo-layout'],(string)filemtime(get_stylesheet_directory().'/assets/nestora.css'));
 wp_enqueue_script('nestora',get_stylesheet_directory_uri().'/assets/nestora.js',[],(string)filemtime(get_stylesheet_directory().'/assets/nestora.js'),true);
},999);
add_filter('woocommerce_locate_template',function($path,$name){$core=WC()->plugin_path().'/templates/'.$name;return file_exists($core)?$core:$path;},99,2);
add_filter('wc_get_template_part',function($path,$slug,$name){$core=WC()->plugin_path().'/templates/'.$slug.($name?'-'.$name:'').'.php';return file_exists($core)?$core:$path;},99,3);
add_filter('template_include',function($template){return function_exists('is_woocommerce')&&is_woocommerce()?get_stylesheet_directory().'/woocommerce.php':$template;},99);
add_filter('body_class',function($classes){$classes[]='nestora-site';return $classes;});
// Preserve the Nestora child layout while retaining the supplied Ecomus parent.
add_action('wp',function(){
 global $wp_filter;
 foreach($wp_filter as $hook=>$actions){if(!str_starts_with($hook,'woocommerce_')&&!in_array($hook,['wp_footer','wp_head','wp_body_open']))continue;foreach($actions->callbacks as $priority=>$callbacks)foreach($callbacks as $callback){$fn=$callback['function'];if(is_array($fn)&&is_object($fn[0])&&str_starts_with(get_class($fn[0]),'Ecomus\\'))remove_filter($hook,$fn,$priority);}}
 if(function_exists('WC'))include WC()->plugin_path().'/includes/wc-template-hooks.php';
},999);
add_action('wp_enqueue_scripts',function(){global $wp_styles,$wp_scripts;foreach($wp_styles->queue as $handle)if(str_starts_with($handle,'ecomus'))wp_dequeue_style($handle);foreach($wp_scripts->queue as $handle)if(str_starts_with($handle,'ecomus'))wp_dequeue_script($handle);},1000);
add_filter('loop_shop_columns',fn()=>4);add_filter('loop_shop_per_page',fn()=>12);
add_filter('woocommerce_add_to_cart_fragments',function($fragments){$fragments['span.ns-cart-count']='<span class="ns-cart-count">'.WC()->cart->get_cart_contents_count().'</span>';return $fragments;});
add_action('woocommerce_before_shop_loop',function(){
 echo '<form class="ns-filters" method="get" action="'.esc_url(wc_get_page_permalink('shop')).'"><label>Collection<select name="product_cat"><option value="">All collections</option>';
 foreach(get_terms(['taxonomy'=>'product_cat','hide_empty'=>true]) as $term)echo '<option value="'.esc_attr($term->slug).'" '.selected(sanitize_text_field($_GET['product_cat']??''),$term->slug,false).'>'.esc_html($term->name).'</option>';
 echo '</select></label><label>Maximum price (PKR)<input type="number" min="0" name="max_price" placeholder="Any price" value="'.esc_attr(wc_clean($_GET['max_price']??'')).'"></label><label>Availability<select name="availability"><option value="">Any availability</option><option value="instock" '.selected($_GET['availability']??'','instock',false).'>In stock</option></select></label><button type="submit">Apply filters</button><a href="'.esc_url(wc_get_page_permalink('shop')).'">Reset</a></form>';
},5);
add_action('woocommerce_product_query',function($q){if(($_GET['availability']??'')==='instock'){$meta=$q->get('meta_query');$meta[]=['key'=>'_stock_status','value'=>'instock'];$q->set('meta_query',$meta);}if(($_GET['on_sale']??'')==='1')$q->set('post__in',array_merge([0],wc_get_product_ids_on_sale()));});
add_filter('woocommerce_product_tabs',function($tabs){$tabs['care']=['title'=>'Delivery & care','priority'=>25,'callback'=>function(){echo '<h2>A little care goes a long way.</h2><p>Orders leave within 1–2 business days. Standard delivery takes 3–7 days; express takes 1–3 days. Free standard shipping on orders of PKR 15,000 or more. Return unused items within 30 days in their original packaging.</p><p>Product images are licensed stock photographs illustrating styles for this coursework store. Check each product description for materials and care.</p>';}];return $tabs;});

// Native WooCommerce sale percentage, calculated from the editable product prices.
function nestora_sale_badge($html,$post,$product){$regular=(float)$product->get_regular_price();$sale=(float)$product->get_sale_price();$percent=$regular>0&&$sale>0?round((1-$sale/$regular)*100):0;return '<span class="onsale" aria-label="'.esc_attr($percent?'Save '.$percent.' percent':'On sale').'">'.esc_html($percent?'SAVE '.$percent.'%':'SALE').'</span>';}
add_filter('woocommerce_sale_flash','nestora_sale_badge',20,3);

add_filter('woocommerce_currency_symbol',function($symbol,$currency){return $currency==='PKR'?'PKR':$symbol;},10,2);
