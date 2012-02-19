<?php 

/*
 * Wrapper class for CHtml
 * EBootstrap adds some bootstrap elements to CHtml
 * 
 * @author Tim Helfensdörfer <tim@visualappeal.de>
 * @version 0.3.0
 * @package bootstrap
 */
class EBootstrap extends CHtml {
	/*
	 * Merges the classes (i.e. htmlOptions) and another array of classes
	 *
	 * @param array $option Classes to modify
	 * @param array $add Classes to add
	 */
	public static function mergeClass(array &$option, array $add) {
		if (isset($option['class']) and (!empty($option['class']))) {
			foreach ($add as $k => $v) {
				$option['class'] .= ' '.$v;
			}
		}
		else
			$option['class'] = implode(' ', $add);
	}
	
	/*
	 * Merges a class string (i.e. cssClassName) with an array of classes
	 *
	 * @param string $class Classes string
	 * @param array $add Classes to add
	 */
	public static function mergeClassString(&$class, array $add) {
		if (!empty($class))
			$class .= ' ';
		$class .= implode(' ', $add);
	}
	
	/*
	 * Returns an inline label
	 *
	 * @param string $label Label
	 * @param string $type success|warning|important|info. Leave empty for default
	 * @param array $htmlOptions
	 */
	public static function ilabel($label, $type='', $htmlOptions=array()) {
		$classes = array('label');
		if (!empty($type))
			$classes[] = 'label-'.$type;
		
		self::mergeClass($htmlOptions, $classes);
		return EBootstrap::tag('span', $htmlOptions, $label);
	}
	
	/*
	 * Returns an link-button
	 *
	 * http://twitter.github.com/bootstrap/base-css.html#buttons
	 *
	 * @param string $text Label of the button
	 * @param string $url Url
	 * @param string $type primary|info|success|warning|danger|inverse. Leave empty for default
	 * @param string $size large|small|mini. Leave empty for default
	 * @param bool $disabled Default: false
	 * @param string $icon http://twitter.github.com/bootstrap/base-css.html#icons (e.g. 'shopping-cart', 'user', 'ok', etc.)
	 * @param bool $iconWhite Invert the icon color. Default: false
	 * @param array $htmlOptions
	 */
	public static function ibutton($text, $url = '#', $type = '', $size = '', $disabled = false, $icon = '', $iconWhite = false, $htmlOptions = array()) {
		return new EBootstrapButton($text, $url, $type, $size, $disabled, $icon, $iconWhite, $htmlOptions);
	}
	
	/*
	 * Returns a group of buttons
	 *
	 * http://twitter.github.com/bootstrap/components.html#buttonGroups
	 *
	 * @param array $buttons Array of buttons. You can create them with the help of EBootstrap::ibutton();
	 * @param array $htmlOptions
	 */
	public static function buttonGroup($buttons, $htmlOptions = array()) {
		$html = '';
		
		if (is_array($buttons) and (count($buttons))) {
			self::mergeClass($htmlOptions, array('btn-group'));
			$html .= self::openTag('div', $htmlOptions)."\n";
			foreach ($buttons as $button) {
				$html .= $button."\n";
			}
			$html .= self::closeTag('div')."\n";
		}
		
		return $html;
	}
	
	/*
	 * Returns a toolbar with button groups
	 *
	 * http://twitter.github.com/bootstrap/components.html#buttonGroups
	 *
	 * @param array $buttonGroups Array of button groups. You can create them with the help of EBootstrap::buttonGroup();
	 * @param array $htmlOptions
	 */
	public static function buttonToolbar($buttonGroups, $htmlOptions = array()) {
		$html = '';
		
		if (is_array($buttonGroups) and (count($buttonGroups))) {
			self::mergeClass($htmlOptions, array('btn-toolbar'));
			$html .= self::openTag('div', $htmlOptions)."\n";
			foreach ($buttonGroups as $group) {
				$html .= $group."\n";
			}
			$html .= self::closeTag('div')."\n";
		}
		
		return $html;
	}
	
