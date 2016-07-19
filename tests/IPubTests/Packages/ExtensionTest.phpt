<?php
/**
 * Test: IPub\Packages\Extension
 * @testCase
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Packages!
 * @subpackage     Tests
 * @since          2.0.0
 *
 * @date           19.07.16
 */

namespace IPubTests\Packages;

use Nette;

use Tester;
use Tester\Assert;

use IPub;
use IPub\Packages;

require __DIR__ . '/../bootstrap.php';

/**
 * Registering packages extension tests
 *
 * @package        iPublikuj:Packages!
 * @subpackage     Tests
 *
 * @author         Adam Kadlec <adam.kadlec@fastybird.com>
 */
class ExtensionTest extends Tester\TestCase
{
	public function testFunctional()
	{
		$dic = $this->createContainer();

		Assert::true($dic->getService('packages.loader') instanceof Packages\Loaders\ILoader);
		Assert::true($dic->getService('packages.repository') instanceof Packages\Repository\IRepository);
		Assert::true($dic->getService('packages.manager') instanceof Packages\IPackagesManager);
		Assert::true($dic->getService('packages.pathResolver') instanceof Packages\Helpers\PathResolver);
	}

	/**
	 * @return Nette\DI\Container
	 */
	protected function createContainer()
	{
		$rootDir = __DIR__ . '/../../';

		$config = new Nette\Configurator();
		$config->setTempDirectory(TEMP_DIR);

		$config->addParameters(['container' => ['class' => 'SystemContainer_' . md5(time())]]);
		$config->addParameters(['appDir' => $rootDir, 'wwwDir' => $rootDir]);

		$config->addConfig(__DIR__ . '/files/config.neon');

		Packages\DI\PackagesExtension::register($config);

		return $config->createContainer();
	}
}

\run(new ExtensionTest());
