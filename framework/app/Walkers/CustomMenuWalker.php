<?php

namespace Gaumap\Walkers;

/**
 * The menu walker.  This is just the methods from `Walker_Nav_Menu` with
 * all of the whitespace generation (eg. `$indent` remove) as well as
 * some restrictions on the CSS classes that are added. Menu item IDs are also
 * removed.
 * Most of the filters here are preserved so it should be backwards
 * compatible.
 *
 * @since   0.1
 */
class CustomMenuWalker extends \Walker_Nav_Menu {
    // Khai báo thuộc tính $menu_type với private
    private $menu_type;

    // Constructor để nhận kiểu menu
    public function __construct($menu_type = 'pc') {
        $this->menu_type = $menu_type; // 'mobile' hoặc 'pc'
    }


    function start_lvl(&$output, $depth = 0, $args = []) {
        if ($args->walker->has_children) {
            $output .= '<ul class="list-unstyled sub-menu">';
        } else {
            $output .= '<ul class="list-unstyled">';
        }
    }

    function end_lvl(&$output, $depth = 0, $args = []) {
        $output .= '</ul>';
    }

    function start_el(&$output, $item, $depth = 0, $args = [], $id = 0) {
        $classes = empty($item->classes) ? [] : (array) $item->classes;
        $classes[] = 'bg-main menu-item-' . $item->ID;
    
        // Thêm class menu-item-has-children nếu mục này có submenu
        if ($args->walker->has_children) {
            $classes[] = 'menu-item-has-children';
        }
    
        // Ghép các class thành chuỗi
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="menu-line ' . esc_attr($class_names) . '"' : '';
    
        // Kiểm tra $menu_type và xử lý khác nhau giữa mobile và PC
        if ($this->menu_type == 'mobile') {
            // Cho mobile: thêm icon cho các mục có submenu
            if ($args->walker->has_children) {
                $output .= '<li' . $class_names . '>';
                $output .= '<a href="#">' . $item->title . '<div class="icons-dropdown"><div class="icons-toogle-plus open"></div></div></a>';
            } else {
                $output .= '<li' . $class_names . '>';
                $output .= '<a href="' . esc_url($item->url) . '">' . $item->title . '</a>';
            }
        } else {
            // Cho PC: xử lý bình thường
            $output .= '<li' . $class_names . '>';
            $output .= '<a href="' . esc_url($item->url) . '">' . $item->title . '</a>';
        }
    
        $output .= $args->after;
    }

    function end_el(&$output, $item, $depth = 0, $args = []) {
        $output .= "</li>";
    }
}