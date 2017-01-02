<?php
/**
 * UnexpectedValueException.php
 *
 * @copyright      More in license.md
 * @license        http://www.ipublikuj.eu
 * @author         Adam Kadlec http://www.ipublikuj.eu
 * @package        iPublikuj:Packages!
 * @subpackage     Exceptions
 * @since          1.0.0
 *
 * @date           27.03.15
 */

declare(strict_types = 1);

namespace IPub\Packages\Exceptions;

class UnexpectedValueException extends \UnexpectedValueException implements IException
{
}
