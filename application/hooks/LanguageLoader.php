<?php


class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        $siteLang = $ci->session->userdata('site_lang');
        if ($siteLang) {
            $ci->lang->load('login',$siteLang);
            $ci->lang->load('header',$siteLang);
            $ci->lang->load('profile',$siteLang);
            $ci->lang->load('billing',$siteLang);
            $ci->lang->load('account',$siteLang);
            $ci->lang->load('big_data',$siteLang);
            $ci->lang->load('keyword_track',$siteLang);
            $ci->lang->load('dashboard',$siteLang);
            $ci->lang->load('history',$siteLang);
            $ci->lang->load('image_hosting',$siteLang);
            $ci->lang->load('key_index_checker',$siteLang);
            $ci->lang->load('listing_keyword_stuffer',$siteLang);
            $ci->lang->load('magnet_search',$siteLang);
            $ci->lang->load('reverse_search',$siteLang);
            $ci->lang->load('search_term',$siteLang);
            $ci->lang->load('url_generator',$siteLang);
        } else {
            $ci->lang->load('login','english');
            $ci->lang->load('header','english');
            $ci->lang->load('profile','english');
            $ci->lang->load('billing','english');
            $ci->lang->load('account','english');
            $ci->lang->load('big_data','english');
            $ci->lang->load('keyword_track','english');
            $ci->lang->load('dashboard','english');
            $ci->lang->load('history','english');
            $ci->lang->load('image_hosting','english');
            $ci->lang->load('key_index_checker','english');
            $ci->lang->load('listing_keyword_stuffer','english');
            $ci->lang->load('magnet_search','english');
            $ci->lang->load('reverse_search','english');
            $ci->lang->load('search_term','english');
            $ci->lang->load('url_generator','english');
        }
    }
}