хук, через который подключается функция
// регистрирующая новые таксономии (create_book_taxonomies)
add_action( 'init', 'dish_taxonomies' );

// функция, создающая 2 новые таксономии "genres" и "writers" для постов типа "book"
function create_book_taxonomies()
{

    // Добавляем древовидную таксономию 'genre' (как категории)
    register_taxonomy('genre', array('dish'), array(
        'hierarchical' => true,
        'labels' => array(
            'name' => _x('Genres', 'taxonomy general name'),
            'singular_name' => _x('Genre', 'taxonomy singular name'),
            'search_items' => __('Search Genres'),
            'all_items' => __('All Genres'),
            'parent_item' => __('Parent Genre'),
            'parent_item_colon' => __('Parent Genre:'),
            'edit_item' => __('Edit Genre'),
            'update_item' => __('Update Genre'),
            'add_new_item' => __('Add New Genre'),
            'new_item_name' => __('New Genre Name'),
            'menu_name' => __('Genre'),
        ),
        'show_ui' => true,
        'query_var' => true,
        //'rewrite'       => array( 'slug' => 'the_genre' ), // свой слаг в URL
    ));

    // Добавляем НЕ древовидную таксономию 'writer' (как метки)
    register_taxonomy('writer', 'dish', array(
        'hierarchical' => false,
        'labels' => array(
            'name' => _x('Writers', 'taxonomy general name'),
            'singular_name' => _x('Writer', 'taxonomy singular name'),
            'search_items' => __('Search Writers'),
            'popular_items' => __('Popular Writers'),
            'all_items' => __('All Writers'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit Writer'),
            'update_item' => __('Update Writer'),
            'add_new_item' => __('Add New Writer'),
            'new_item_name' => __('New Writer Name'),
            'separate_items_with_commas' => __('Separate writers with commas'),
            'add_or_remove_items' => __('Add or remove writers'),
            'choose_from_most_used' => __('Choose from the most used writers'),
            'menu_name' => __('Блюда'),
        ),
        'show_ui' => true,
        'query_var' => true,
        //'rewrite'       => array( 'slug' => 'the_writer' ), // свой слаг в URL
    ));
}

add_action( 'init', 'register_post_types' );
function register_post_types()
{
    register_post_type('dish', array(
        'label' => null,
        'labels' => array(
            'name' => 'Блюда', // основное название для типа записи
            'singular_name' => 'Блюдо', // название для одной записи этого типа
            'add_new' => 'Добавить блюдо', // для добавления новой записи
            'add_new_item' => 'Добавление Блюд', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item' => 'Редактирование Блюда', // для редактирования типа записи
            'new_item' => 'Новое Блюдо', // текст новой записи
            'view_item' => 'Посмотреть Блюдо', // для просмотра записи этого типа.
            'search_items' => 'Искать среди Блюд', // для поиска по этим типам записи
            'not_found' => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon' => '', // для родителей (у древовидных типов)
            'menu_name' => 'Блюда', // название меню
        ),
        'description' => '',
        'public' => true,
        'publicly_queryable' => true, // зависит от public
        'exclude_from_search' => true, // зависит от public
        'show_ui' => true, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu' => true, // показывать ли в меню адмнки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest' => null, // добавить в REST API. C WP 4.7
        'rest_base' => null, // $post_type. C WP 4.7
        'menu_position' => null,
        'menu_icon' => null,
        'capability_type' => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical' => false,
        'supports' => ['editor'], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies' => ['dish'],
        'has_archive' => false,
        'rewrite' => ['slug' => 'dish'],
        'query_var' => true,
    ));
}
