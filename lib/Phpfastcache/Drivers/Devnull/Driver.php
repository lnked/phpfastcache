<?php
/**
 *
 * This file is part of phpFastCache.
 *
 * @license MIT License (MIT)
 *
 * For full copyright and license information, please see the docs/CREDITS.txt file.
 *
 * @author Khoa Bui (khoaofgod)  <khoaofgod@gmail.com> https://www.phpfastcache.com
 * @author Georges.L (Geolim4)  <contact@geolim4.com>
 *
 */
declare(strict_types=1);

namespace Phpfastcache\Drivers\Devnull;

use Phpfastcache\Core\Pool\{DriverBaseTrait, ExtendedCacheItemPoolInterface};
use Phpfastcache\Entities\DriverStatistic;
use Phpfastcache\Exceptions\{PhpfastcacheInvalidArgumentException};
use Psr\Cache\CacheItemInterface;


/**
 * Class Driver
 * @package phpFastCache\Drivers
 * @property Config $config Config object
 * @method Config getConfig() Return the config object
 */
class Driver implements ExtendedCacheItemPoolInterface
{
    use DriverBaseTrait;

    /**
     * @inheritdoc
     */
    public static function isUsableInAutoContext(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function driverCheck(): bool
    {
        return true;
    }

    /**
     * @return DriverStatistic
     */
    public function getStats(): DriverStatistic
    {
        $stat = new DriverStatistic();
        $stat->setInfo('[Devnull] A void info string')
            ->setSize(0)
            ->setData(implode(', ', array_keys($this->itemInstances)))
            ->setRawData(null);

        return $stat;
    }

    /**
     * @param CacheItemInterface $item
     * @return mixed
     * @throws PhpfastcacheInvalidArgumentException
     */
    protected function driverWrite(CacheItemInterface $item): bool
    {
        /**
         * Check for Cross-Driver type confusion
         */
        if ($item instanceof Item) {
            return true;
        }

        throw new PhpfastcacheInvalidArgumentException('Cross-Driver type confusion detected');
    }

    /**
     * @param CacheItemInterface $item
     * @return null
     */
    protected function driverRead(CacheItemInterface $item)
    {
        return null;
    }

    /**
     * @param CacheItemInterface $item
     * @return bool
     * @throws PhpfastcacheInvalidArgumentException
     */
    protected function driverDelete(CacheItemInterface $item): bool
    {
        /**
         * Check for Cross-Driver type confusion
         */
        if ($item instanceof Item) {
            return true;
        }

        throw new PhpfastcacheInvalidArgumentException('Cross-Driver type confusion detected');
    }

    /**
     * @return bool
     */
    protected function driverClear(): bool
    {
        return true;
    }

    /********************
     *
     * PSR-6 Extended Methods
     *
     *******************/

    /**
     * @return bool
     */
    protected function driverConnect(): bool
    {
        return true;
    }
}