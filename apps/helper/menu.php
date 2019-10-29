<?php
class menu
{
    public function __construct()
    {
        $this->DB = new database;
    }
    public function getSidebarMenu()
    {
        $_SESSION['sidebarMenu'] = [];
        $role_id =    $_SESSION['user_data']['role_id'];
        $query = "SELECT user_menu.id , menu from user_menu JOIN user_access_menu
             on user_menu.id=user_access_menu.menu_id WHERE user_access_menu.role_id=$role_id
             ORDER by user_access_menu.menu_id
            ";
        $this->DB->query($query);
        $this->DB->execute();
        $menu = $this->DB->resultSet();

        // var_dump($menu);
        foreach ($menu as $menu) {
            $menuId = $menu['id'];
            // var_dump($menuId);
            $query = "SELECT * FROM sub_menu where menu_id=$menuId and is_active=1 order by id asc";
            $this->DB->query($query);
            $this->DB->execute();
            $subMenu = $this->DB->resultSet();
            $_SESSION['sidebarMenu'][] = $subMenu;
        }
    }
}
