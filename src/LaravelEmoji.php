<?php
namespace BahriCanli\LaravelEmoji;

use App\Http\Controllers\Controller;
require_once 'Emoji.php';

class LaravelEmoji extends Controller {

	static public function covertEmojiToName($data) {
		$data = emoji_docomo_to_unified($data);   # DoCoMo devices
	    	$data = emoji_kddi_to_unified($data);     # KDDI & Au devices
    		$data = emoji_softbank_to_unified($data); # Softbank & (iPhone) Apple devices
	    	$data = emoji_google_to_unified($data);   # Google Android devices
		$data = emoji_unified_to_name($data);
		$data = emoji_unified_to_key($data);
		return $data;
	}

	static public function covertNameToEmoji($data) {
		$data = emoji_name_to_unified($data);
		return $data;
	}

	static public function covertNameToEmpty($data) {
		$data = emoji_name_to_empty($data);
		return $data;
	}

	static public function covertUnifiedToEmpty($data) {
		$data = emoji_unified_to_empty($data);
		return $data;
	}

	static public function covertHtmlToEmoji($data) {
		$data = emoji_html_to_unified($data);
		return $data;
	}

	static private function uniChr($u) {
 	   return mb_convert_encoding('&#' . intval($u) . ';', 'UTF-8', 'HTML-ENTITIES');
	}

	static private function uniChrCode($data) {
	   list(, $ord) = unpack('N', mb_convert_encoding($data, 'UCS-4BE', 'UTF-8'));
	   return $ord;
	}

	static public function textWithEmoji($data) {
		if($data=="") return false;

		$data = LaravelEmoji::covertEmojiToName($data);
		$data = LaravelEmoji::covertNameToEmoji($data);

		$CPString = "";
		$haut = 0;
		$n = 0;

		$strLen = mb_strlen($data, 'UTF-8');
		for($i=0; $i<$strLen; $i++) {
			$char = mb_substr($data, $i, 1, 'UTF-8');
			$charCode = LaravelEmoji::uniChrCode($char);

			if($charCode>1000) {
				
				/*if ( $charCode < 0 || $charCode > 0xFFFF ) {
					$CPString .= 'Error1 ' . strtolower(dechex($charCode)) . '!';
				}*/


				if ($haut != 0) {
					if (0xDC00 <= $charCode&& $charCode<= 0xDFFF) {
						$CPString .= ' imgFront'. strtolower(dechex(0x10000 + (($haut - 0xD800) << 10) + ($charCode  - 0xDC00))) . 'imgBack ';
						$haut = 0;
						continue;
					}
					else {
						$CPString .=  'Error2' . strtolower(dechex($haut)) . '!';
						$haut = 0;
					}
				}

				if (0xD800 <= $charCode  && $charCode <= 0xDBFF) {
					$haut = $charCode;
				}
				else {
					$CPString .= ' imgFront'. strtolower(dechex($charCode)) . 'imgBack ';
				}
			}
			else {
				$CPString .= LaravelEmoji::uniChr($charCode);
			}
		}

		$CPString = str_replace('imgFront', '<img class="emoji-img" width="16" src="http://twemoji.maxcdn.com/16x16/', $CPString);
		$CPString = str_replace('imgBack', '.png"/>', $CPString);
		return $CPString;
	}
}
