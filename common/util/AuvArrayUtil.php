<?php

namespace auvtime\util;

/**
 *
 *
 *
 * <p><b>标题：</b>auvtime\util$AuvArrayUtil.</p>
 *
 * <p><b>描述：auvtime数组相关工具类</b></p>
 *
 * <p><b>版权：</b>Copyright (c) 2014 AUVTime</p>
 *
 * @author WangXianfeng 2014-5-17 下午10:53:26
 *        
 * @since 1.0
 */
class AuvArrayUtil {
	/**
	 * 参数为array，返回json格式的字符串
	 *
	 * @param array $arraydata        	
	 * @return string
	 * @author WangXianfeng 2014-5-17 下午10:54:01
	 */
	public static function array_to_json_string($arraydata) {
		$output = "";
		$output .= "{";
		foreach ( $arraydata as $key => $val ) {
			if (is_array ( $val )) {
				$output .= "\"" . $key . "\" : [{";
				foreach ( $val as $subkey => $subval ) {
					$output .= "\"" . $subkey . "\" : \"" . $subval . "\",";
				}
				$output .= "}],";
			} else {
				$output .= "\"" . $key . "\" : \"" . $val . "\",";
			}
		}
		$output .= "}";
		return $output;
	}
}