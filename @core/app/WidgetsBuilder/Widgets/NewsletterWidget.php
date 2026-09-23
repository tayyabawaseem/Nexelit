<?php

namespace App\WidgetsBuilder\Widgets;


use App\Helpers\LanguageHelper;
use App\Language;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\Widgets;
use App\WidgetsBuilder\WidgetBase;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;

class NewsletterWidget extends WidgetBase
{
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();


        $output .= $this->admin_language_tab(); //have to start language tab from here on
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key == 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);
            $output .= Text::get([
                'name' => 'widget_title_'.$lang->slug,
                'label' => __('Widget Title'),
                'value' => $widget_saved_values['widget_title_' . $lang->slug] ?? null,
            ]);
            $output .= Summernote::get([
                'name' => 'description_'.$lang->slug,
                'label' => __('Description'),
                'value' => $widget_saved_values['description_' . $lang->slug] ?? null,
            ]);
            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end(); //have to end language tab

        //repeater
        $output .= Repeater::get([
            'multi_lang' => true,
            'settings' => $widget_saved_values,
            'id' => 'follow_widget_repeater_01',
            'fields' => [
                [
                    'type' => RepeaterField::ICON_PICKER,
                    'name' => 'icon',
                    'label' => __('Icon')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title')
                ],
                [
                    'type' => RepeaterField::NUMBER,
                    'name' => 'number',
                    'label' => __('number')
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('URL')
                ],
            ],

            'info' => __('Add the social media platforms in the following order: Facebook, Twitter, LinkedIn, Instagram, Pinterest, YouTube.')
        ]);


        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $widget_saved_values = $this->get_settings();
        $description = $widget_saved_values['description_'.LanguageHelper::user_lang_slug()] ?? '';
        $widget_title = $widget_saved_values['widget_title_'.LanguageHelper::user_lang_slug()] ?? '';

        $rep_icons = $widget_saved_values['follow_widget_repeater_01']['icon_'.LanguageHelper::user_lang_slug()] ??  [];
        $rep_title = $widget_saved_values['follow_widget_repeater_01']['title_'.LanguageHelper::user_lang_slug()] ??  [];
        $rep_number = $widget_saved_values['follow_widget_repeater_01']['number_'.LanguageHelper::user_lang_slug()] ??  [];
        $rep_url = $widget_saved_values['follow_widget_repeater_01']['url_'.LanguageHelper::user_lang_slug()] ??  [];

        $output = $this->widget_before(); //render widget before content
        $output .= '<div class="newsletter-widget">';
        if (!empty($widget_title)) {
            $output .= '<h4 class="widget-title">' . purify_html($widget_title). '</h4>';
        }

        $output .= '<div class="paragraph">'.$description.'</div>';
        $output .= '<div class="form-message-show"></div><div class="newsletter-form-wrap">';
        $output .= '<form action="'.route('frontend.subscribe.newsletter').'" method="post" enctype="multipart/form-data">';
        $output .= '<input type="hidden" name="_token" value="'.csrf_token().'">
                    <div class="form-group">
                        <input type="email" name="email" placeholder="'.__('your email').'" class="form-control">
                    </div>
                    <button type="submit" class="submit-btn"><i class="fas fa-paper-plane"></i></button>
                </form>';

        // social icon start
        $chunked_arr =  array_chunk($rep_icons,2,true);
        $output .= '<div class="sidebar-contents margin-top-20"><div class="follow-list">';
        $colors = ['facebook','twitter','linkedin','instagram',' pintarest','youtube'];
        foreach($chunked_arr as $index => $ficon){
            $output .= '<div class="single-flex-list d-flex justify-content-start flex-wrap">';
            foreach($ficon as $key => $icon){
                $output .= '<div class="single-list margin-top-20 mr-3 d-flex align-items-center">';
                $output .= '<a class="'.$colors[$key % count($colors)].'-bg" href="'.$rep_url[$key].'"> <i class="'.$icon.'"></i> </a>';
                $output .= '<span class="followers ' . $colors[$key % count($colors)] . '-social-title"> <strong>' . $rep_number[$key] . '</strong> ' . $rep_title[$key] . ' </span>';
                $output .= '</div>';
            }
            $output .= '</div>';
        }
        $output .= '</div></div>'; // end social icon

        $output .= '</div></div>';
        $output .= $this->widget_after(); // render widget after content

        return $output;
    }

    public function widget_title(){
        return __('Newsletter');
    }

}