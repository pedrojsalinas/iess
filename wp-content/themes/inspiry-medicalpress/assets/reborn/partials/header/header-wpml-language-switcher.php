<?php
global $theme_options;

/* WPML Language Switcher */
if($theme_options['display_wpml_flags']){
    if(function_exists('icl_get_languages')){
        $languages = icl_get_languages('skip_missing=0');
        if(!empty($languages)){
            echo '<div class="wrapper_language"><div class="header_language_list"><ul class="clearfix">';
            foreach($languages as $l){
                echo '<li>';
                if($l['country_flag_url']){
                    if(!$l['active']) echo '<a href="'.$l['url'].'">';
                    echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
                    if(!$l['active']) echo '</a>';
                }
                echo '</li>';
            }
            echo '</div></div>';
        }
    }
}
