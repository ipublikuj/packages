<?php
/**
 * Test: IPub\Packages\Loader
 * @testCase
 *
 * @copyright      More in license.md
 * @license        https://www.ipublikuj.eu
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 * @package        iPublikuj:Packages!
 * @subpackage     Tests
 * @since          2.0.0
 *
 * @date           20.07.16
 */

declare(strict_types = 1);

namespace IPubTests\Packages;

use Nette;

use Tester;
use Tester\Assert;

use IPub\Packages;

require __DIR__ . '/../bootstrap.php';

/**
 * Package loader tests
 *
 * @package        iPublikuj:Packages!
 * @subpackage     Tests
 *
 * @author         Adam Kadlec <adam.kadlec@ipublikuj.eu>
 */
class LoaderTest extends Tester\TestCase
{
	public function testFunctional() : void
	{
		$dic = $this->createContainer();

		/** @var Packages\Loaders\ILoader $loader */
		$loader = $dic->getService('packages.loader');

		$package = $loader->load(__DIR__ . '/../../../composer.json');

		Assert::true($package instanceof Packages\Entities\IPackage);
		Assert::same('ipub/packages', $package->getName());
	}

	/**
	 * @return Nette\DI\Container
	 */
	protected function createContainer() : Nette\DI\Container
	{
		$rootDir = __DIR__ . '/../../';

		$config = new Nette\Configurator();
		$config->setTempDirectory(TEMP_DIR);

		$config->addParameters(['container' => ['class' => 'SystemContainer_' . md5((string) time())]]);
		$config->addParameters(['appDir' => $rootDir, 'wwwDir' => $rootDir]);

		$config->addConfig(__DIR__ . '/files/config.neon');

		Packages\DI\PackagesExtension::register($config);

		return $config->createContainer();
	}
}

\run(new LoaderTest());
