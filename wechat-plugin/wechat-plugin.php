<?php
/**
 * @package wechat-plugin
 * @version 1.0
 */
/*
Plugin Name: Wechat plugin
Plugin URI: http://www.runtimego.com
Description: This is a plugin for my wechat public account. 
In this plugin ,there are some functions such as signup ,statistics.
Author: Dan qing
Version: 1.0
Author URI: http://www.runtimego.com
*/

// 声明常量来存储插件版本号 和 该插件最低要求WordPress的版本
define('WECHAT_PLUGIN_VERSION_NUM', '1.0');
define('WECHAT_PLUGIN_MINIMUM_WP_VERSION', '4.0');

// 声明全局变量$wpdb 和 数据表名常量
global $wpdb;
define('TABLE_PARTNER', $wpdb->prefix . 'partners');
define('TABLE_APPLICATION', $wpdb->prefix .'applications');


// 插件激活时，运行回调方法创建数据表, 在WP原有的options表中插入插件版本号
register_activation_hook(__FILE__, 'plugin_activation_cretable');
function plugin_activation_cretable() {
    global $wpdb;
    /*
     * We'll set the default character set and collation for this table.
     * If we don't do this, some characters could end up being converted 
     * to just ?'s when saved in our table.
     */
    $charset_collate = '';

    if (!empty($wpdb->charset)) {
      $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset}";
    }

    if (!empty( $wpdb->collate)) {
      $charset_collate .= " COLLATE {$wpdb->collate}";
    }

    //sex:0-未知,1-man,2-woman;
    //english-level:1-新手，2-四级，3-六级，4-专业
    //purpose:1-出国旅游，2-工作需要，3-日常交流，4-提升自我，5-其他
    //prefer_sex:1-man,2-woman,0-random
    $sql = "CREATE TABLE " . TABLE_PARTNER . " (
        id int(9) NOT NULL AUTO_INCREMENT,
        openid tinytext NOT NULL,
        time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        nickname varchar(32) NOT NULL,
        wechat_id varchar(32) NOT NULL,
        telephone varchar(20) NOT NULL,
        sex tinyint NOT NULL,
        avatar_url text NOT NULL,
        country varchar(32) NOT NULL,
        province varchar(32) NOT NULL,
        city varchar(32) NOT NULL,
        english_level tinyint NOT NULL,
        purpose tinyint NOT NULL,
        prefer_sex tinyint NOT NULL,
        message text NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;";

    //apply_time:报名时间,start_time：任务开始时间,end_time:任务结束时间，如果任务正在进行中，则为空，任务结束自动写入结束时间
    //current_period:当前参与的任务期数,
    //current_status:当前状态，0-默认值，表示未参与，1-已经报名，正在匹配，2-匹配成功，等待任务开始，3-执行任务中，4-任务结束
    //sign_record:打卡记录，以开始任务后的第几天数作为标记，格式为"1,2,3"
    //partner:当前匹配的合伙人微信号，如果当前没有匹配到合伙人，则为空，
    $sql_apply = "CREATE TABLE " . TABLE_APPLICATION . " (
        id int(9) NOT NULL AUTO_INCREMENT,
        openid tinytext NOT NULL,
        current_period tinyint NOT NULL,
        current_status tinyint NOT NULL,
        apply_time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        start_time datetime NOT NULL,
        end_time datetime NOT NULL,
        sign_record tinytext NOT NULL,
        partner varchar(20) NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    dbDelta( $sql_apply);

    // update_option()方法，在options表里如果不存在更新字段，则会创建该字段,存在则更新该字段
    update_option('wechat_plugin_version_num', WECHAT_PLUGIN_VERSION_NUM);
}

// 插件激活时，运行回调方法在数据表中插入数据, 
register_activation_hook(__FILE__, 'plugin_activation_insertdate');
function plugin_activation_insertdate() {
    global $wpdb;
    
    $data['openid'] = '1112';
    $data['nickname'] = '丹青';
    $data['wechat_id'] = 'konggujushi2012';
    $data['telephone']  = '123456789';
    $data["sex"] = 0;
    $data["english_level"] = 0;
    $data["purpose"] = 1;
    $data["prefer_sex"] = 1;


    $wpdb->insert(TABLE_PARTNER, $data);
}

// 当加载插件时，运行回调方法检查插件版本是否有更新,
add_action('plugins_loaded', 'plugin_update_db_check');
function plugin_update_db_check() {
    // 获取到options表里的插件版本号 不等于 当前插件版本号时，运行创建表方法，更新数据库表
    if (get_option('wechat_plugin_version_num') != WECHAT_PLUGIN_VERSION_NUM) {
        plugin_activation_cretable();
    }
}

// 插件停用时，运行回调方法删除数据表，删除options表中的插件版本号
register_deactivation_hook(__FILE__, 'plugin_deactivation_deltable');
function plugin_deactivation_deltable() {
    global $wpdb;

    $wpdb->query("DROP TABLE IF EXISTS " . TABLE_PARTNER);
    $wpdb->query("DROP TABLE IF EXISTS " . TABLE_APPLICATION);
    delete_option('wechat_plugin_version_num');
}
