<?php

namespace EauDeWeb\Robo\Task\Curl;

use Robo\Collection\CollectionBuilder;

trait loadTasks {

	/**
	 * @param string $url
	 * @return CollectionBuilder
	 */
	protected function taskCurl(string $url) : CollectionBuilder {
		return $this->task(Curl::class, $url);
	}
}
