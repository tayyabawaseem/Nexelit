<?php


namespace App\PageBuilder\Addons\Newsletter;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class NewsletterOne extends PageBuilderBase
{
//    use RepeaterHelper;
    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'newsletter/01.png';
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        // Start language tab
        $output .= $this->admin_language_tab();
        $output .= $this->admin_language_tab_start();

        $all_languages = LanguageHelper::all_languages();
        foreach ($all_languages as $key => $lang) {
            $output .= $this->admin_language_tab_content_start([
                'class' => $key === 0 ? 'tab-pane fade show active' : 'tab-pane fade',
                'id' => "nav-home-" . $lang->slug
            ]);

            $output .= Text::get([
                'name' => 'subtitle_'.$lang->slug,
                'label' => __('Subtitle'),
                'value' => $widget_saved_values['subtitle_' . $lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'title_'.$lang->slug,
                'label' => __('Title'),
                'value' => $widget_saved_values['title_' . $lang->slug] ?? null,
            ]);

            $output .= Text::get([
                'name' => 'placeholder_'.$lang->slug,
                'label' => __('Email Placeholder'),
                'value' => $widget_saved_values['placeholder_' . $lang->slug] ?? __('Enter your email'),
            ]);

            $output .= $this->admin_language_tab_content_end();
        }

        $output .= $this->admin_language_tab_end();

        // Shape Image field
//        $output .= Image::get([
//            'name' => 'shape_image',
//            'label' => __('Shape Image'),
//            'value' => $widget_saved_values['shape_image'] ?? null,
//        ]);

        // Padding options
        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 50,
            'max' => 500,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 50,
            'max' => 500,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $settings = $this->get_settings();
        $current_lang = LanguageHelper::user_lang_slug();

        $subtitle = SanitizeInput::esc_html($settings['subtitle_'.$current_lang] ?? '');
        $title = $settings['title_'.$current_lang] ?? '';
        $placeholder = SanitizeInput::esc_html($settings['placeholder_'.$current_lang] ?? 'Enter your email');
        $shape_img = render_image_markup_by_attachment_id($settings['shape_image'] ?? null);

        $padding_top = SanitizeInput::esc_html($settings['padding_top'] ?? 50);
        $padding_bottom = SanitizeInput::esc_html($settings['padding_bottom'] ?? 50);

        // Replace {shape}...{/shape} with span
        $title = str_replace(
            ['{shape}', '{/shape}'],
            ['<span class="section-shape">','</span>'],
            $title
        );

        return <<<HTML
<section class="newsletter-area home-21 home-21-section-bg padding-top-{$padding_top} padding-bottom-{$padding_bottom}">
    
    <div class="container container-three">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="newsletter-wrapper center-text">
                    <div class="section-title-21">
                        <span class="subtitle color-light mb-3">{$subtitle}</span>
                        <h2 class="title">{$title}</h2>
                    </div>
                    <div class="newsletter-widget">
                        <div class="form-message-show"></div>
                        <div class="newsletter-form-wrap">
                            <form action="{{route('frontend.subscribe.newsletter')}}" class="newsletter-form mt-4 mt-lg-5">
                                <div class="single-input">
                                    <input class="form--control" type="email" name="email" placeholder="{$placeholder}">
                                </div>
                                <button class="newsletter-btn submit-btn" type="submit" aria-label="Subscribe to newsletter">
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
HTML;
    }

    /**
     * Addon title for admin panel
     */
    public function addon_title()
    {
        return __('Newsletter Section: 1');
    }

}