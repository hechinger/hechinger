<?php

if (!class_exists('TimberStream')) {
	return;
}

class HechingerHome extends TimberStream {

	var $_zone_1;

	function __construct() {
		parent::__construct('homepage');
	}

	public function get_zone($zone = 1) {
		if ($zone == 1) {
			return $this->get_zone_1_posts();
		} else if ($zone == 2) {
			return $this->get_zone_2_posts();
		} else if ($zone == 3) {
			return $this->get_zone_3_posts();
		}
	}

	public function get_zone_pointer($zone = 1) {
		if ($zone == 1) {
			return 0;
		}
		if ($zone == 2) {
			$z1 = $this->get_zone_1_posts();
			return count($z1);
		}
		if ($zone == 3) {
			$z1 = $this->get_zone_pointer(2);
			$z2 = $this->get_zone_2_posts();
			$pointer = $z1 + count($z2);
			return $pointer;
		}
	}

	protected function get_zone_1_posts() {
		$avail_posts = $this->get_posts(array(), 'HechingerPost');
		$posts = array();
		$posts[] = $avail_posts[0];
		$posts[] = $avail_posts[1];
		if (!$posts[1]->thumbnail()) {
			$posts[] = $avail_posts[2];
		}
		return $posts;
	}

	protected function get_zone_2_posts() {
		$avail_posts = $this->get_posts(array(), 'HechingerPost');
		$pointer = $this->get_zone_pointer(2);
		$posts = array();
		for ($i = $pointer; $i < $pointer + 7; $i++ ) {
			$posts[] = $avail_posts[$i];
		}
		return $posts;
	}

	protected function get_zone_3_posts() {
		$avail_posts = $this->get_posts(array(), 'HechingerPost');
		$pointer = $this->get_zone_pointer(3);
		$posts = array();
		for ($i = $pointer; $i < $pointer + 7; $i++ ) {
			$posts[] = $avail_posts[$i];
		}
                
        if (is_array($posts) && count($posts)) {
            for ($i = 0; $i < count($posts); $i++) {
                if ( $posts[$i]->thumbnail()->src) {
                    $t = $posts[0];
                    $posts[0] = $posts[$i];
                    $posts[$i] = $t;
                    break;
                }
            }
        }
		return $posts;
	}
}