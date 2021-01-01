<?php /** @noinspection PhpUnused */

/**
 * @file Curl.php
 */

namespace EauDeWeb\Robo\Task\Curl;

use Robo\Common\ExecOneCommand;
use Robo\Contract\CommandInterface;
use Robo\Result;
use Robo\Task\BaseTask;

/**
 * Class Curl is a wrapper around curl command line HTTP client.
 *
 * @package EauDeWeb\Robo\Task\Curl
 */
class Curl extends BaseTask implements CommandInterface {

	use ExecOneCommand;

	protected $command;

	protected $url;

	/**
	 * Curl constructor.
	 *
	 * @param string $url
	 *   Request URL.
	 */
	public function __construct(string $url) {
		$this->url = $url;
		$this->command = 'curl';
	}

	/**
	 * Process exits with error if HTTP error occurs. Useful for scripting.
	 *
	 * @return Curl
	 */
	public function failOnHttpError() : Curl {
		$this->option('-f');
		return $this;
	}

	/**
	 * Follow redirects.
	 *
	 * @return Curl
	 */
	public function followRedirects() : Curl {
		$this->option('-L');
		return $this;
	}

	/**
	 * Accept redirects to different domains (e.g. example.com => www.example.com).
	 *
	 * @return Curl
	 */
	public function locationTrusted() : Curl {
		$this->option('--location-trusted');
		return $this;
	}

	/**
	 * Send Basic Authentication headers.
	 *
	 * @param string $username
	 *   Username in clear.
	 * @param $password
	 *   Password in clear.
	 *
	 * @return Curl
	 */
	public function basicAuth(string $username, string $password) : Curl {
		$this->option('-u', $username . ':' . $password);
		return $this;
	}

	/**
	 * Write output to file.
	 *
	 * @param string $file
	 *   Output file.
	 *
	 * @return Curl
	 */
	public function output(string $file) : Curl {
		$this->option('-o', $file);
		return $this;
	}

	/**
	 * Add HTTP header to the request.
	 *
	 * @param string $header
	 *   HTTP header (i.e. Accept: application/javascript')
	 *
	 * @return Curl
	 */
	public function header(string $header) : Curl {
		$this->option('-H', $header);
		return $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getCommand() : string {
		$this->rawArg($this->url);
		return $this->command . $this->arguments;
	}

	/**
	 * @return Result
	 */
	public function run() : Result {
		$command = $this->getCommand();
		return $this->executeCommand($command);
	}
}