<?php

/*

Copyright 2013-2013 GavickPro (info@gavick.com)

this program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( !defined( 'WPINC' ) ) {
    die;
}

class GK_NSP_Layout_Parts_json {

	private $parent;

	function __construct($nsp) {
		$this->parent = $nsp;
	}
	/**
	 *
	 * Functions used to generate the article elements
	 *
	 **/
	 
	 function art_title($i, $only_value = false) {
	 	$art_title = $this->parent->wdgt_results[$i]->title;
	 	$art_url = $this->parent->wdgt_results[$i]->URL;
	 	
	 	$art_title_short = GK_NSP_Widget_Helpers::cut_text('article_title', $art_title, $this->parent->config['article_title_len_type'], $this->parent->config['article_title_len']);
	 	
	 	if($only_value) {
	 		return apply_filters('gk_nsp_art_raw_title', $art_title_short);
	 	}

	 	$output = '<h3 class="gk-nsp-header"><a href="'.$art_url.'" title="'.esc_attr(strip_tags($art_title)).'">'.$art_title_short.'</a></h3>';
	 	
	 	return apply_filters('gk_nsp_art_title', $output);
	 }
	 
	 function art_text($i, $only_value = false) {
	 	$art_text = $this->parent->wdgt_results[$i]->text;
	 	
	 	$art_text = GK_NSP_Widget_Helpers::cut_text('article_text', $art_text, $this->parent->config['article_text_len_type'], $this->parent->config['article_text_len']);
	 	$art_text = preg_replace('@\[.+?\]@mis', '', $art_text);
	 	
	 	if($only_value) {
	 		return apply_filters('gk_nsp_art_raw_text', $art_text);
	 	}

	 	$output = '<p class="gk-nsp-text">'.$art_text.'</p>';
	 	
	 	return apply_filters('gk_nsp_art_text', $output);
	 }
	 
	 function art_image($i, $only_value = false) {
 	 	$art_title = $this->parent->wdgt_results[$i]->title;
	 	$art_url = $this->parent->wdgt_results[$i]->URL;
	 	$art_image = $this->parent->wdgt_results[$i]->image;
	 	
	 	if($art_image != '') {
	 		$style = '';
		 			
	 		if($only_value) {
	 			return apply_filters('gk_nsp_art_raw_image', $art_image);
	 		}

		 	if($this->parent->config['image_block_padding'] != '' && $this->parent->config['image_block_padding'] != '0') {
		 		$style = ' style="margin: '.$this->parent->config['image_block_padding'].';"';
		 	}
		 		
		 	// if the popup is enabled
 			$link_additional_classes = '';
 			$link_rel = '';
 			if($this->parent->config['article_image_popup'] == 'on') {
 				$art_url = $art_image;
 				$link_additional_classes = ' thickbox';
 				$link_rel = ' rel="gallery-gk-nsp-' . $this->parent->id . '"';
 			}

 			if($this->parent->config['article_image_pos'] == 'left' && $this->parent->config['article_image_order'] == 1) {
 				$output = '<div class="gk-nsp-image-wrap"><a href="'.$art_url.'" title="'.esc_attr(strip_tags($art_title)).'" class="gk-image-link'.$link_additional_classes.'"'.$style.$link_rel.'><img src="'.$art_image.'" alt="" class="gk-nsp-image" /></a></div>';

 				return apply_filters('gk_nsp_art_image', $output);
 			} else {
 				$output = '<a href="'.$art_url.'" title="'.esc_attr(strip_tags($art_title)).'" class="gk-responsive gk-image-link'.$link_additional_classes.'"'.$style.$link_rel.'><img src="'.$art_image.'" alt="" class="gk-nsp-image gk-responsive" /></a>';

 				return apply_filters('gk_nsp_art_image', $output);
 			}
	 	} else {
	 		return '';
	 	} 
	 }
	 
	 function art_info($i) {
	 	$item = $this->parent->wdgt_results[$i];
	 	// replacements for the possible tags
	 	$category = $item->categories;
	 	$author = '';
	 	$date = '';
	 	$comments = '';
	 	$comment_count = $item->comment_count;
	 	// check if there is a author in format
	 	if(stripos($this->parent->config['article_info_format'], '{AUTHOR}') !== FALSE) {	 			 		
	 		$author_username = $item->author_name;
	 		$author_url = $item->author_URL;
	 		$author = '<a href="'.$author_url.'" class="gk-nsp-author">'.$author_username.'</a>';
	 	}
	 	// check if there is a date in format
	 	if(stripos($this->parent->config['article_info_format'], '{DATE}') !== FALSE) {
	 		$date = '<span class="gk-nsp-date">' . date($this->parent->config['article_info_date_format'], strtotime($item->date)) . '</span>';
	 	}
	 	// check if there is a comments in format
	 	if(stripos($this->parent->config['article_info_format'], '{COMMENTS}') !== FALSE) {
	 		$comment_phrase = '';

	 		if($comment_count == 0) {
	 			$comment_phrase = __('No comments', 'gk-nsp');
	 		} else if($comment_count >= 1) {
	 			$comment_phrase = __('Comments ', 'gk-nsp') . '(' . $comment_count . ')';
	 		}

	 		$comments = '<a href="'.$item->comment_link.'#comments">'.$comment_phrase.'</a>';
	 	}
	 	// replace them all!
	 	$output = str_replace(
	 		array('{CATEGORY}', '{AUTHOR}', '{DATE}', '{COMMENTS}'),
	 		array($category, $author, $date, $comments),
	 		$this->parent->config['article_info_format']
	 	);

	 	return apply_filters('gk_nsp_art_info', '<p class="gk-nsp-info">' . $output . '</p>');
	 }
	 
	 function art_readmore($i, $only_value = false) {
	 	$art_url = $this->parent->wdgt_results[$i]->URL;
	 	
	 	if($only_value) {
	 		return apply_filters('gk_nsp_art_raw_readmore', $art_url);
	 	}

	 	$output = '<a href="'.$art_url.'" class="readon btn" title="'.__('Read more', 'gk-nsp').'">'.__('Read more', 'gk-nsp').'</a>';
	 	
	 	return apply_filters('gk_nsp_art_readmore', $output);
	 }
	 
	 /**
	  *
	  * Functions used to generate the links elements
	  *
	  **/
	  
	function link_title($i) {
		$art_title = $this->parent->wdgt_results[$i]->title;
		$art_url = $this->parent->wdgt_results[$i]->URL;
		
		$art_title_short = GK_NSP_Widget_Helpers::cut_text('links_title', $art_title, $this->parent->config['links_title_len_type'], $this->parent->config['links_title_len']);
		
		$output = '<h4 class="gk-nsp-link-header"><a href="'.$art_url.'" title="'.esc_attr(strip_tags($art_title)).'">'.$art_title_short.'</a></h4>';
		
		return apply_filters('gk_nsp_link_title', $output);
	}

	function link_text($i) {
		$art_text = $this->parent->wdgt_results[$i]->text;
		
		$art_text = GK_NSP_Widget_Helpers::cut_text('links_text', $art_text, $this->parent->config['links_text_len_type'], $this->parent->config['links_text_len']);
		$art_text = preg_replace('@\[.+?\]@mis', '', $art_text);
		
		$output = '<p class="gk-nsp-link-text">'.$art_text.'</p>';
		
		return apply_filters('gk_nsp_link_text', $output);
	}
}

// EOF