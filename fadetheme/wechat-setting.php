<?php   
//给仪表盘下面添加菜单
add_action('admin_menu', 'options_submenu');
function options_submenu() 
{
    add_options_page(__('小程序设置'), __('小程序设置'), 'read', 'your-unique-identifier', 'display_function');
}  
  
function display_function(){ 
?>   
    <form method="post" name="ashu_form" id="ashu_form">   
    <h2>阿树工作室主题设置</h2>   
    <p>   
    <label>   
    <input name="ashu_copy_right" size="40" />   
    请输入文字   
    </label>   
    </p>   
    <p class="submit">   
        <input type="submit" name="option_save" value="<?php _e('保存设置'); ?>" />   
    </p>    
    </form>   
       
<?php } ?>  