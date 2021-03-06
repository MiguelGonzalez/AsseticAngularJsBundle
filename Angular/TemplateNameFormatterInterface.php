<?php

/*
 * This file is part of the AsseticAngularJsBundle package.
 *
 * (c) Pascal Kuendig <padakuro@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Miguel\AsseticAngularJsBundle\Angular;

use Assetic\Asset\AssetInterface;

interface TemplateNameFormatterInterface {
	public function getModuleName();
    public function getForAsset(AssetInterface $asset);
}