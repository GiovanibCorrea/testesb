<?php

class Menu
{
    public $titulo;
    public $id;
    public $url;
    public $submenu;
    public $target;
}

$menu_name = 'menu-1';
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object($locations[ $menu_name ]);
$menuitems = wp_get_nav_menu_items($menu->term_id, array('order' => 'DESC'));
$submenu = false;
$id_anterior = 0;
$set_menu = false;
foreach( $menuitems as $item ):
    //adiciona o menu
    if (!$item->menu_item_parent){
        // o menu precisa ser adicionado depois de setar seus filhos logo 
        //a variavel setmenu vai certificar que você consiga setar os 
        //filhos do menu corretamente
        if ($set_menu == true) { $menus[] = $myMenu;  $set_menu = false;}
        if ($set_menu == false) { $set_menu = true;}

        $myMenu = new Menu();
        $myMenu->titulo = $item->title;
        $myMenu->id = $item->ID;
        $myMenu->url = $item->url;
        $myMenu->target = $item->target;
    } 
    else 
    { 

        if ($id_anterior != $item->menu_item_parent) { 
            $mySubmenu = new Menu();
            $mySubmenu->titulo = $item->title;
            $mySubmenu->id = $item->ID;
            $mySubmenu->url = $item->url;
            $mySubmenu->target = $item->target;
            $myMenu->submenu[] = $mySubmenu; 
        }

        if ($id_anterior == $item->menu_item_parent) { 
            $mySubSubmenu = new Menu();
            $mySubSubmenu->titulo = $item->title;
            $mySubSubmenu->id = $item->ID;
            $mySubSubmenu->url =  $item->url;
            $mySubSubmenu->target = $item->target;
            $mySubmenu->submenu[] = $mySubSubmenu; 
        }
        if ($id_anterior != $item->menu_item_parent){
            $id_anterior = $item->ID; 
        }
        //adiciona o subsubmenu
    }  
endforeach; 
//necessário para adicionar o último ítem do menu
$menus[] = $myMenu;

?>