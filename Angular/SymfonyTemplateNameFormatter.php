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
use Symfony\Component\HttpKernel\KernelInterface;

class SymfonyTemplateNameFormatter implements TemplateNameFormatterInterface {

    /**
     * Bundle map: bundle root => bundle name
     *
     * Used to map asset files to a bundle
     *
     * @var array
     */
    private $bundleMap;
    private $appName;

    public function __construct(KernelInterface $kernel, $appName) {
        $bundleMap = array();
        foreach ($kernel->getBundles() as $bundle) {
            $bundleMap[$bundle->getPath()] = $bundle->getName();
        }

        $this->bundleMap = $bundleMap;
        $this->appName = $appName;
    }

    /**
     * Create module name for asset.
     * This is bundle name.
     *
     * @return string
     */
    public function getModuleName() {
        return $this->appName;
    }

    /**
     * Create template name for asset.
     *
     * @param AssetInterface $asset
     * @return string
     */
    public function getForAsset(AssetInterface $asset) {
        $isInsideBundle = true;
        $sourceRoot = $asset->getSourceRoot();
        if (!isset($this->bundleMap[$sourceRoot])) {
            $isInsideBundle = false;
        }

        // get the relative path
        $templateName = $asset->getSourcePath();
        
        if ($isInsideBundle &&
                ($posResources = strpos($templateName, 'Resources')) !== false) {
            // All symfony views in a bundle are in Resources/, therefore remove this segment
            $templateName = substr($templateName, $posResources + 10);
        }

        if($isInsideBundle) {
            // prepend bundle name
            $bundleName = $this->bundleMap[$sourceRoot];
            $templateName = sprintf('%s/%s', $bundleName, $templateName);
        }

        return $templateName;
    }

}