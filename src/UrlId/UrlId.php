<?php
namespace UrlId;

class UrlId {
	public static function parse ($url) {
		if (substr_count('you', $url)) {
			return self::youtube($url);
		} elsif (substr_count('vimeo', $url)) {
			return self::vimeo($url);
		}
	}

	private static function youtube ($url) {
		if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
    		if (!empty($match[1])) {
    			return $match[1];
    		}
		}
		return null;
	}

	private static function vimeo ($url) {
		if (is_numeric($url)) {
			return $url;
		}
		if (substr_count($url, '?')) {
			$url = explode('?', $url, 2);
			$url = $url[0];
		}
		$url = explode('/', str_replace('http://', '', $url));
		return array_pop($url);
	}
}