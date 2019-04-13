<?php
//给仪表盘下面添加菜单
add_action('admin_menu', 'options_submenu');
function options_submenu()
{
    add_options_page(__('小程序设置'), __('小程序设置'), 'read', 'your-unique-identifier', 'display_function');
} 

function display_function(){
?> 

<?php
if ($_POST['update_options']=='true') {//若提交了表单，则做相关操作
    wplog('Form has been submitted, match_param: ',$_POST['match_param']);
    if($_POST['match_param'] == 1)//1表示立即匹配
    {
        match_and_save_partners();
        update_option('match_param', $_POST['match_param']);
        echo '<div id="message" class="show_hint"><p>opration success!</p></div>';//保存完毕显示文字提示
    }
    else if($_POST['match_param'] > 1)
    {
        update_option('match_param', $_POST['match_param']);
        echo '<div id="message" class="show_hint"><p>opration success!</p></div>';//保存完毕显示文字提示
    }
    else if($_POST['match_param'] == 0)
    {
        test_match();
        update_option('match_param', $_POST['match_param']);
        echo '<div id="message" class="show_hint"><p>opration success!</p></div>';//保存完毕显示文字提示
    }
    else
    {
        echo '<div id="message" class="show_hint"><p>please input data!</p></div>';
    }
}

//下面开始界面表单
?>
    <form method="post" name="match_form" action=""> 
        <input type="hidden" name="update_options" value="true" />
        <h2>微信小程序设置页面</h2> 
        <p> 
            <label> 
                请输入匹配参数：
                <input name="match_param" size="40" value="<?php echo get_option('match_param'); ?>" /> 
            </label> 
        </p> 
        <p class="submit"> 
            <input type="submit" name="option_save" value="提交设置" />   
        </p>
    </form>
<?php } ?> 

<?php
//匹配规则：两两之间算出匹配得分，匹配得分最高者则匹配成功。
//得分计算方法：性别相反得10分，英语等级相等得3分，差1级得2分，差2级得1分，差2级以上得0分。
//学习目标相等得1分，目标不相等得0分。
//所在城市相同得4分，所在城市不同但省份相同得2分，省份也不同得0分
function match_patners(&$partners)
{
    global $wpdb;
    wplog('match_patners, ivoked: ',$_POST['match_param']);
    $sql = "select * from " . TABLE_APPLICATION . " where current_status = 1";
    $results = $wpdb->get_results($sql);
    if($results == null)
    {
        wplog('There are not partners ,current_status = 1.','');
        return false;
    }
    foreach($results as $value)
    {
        $openid = $value->openid;
        $sql_partner = "select * from " . TABLE_PARTNER . " where openid = ". "'".$openid."'";
        $partner = $wpdb->get_row($sql_partner);
        $partner->partner = '';
        $partner->score = 0;
        if($partner != null && !empty($partner))
        {
            $partners[] = $partner;
        }
    }
    $partner_count = count($partners);
    foreach($partners as $value)
    {
        if($value->partner != '')
        {
            continue;//跳过已经匹配了的用户
        }
        $temp_index = 0;
        wplog('partner first: ',$value->openid);
        for($i = 0;$i < $partner_count; ++$i)
        {
            if($partners[$i]->partner != '')
            {
                continue;//跳过已经匹配了的用户
            }
            if($value->openid != $partners[$i]->openid)
            {
                $match_score = 1;//基础分为1分，防止得分为0的情况
                if($value->sex != $partners[$i]->sex)
                {
                    $match_score += 10;
                }
                $english_level_gap = abs($partners[$i]->english_level - $value->english_level);
                $match_score += (3 - $english_level_gap);
                if($value->purpose == $partners[$i]->purpose)
                {
                    $match_score += 1;
                }
                if($value->city == $partners[$i]->city)
                {
                    $match_score += 4;
                }
                else if($value->province == $partners[$i]->province)
                {
                    $match_score += 2;
                }
                wplog('partner second: '. $partners[$i]->openid, ' total score: '.$match_score);
                if($match_score > $value->score)
                {
                    $value->score = $match_score;
                    $value->partner = $partners[$i]->openid;
                    $partners[$i]->partner = $value->openid;
                    if($temp_index != $i && $temp_index != 0)
                    {
                        $partners[$temp_index]->partner = '';//替换得分较低者后，将其还原回去
                    }
                    $temp_index= $i;
                }
            }
        }
    }
    return true;
}

//匹配合伙人并且写入数据库
function match_and_save_partners()
{
    $partners = array();
    match_patners($partners);
    foreach($partners as $value)
    {
        global $wpdb;
        $sql = "update ".TABLE_APPLICATION." set current_status = 2 , partner = '".$value->partner."', start_time = '".date('Y-m-d H:i:s', time())."' where openid = '".$value->openid."' and current_status = 1";

        $update_params = array( 'current_status' => 2, 'partner' => $value->partner, 'start_time' => date('Y-m-d H:i:s', time()));
        $condition = array( 'openid' => $value->openid, 'current_status' => 1 );
        $ret = $wpdb->update( TABLE_APPLICATION, $update_params, $condition, array("%d","%s","%s"), array("%s","%d"));
        if( !$ret )
        {
            wplog('update database failed or on data updata , openid: ', $value->openid);
        }
    }
}

function test_match()
{
    $partners = array();
    match_patners($partners);
    var_dump($partners);
}

?>