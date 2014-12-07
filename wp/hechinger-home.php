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
		for ($i = $pointer; $i < $pointer + 6; $i++ ) {
			$posts[] = $avail_posts[$i];
		}
		return $posts;
	}


}