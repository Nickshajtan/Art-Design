<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use Carbon_Fields\Container;
use Carbon_Fields\Field;
if( is_plugin_active('wp-mail-smtp/wp-mail-smtp.php') ) {
    $basic_options_container = Container::make( 'theme_options',1, __('Theme Options') ) 
    ->add_tab( __('Настройки форм обратной связи'), array(
        Field::make( 'checkbox', 'panel', __("Сохранять письма в админ-панели") )
                             ->set_option_value('yes')
                             ->help_text(__("Предупреждение: эта опция может привести к увеличению размера Вашей базы данных"))
                             ->set_width(50),
	) )
    ->add_tab( __('Онлайн-поддержка'), array(
        Field::make( 'checkbox', 'online-phone', __("Использовать плагин заказа обратного звонка") )
                             ->set_option_value('yes')
                             ->set_width(100),
        Field::make( 'checkbox', 'online-chat', __("Использовать плагин онлайн-чата") )
                             ->set_option_value('yes')
                             ->set_width(100),
    ))
    ->add_tab( __('Режим разработки'), array(
        Field::make( 'checkbox', 'seo', __("Включить режим разработки") )
                             ->set_option_value('yes')
                             ->help_text(__("Эта опция деактивирует некоторое плагины связанные с разработкой"))
                             ->set_width(100),
    ));
}
else{
    $basic_options_container = Container::make( 'theme_options', __('Theme Options') )
    ->add_tab( __('Настройки форм обратной связи'), array(
        Field::make( 'checkbox', 'smtp', __("Использовать SMTP") )
                             ->set_option_value('yes')
                             ->help_text(__("Используйте SMTP сервер для отправки сообщений"))
                             ->set_width(50),
        Field::make( 'checkbox', 'panel', __("Сохранять письма в админ-панели") )
                             ->set_option_value('yes')
                             ->help_text(__("Предупреждение: эта опция может привести к увеличению размера Вашей базы данных"))
                             ->set_width(50),
        Field::make("text", "form_email", __("Email получателя"))
                            ->help_text(__("Введите email получателя для форм обратной связи"))
                            ->set_width(100),
        Field::make( 'checkbox', 'smtpauth', __("Включить SMTP аутентификацию") )
                             ->set_width(25)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
        Field::make( 'text', 'port', __("Введите SMTP порт") )
                             ->set_width(25)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
        Field::make( 'text', 'secure', __("SMTP трансфер (TLS, SSL, и т. п.)") )
                             ->set_width(25)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
        Field::make( 'text', 'lang', __("Установите язык (lang code)") )
                             ->set_width(25)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
        Field::make( 'text', 'smtp_host', __("SMTP хост") )
                             ->set_width(33)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
        Field::make( 'text', 'smtp_name', __("SMTP логин") )
                             ->set_width(33)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
        Field::make( 'text', 'smtp_passw', __("SMTP пароль") )
                             ->set_width(33)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
        Field::make( 'text', 'second_mail', __("Второй Email получателя (опционально)") )
                             ->set_width(33)
                             ->set_conditional_logic( array(
                                array(
                                    'field' => 'smtp',
                                    'value' => true,
                                )
                            ) ),
	) )
    ->add_tab( __('Онлайн-поддержка'), array(
        Field::make( 'checkbox', 'online-phone', __("Использовать плагин заказа обратного звонка") )
                             ->set_option_value('yes')
                             ->set_width(100),
        Field::make( 'checkbox', 'online-chat', __("Использовать плагин онлайн-чата") )
                             ->set_option_value('yes')
                             ->set_width(100),
    ))
    ->add_tab( __('Режим разработки'), array(
        Field::make( 'checkbox', 'seo', __("Включить режим разработки") )
                             ->set_option_value('yes')
                             ->help_text(__("Эта опция деактивирует некоторое плагины связанные с разработкой"))
                             ->set_width(100),
    ));
}
Container::make( 'theme_options', __('Вставка проивольного кода') )
    ->set_page_parent( $basic_options_container )
    ->add_tab( __('Вставка проивольного кода'), array(
        Field::make( 'header_scripts', 'crb_header_script' )
            ->set_width(100),
        Field::make("textarea", "body_scripts", __("Body scripts"))
			    ->help_text(__("Если в начале тега <body> необходимо добавить скрипты, их нужно указать здеcь."))
                            ->set_width(100),
        Field::make( 'footer_scripts', 'crb_footer_script' )
            ->set_width(100),
    ))
    ->add_tab( __('Размеры изображений'), array(
        Field::make( 'complex', "group", __("Добавьте свои размеры для изображений") )
                            ->add_fields( array(
                                Field::make("text", "custom_im_size_name", __("Название размера"))
                                    ->set_width(33),
                                Field::make("text", "custom_im_size_width", __("Ширина"))
                                    ->set_width(33),
                                Field::make("text", "custom_im_size_height", __("Высота"))
                                    ->set_width(33),
                            )),
    ))
    ->add_tab( __('Библиотеки'), array(
                                Field::make( 'checkbox', 'b4', __("Использовать Bootstrap 4?") )
                                     ->set_option_value('yes')
                                     ->set_width(100),
                                Field::make( 'checkbox', 'fancybox', __("Использовать Fancybox?") )
                                     ->set_option_value('yes')
                                     ->set_width(100),
                                Field::make( 'checkbox', 'masonry', __("Использовать Masonry JS?") )
                                     ->set_option_value('yes')
                                     ->set_width(100),
                                Field::make( 'checkbox', 'slick', __("Использовать Slick?") )
                                     ->set_option_value('yes')
                                     ->set_width(100),
                                Field::make( 'checkbox', 'ais', __("Использовать IAS JS?") )
                                     ->set_option_value('yes')
                                     ->set_width(100),
	    			Field::make( 'text', 'ais_container', __("Использовать IAS JS?") )
                                     ->set_option_value('yes')
                                     ->set_width(50)
	    			     ->help_text(__("Введите classname контейнера для IAS"))
	    			     ->set_conditional_logic( array(
						array(
						    'field' => 'ais',
						    'value' => true,
						)
					) ),
	    			Field::make( 'text', 'ais_item', __("Использовать IAS JS?") )
                                     ->set_option_value('yes')
                                     ->set_width(50)
	    			     ->help_text(__("Введите classname item-единицы для IAS"))
	    			     ->set_conditional_logic( array(
						array(
						    'field' => 'ais',
						    'value' => true,
						)
					) ),
	    			Field::make( 'text', 'ais_offset', __("Использовать IAS JS?") )
                                     ->set_option_value('yes')
                                     ->set_width(100)
	    			     ->help_text(__("Количество прокруток прежде чем появится кнопка Load More. По умолчанию равно 1"))
	    			     ->set_conditional_logic( array(
						array(
						    'field' => 'ais',
						    'value' => true,
						)
					) ),
	    			Field::make( 'text', 'ais_pagination', __("Использовать IAS JS?") )
                                     ->set_option_value('yes')
                                     ->set_width(50)
	    			     ->help_text(__("Введите classname элемента пагинации. Опционально"))
	    			     ->set_conditional_logic( array(
						array(
						    'field' => 'ais',
						    'value' => true,
						)
					) ),
	    			Field::make( 'text', 'ais_next', __("Использовать IAS JS?") )
                                     ->set_option_value('yes')
                                     ->set_width(50)
	    			     ->help_text(__("Введите classname кнопки 'Дальше' пагинации. Опционально"))
	    			     ->set_conditional_logic( array(
						array(
						    'field' => 'ais',
						    'value' => true,
						)
					) ),
    ));