	/*
	 * Returns a toolbar with button groups
	 *
	 * @param EBootstrapButton $button You can create the button with the help of EBootstrap::ibutton();
	 * @param array $submenu Array of submenu items. Available options are text, url and htmlOptions
	 * @param bool $split If split is set to true, the carret ist next to the button and both elements can be clicked separately 
	 * @param array $htmlOptions
	 */
	public static function buttonDropdown(EBootstrapButton $button, $submenuItems = array(), $split = false, $htmlOptions = array()) {
		$html = '';
		
		self::mergeClass($htmlOptions, array('btn-group'));
		echo self::openTag('div', $htmlOptions);
		
		if (!$split) {
			$button->htmlOptions['data-toggle'] = "dropdown";
			$button->url = "#";
			$button->text .= ' <span class="caret"></span>';
			self::mergeClass($button->htmlOptions, array('dropdown-toggle'));
		
			$html .= $button."\n";
		}
		else {
			$carret = new EBootstrapButton('<span class="caret"></span>', '#');
			$carret->htmlOptions['data-toggle'] = "dropdown";
			$carret->type = $button->type;
			self::mergeClass($carret->htmlOptions, array('btn', 'dropdown-toggle'));
			
			$html .= $button."\n";
			$html .= $carret."\n";
		}
		
		if (is_array($submenuItems) and (count($submenuItems))) {
			$html .= self::openTag('ul', array('class' => 'dropdown-menu'))."\n";
			foreach ($submenuItems as $item) {
				$html .= self::openTag('li')."\n";
				
				$itemOptions = isset($item['htmlOptions']) ? $item['htmlOptions'] : array();
				$html .= self::link($item['text'], $item['url'], $itemOptions)."\n";
				
				$html .= self::closeTag('li')."\n";
			}
			$html .= self::closeTag('ul')."\n";
		}
		
		$html .= self::closeTag('div')."\n";
		
		return $html;
	}
	
	/*
	 * Returns an icon
	 *
	 * http://twitter.github.com/bootstrap/base-css.html#icons
	 *
	 * @param string $icon e.g. 'shopping-cart', 'user', 'ok', etc.
	 * @param bool $iconWhite Invert the icon color. Default: false
	 */
	public static function icon($icon, $iconWhite = false) {
		$return = '<i class="icon-'.$icon;
		if ($iconWhite)
			$return .= ' icon-white';
		return $return.'"></i>';
	}
	
	/* IMAGES */
	
	/*
	 * Returns an custom thumbnail src
	 *
	 * http://placehold.it/
	 *
	 * @param int $w Width
	 * @param int $h Height Default: $w
	 * @param string $bgColor Background color
	 * @param string $tColor Text color
	 * @param string $text Text to display on the image
	 * @param string $format png|gif|jpg Default: png
	 */
	public static function thumbnailSrc($w, $h = null, $bgColor = 'ccc', $tColor = '333', $text = null, $format = 'png') {
		$src = 'http://placehold.it/'.$w;
		if (!is_null($h))
			$src .= 'x'.$h;
		$src .= '/'.$bgColor.'/'.$tColor.'.'.$format;
		if (!is_null($text))
			$src .= '&text=' . urlencode($text);
		
		return $src;
	}
	
	/*
	 * Returns an image link
	 *
	 * @param string $url Url
	 * @param string $src Image src
	 * @param string $alt Alternative text
	 * @param array $htmlOptions
	 */
	public static function thumbnailLink($url, $src, $alt = '', $htmlOptions = array()) {
		$html = '';
		
		$htmlOptions['href'] = $url;
		self::mergeClass($htmlOptions, array('thumbnail'));
		$html .= EBootstrap::openTag('a', $htmlOptions);
		$html .= EBootstrap::tag('img', array('src' => $src, 'alt' => $alt));
		$html .= EBootstrap::closeTag('a');
		
		return $html;
	}
	
	/*
	 * Returns an image with a caption
	 *
	 * @param string $src Image src
	 * @param string $alt Alternative text
	 * @param string $caption Image caption
	 * @param string $body Text below the caption
	 * @param array $actions Array with actions which will be rendered below the body. All items has to be HTML
	 * @param array $htmlOptions
	 */
	public static function imageCaption($src, $alt='', $caption = '', $body = '', $actions = array(), $htmlOptions=array()) {
		$html = '';
		
		self::mergeClass($htmlOptions, array('thumbnail'));
		$html .= self::openTag('div', $htmlOptions)."\n";
				
		$htmlOptions = array();
		$htmlOptions['src']=$src;
		$htmlOptions['alt']=$alt;
		$html .= self::tag('img',$htmlOptions)."\n";
		
		if (!empty($caption) or !empty($body) or !empty($actions)) {
			$html .= self::openTag('div', array('class' => 'caption'));
			
			if (!empty($caption))
				$html .= self::tag('h5', array(), $caption)."\n";
			if (!empty($body))
				$html .= self::tag('p', array(), $body)."\n";
			if (!empty($actions)) {
				$html .= self::openTag('p');
				foreach ($actions as $button) {
					$html .= $button." \n";
				}
				$html .= self::closeTag('p')."\n";
			}
			
			$html .= self::closeTag('div');
		}
    	
    	$html .= self::closeTag('div')."\n";
    	
    	return $html;
	}
}

?>