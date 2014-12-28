<?php
namespace auvtime\util;
/**
 * 
 * <p><b>标题：</b>auvtime\util$CommonUtil.</p>
 *
 * <p><b>描述：通用工具类，如产生uuid</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-12-28 上午11:26:10
 *
 * @since 1.0
 */
class CommonUtil{
    /**
     * 静态方法，产生uuid
     * @param string $prefix uuid前缀
     * @return string uuid
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-12-28 上午11:28:27
     */
    public static function uuid($prefix  =  '' ){
        $chars  = md5(uniqid(mt_rand(), true));
        $uuid   =  substr ( $chars ,0,8) .  '-' ;
        $uuid  .=  substr ( $chars ,8,4) .  '-' ;
        $uuid  .=  substr ( $chars ,12,4) .  '-' ;
        $uuid  .=  substr ( $chars ,16,4) .  '-' ;
        $uuid  .=  substr ( $chars ,20,12);
        return   $prefix  .  $uuid ;
    }
    /**
     * 根据文件名获取文件扩展名
     * @param string $fileName 具有文件扩展名的文件名
     * @return string 文件扩展名
     * @author WangXianfeng<wangxianfeng@auvtime.com> 2014-12-28 上午11:35:14
     */
    public static function getFileExtByName($fileName){
        $extend  = explode ( '.', $fileName );
        $va = count ( $extend )-1;
        return   $extend [ $va ];
    }
}